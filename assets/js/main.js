// ===== LABÁGUA - MAIN JAVASCRIPT =====

// DOM Content Loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize all functionality
    initializeAccessibility();
    initializeServicePortal();
    initializeNavigation();
    initializeScrollEffects();
    initializeAnimations();
    initializeForms();
    initializeChatWidget();
    initializeBackToTop();
    initializeLoadingStates();
    initializeSmoothScrolling();
    
    // Initialize AOS (Animate On Scroll)
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: true,
            offset: 100,
            delay: 100
        });
    }
});

// ===== ACCESSIBILITY FEATURES =====
function initializeAccessibility() {
    const highContrastBtn = document.getElementById('highContrast');
    const decreaseFontBtn = document.getElementById('smallFont');
    const normalFontBtn = document.getElementById('normalFont');
    const increaseFontBtn = document.getElementById('largeFont');
    
    // High contrast toggle
    if (highContrastBtn) {
        highContrastBtn.addEventListener('click', function() {
            document.body.classList.toggle('high-contrast');
            const isActive = document.body.classList.contains('high-contrast');
            
            // Save preference
            localStorage.setItem('highContrast', isActive);
            
            // Update button state
            this.classList.toggle('active', isActive);
        });
        
        // Load saved preference
        if (localStorage.getItem('highContrast') === 'true') {
            document.body.classList.add('high-contrast');
            highContrastBtn.classList.add('active');
        }
    }
    
    // Font size controls
    if (decreaseFontBtn) {
        decreaseFontBtn.addEventListener('click', function() {
            setFontSize('small');
        });
    }
    
    if (normalFontBtn) {
        normalFontBtn.addEventListener('click', function() {
            setFontSize('normal');
        });
    }
    
    if (increaseFontBtn) {
        increaseFontBtn.addEventListener('click', function() {
            setFontSize('large');
        });
    }
    
    // Load saved font size
    const savedFontSize = localStorage.getItem('fontSize') || 'normal';
    setFontSize(savedFontSize);
    
    function setFontSize(size) {
        // Remove existing font size classes
        document.documentElement.classList.remove('font-small', 'font-normal', 'font-large');
        
        // Add new font size class
        document.documentElement.classList.add(`font-${size}`);
        
        // Update button states
        document.querySelectorAll('.font-size-controls .accessibility-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        
        const activeBtn = document.getElementById(`${size}Font`);
        if (activeBtn) {
            activeBtn.classList.add('active');
        }
        
        // Save preference
        localStorage.setItem('fontSize', size);
    }
    
    // Keyboard navigation improvements
    document.addEventListener('keydown', function(e) {
        // Skip to main content with Alt+1
        if (e.altKey && e.key === '1') {
            e.preventDefault();
            const mainContent = document.getElementById('main-content');
            if (mainContent) {
                mainContent.focus();
                mainContent.scrollIntoView({ behavior: 'smooth' });
            }
        }
        
        // Toggle high contrast with Alt+C
        if (e.altKey && e.key === 'c') {
            e.preventDefault();
            if (highContrastBtn) {
                highContrastBtn.click();
            }
        }
    });
}

// ===== SERVICE PORTAL =====
function initializeServicePortal() {
    const categoryTabs = document.querySelectorAll('.category-tab');
    const serviceItems = document.querySelectorAll('.service-item');
    
    // Service categories data
    const serviceData = {
        residencial: [
            { icon: 'fas fa-tint', text: 'Análise de Água Potável' },
            { icon: 'fas fa-microscope', text: 'Teste Microbiológico' },
            { icon: 'fas fa-vial', text: 'Análise de Poço Artesiano' },
            { icon: 'fas fa-shield-alt', text: 'Certificado de Potabilidade' },
            { icon: 'fas fa-file-alt', text: 'Laudo Técnico Residencial' },
            { icon: 'fas fa-phone', text: 'Consultoria Domiciliar' }
        ],
        empresarial: [
            { icon: 'fas fa-building', text: 'Análise para Restaurantes' },
            { icon: 'fas fa-hotel', text: 'Análise para Hotéis' },
            { icon: 'fas fa-store', text: 'Comércio e Varejo' },
            { icon: 'fas fa-clipboard-check', text: 'Conformidade ANVISA' },
            { icon: 'fas fa-chart-bar', text: 'Monitoramento Contínuo' },
            { icon: 'fas fa-headset', text: 'Suporte Técnico 24h' }
        ],
        industrial: [
            { icon: 'fas fa-industry', text: 'Análise Industrial Completa' },
            { icon: 'fas fa-cogs', text: 'Controle de Processo' },
            { icon: 'fas fa-leaf', text: 'Certificações Ambientais' },
            { icon: 'fas fa-flask', text: 'Análises Customizadas' },
            { icon: 'fas fa-users-cog', text: 'Consultoria Especializada' },
            { icon: 'fas fa-award', text: 'Laudos Técnicos ISO' }
        ],
        educacional: [
            { icon: 'fas fa-graduation-cap', text: 'Cursos de Certificação' },
            { icon: 'fas fa-chalkboard-teacher', text: 'Treinamento Técnico' },
            { icon: 'fas fa-book', text: 'Material Didático' },
            { icon: 'fas fa-certificate', text: 'Certificados Reconhecidos' },
            { icon: 'fas fa-users', text: 'Turmas Personalizadas' },
            { icon: 'fas fa-laptop', text: 'Ensino Online' }
        ]
    };
    
    categoryTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const category = this.dataset.category;
            
            // Update active tab
            categoryTabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            
            // Update service grid
            updateServiceGrid(category, serviceData[category]);
        });
    });
    
    function updateServiceGrid(category, services) {
        const serviceGrid = document.getElementById('serviceGrid');
        if (!serviceGrid) return;
        
        // Fade out
        serviceGrid.style.opacity = '0';
        serviceGrid.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            // Clear and populate
            serviceGrid.innerHTML = '';
            
            services.forEach((service, index) => {
                const serviceItem = document.createElement('div');
                serviceItem.className = 'service-item';
                serviceItem.dataset.category = category;
                serviceItem.innerHTML = `
                    <i class="${service.icon}"></i>
                    <span>${service.text}</span>
                `;
                
                // Add click handler
                serviceItem.addEventListener('click', function() {
                    // Scroll to contact form
                    const contactSection = document.getElementById('contato');
                    if (contactSection) {
                        contactSection.scrollIntoView({ behavior: 'smooth' });
                        
                        // Pre-select service type if form exists
                        const serviceSelect = document.getElementById('service');
                        if (serviceSelect && category !== 'educacional') {
                            serviceSelect.value = category;
                        }
                    }
                });
                
                serviceGrid.appendChild(serviceItem);
                
                // Stagger animation
                setTimeout(() => {
                    serviceItem.style.opacity = '1';
                    serviceItem.style.transform = 'translateY(0)';
                }, index * 50);
            });
            
            // Fade in
            serviceGrid.style.opacity = '1';
            serviceGrid.style.transform = 'translateY(0)';
        }, 200);
    }
    
    // Initialize with first category
    if (categoryTabs.length > 0) {
        const firstCategory = categoryTabs[0].dataset.category;
        updateServiceGrid(firstCategory, serviceData[firstCategory]);
    }
}

// ===== NAVIGATION =====
function initializeNavigation() {
    const header = document.getElementById('header');
    const navToggle = document.getElementById('nav-toggle');
    const navMenu = document.getElementById('nav-menu');
    const navLinks = document.querySelectorAll('.nav-link');
    
    // Mobile menu toggle
    if (navToggle && navMenu) {
        navToggle.addEventListener('click', function() {
            navToggle.classList.toggle('active');
            navMenu.classList.toggle('active');
            document.body.classList.toggle('menu-open');
        });
    }
    
    // Close mobile menu when clicking nav links
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            if (navMenu.classList.contains('active')) {
                navToggle.classList.remove('active');
                navMenu.classList.remove('active');
                document.body.classList.remove('menu-open');
            }
        });
    });
    
    // Close mobile menu when clicking outside
    document.addEventListener('click', function(e) {
        if (!navToggle.contains(e.target) && !navMenu.contains(e.target)) {
            navToggle.classList.remove('active');
            navMenu.classList.remove('active');
            document.body.classList.remove('menu-open');
        }
    });
    
    // Header scroll effect
    let lastScrollTop = 0;
    window.addEventListener('scroll', function() {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        
        // Add/remove scrolled class
        if (scrollTop > 100) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
        
        // Hide/show header on scroll
        if (scrollTop > lastScrollTop && scrollTop > 200) {
            header.style.transform = 'translateY(-100%)';
        } else {
            header.style.transform = 'translateY(0)';
        }
        
        lastScrollTop = scrollTop;
    });
    
    // Active navigation highlighting
    const sections = document.querySelectorAll('section[id]');
    const navItems = document.querySelectorAll('.nav-link[href^="#"]');
    
    function highlightActiveNav() {
        let currentSection = '';
        
        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            
            if (window.scrollY >= sectionTop - 200) {
                currentSection = section.getAttribute('id');
            }
        });
        
        navItems.forEach(item => {
            item.classList.remove('active');
            if (item.getAttribute('href') === `#${currentSection}`) {
                item.classList.add('active');
            }
        });
    }
    
    window.addEventListener('scroll', highlightActiveNav);
}

// ===== SCROLL EFFECTS =====
function initializeScrollEffects() {
    // Parallax effect for hero section
    const hero = document.querySelector('.hero');
    const heroBackground = document.querySelector('.hero-background');
    
    if (hero && heroBackground) {
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const parallax = scrolled * 0.5;
            heroBackground.style.transform = `translateY(${parallax}px)`;
        });
    }
    
    // Fade in elements on scroll
    const fadeElements = document.querySelectorAll('.fade-in');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });
    
    fadeElements.forEach(element => {
        observer.observe(element);
    });
}

// ===== ANIMATIONS =====
function initializeAnimations() {
    // Counter animation for statistics
    const counters = document.querySelectorAll('.number-value[data-target], .counter[data-target]');
    
    const animateCounter = (counter) => {
        const target = parseInt(counter.getAttribute('data-target'));
        const duration = 2000; // 2 seconds
        const startTime = performance.now();
        const startValue = 0;
        
        const updateCounter = (currentTime) => {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            
            // Easing function for smooth animation
            const easeOutCubic = 1 - Math.pow(1 - progress, 3);
            const currentValue = Math.floor(startValue + (target - startValue) * easeOutCubic);
            
            counter.textContent = currentValue;
            
            if (progress < 1) {
                requestAnimationFrame(updateCounter);
            } else {
                counter.textContent = target;
            }
        };
        
        requestAnimationFrame(updateCounter);
    };
    
    // Trigger counter animation when in view
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                counterObserver.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.5
    });
    
    counters.forEach(counter => {
        counterObserver.observe(counter);
    });
    
    // Typing animation for hero title (optional)
    const heroTitle = document.querySelector('.hero-title');
    if (heroTitle && heroTitle.classList.contains('typing-animation')) {
        const text = heroTitle.innerText;
        heroTitle.innerText = '';
        
        let i = 0;
        const typeWriter = () => {
            if (i < text.length) {
                heroTitle.innerHTML += text.charAt(i);
                i++;
                setTimeout(typeWriter, 100);
            }
        };
        
        setTimeout(typeWriter, 1000);
    }
}

// ===== FORMS =====
function initializeForms() {
    const contactForm = document.getElementById('contactForm');
    const newsletterForm = document.getElementById('newsletterForm');
    
    // Contact form submission
    if (contactForm) {
        contactForm.addEventListener('submit', handleContactFormSubmit);
        
        // Real-time validation
        const formInputs = contactForm.querySelectorAll('input, select, textarea');
        formInputs.forEach(input => {
            input.addEventListener('blur', function() {
                validateField(this);
            });
            
            input.addEventListener('input', function() {
                if (this.classList.contains('error')) {
                    validateField(this);
                }
            });
        });
    }
    
    // Newsletter form submission
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', handleNewsletterSubmit);
    }
    
    // Phone number formatting
    const phoneInputs = document.querySelectorAll('input[type="tel"]');
    phoneInputs.forEach(input => {
        input.addEventListener('input', function() {
            this.value = formatPhoneNumber(this.value);
        });
    });
}

// Form submission handlers
async function handleContactFormSubmit(e) {
    e.preventDefault();
    
    const form = e.target;
    const formData = new FormData(form);
    const submitBtn = form.querySelector('button[type="submit"]');
    
    // Show loading state
    setLoadingState(submitBtn, true);
    
    // Validate form
    if (!validateForm(form)) {
        setLoadingState(submitBtn, false);
        return;
    }
    
    try {
        const response = await fetch('includes/contact.php', {
            method: 'POST',
            body: formData
        });
        
        const result = await response.json();
        
        if (result.success) {
            showNotification('Mensagem enviada com sucesso! Entraremos em contato em breve.', 'success');
            form.reset();
        } else {
            showNotification(result.message || 'Erro ao enviar mensagem. Tente novamente.', 'error');
        }
    } catch (error) {
        console.error('Form submission error:', error);
        showNotification('Erro ao enviar mensagem. Tente novamente.', 'error');
    } finally {
        setLoadingState(submitBtn, false);
    }
}

async function handleNewsletterSubmit(e) {
    e.preventDefault();
    
    const form = e.target;
    const formData = new FormData(form);
    const submitBtn = form.querySelector('button[type="submit"]');
    
    setLoadingState(submitBtn, true);
    
    try {
        const response = await fetch('includes/newsletter.php', {
            method: 'POST',
            body: formData
        });
        
        const result = await response.json();
        
        if (result.success) {
            showNotification('Inscrição realizada com sucesso!', 'success');
            form.reset();
        } else {
            showNotification(result.message || 'Erro na inscrição. Tente novamente.', 'error');
        }
    } catch (error) {
        console.error('Newsletter submission error:', error);
        showNotification('Erro na inscrição. Tente novamente.', 'error');
    } finally {
        setLoadingState(submitBtn, false);
    }
}

// Form validation
function validateForm(form) {
    const inputs = form.querySelectorAll('input[required], select[required], textarea[required]');
    let isValid = true;
    
    inputs.forEach(input => {
        if (!validateField(input)) {
            isValid = false;
        }
    });
    
    return isValid;
}

function validateField(field) {
    const value = field.value.trim();
    const fieldName = field.name;
    let isValid = true;
    let errorMessage = '';
    
    // Remove previous error state
    field.classList.remove('error');
    const existingError = field.parentNode.querySelector('.error-message');
    if (existingError) {
        existingError.remove();
    }
    
    // Required field validation
    if (field.hasAttribute('required') && !value) {
        isValid = false;
        errorMessage = 'Este campo é obrigatório.';
    }
    
    // Email validation
    else if (field.type === 'email' && value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(value)) {
            isValid = false;
            errorMessage = 'Por favor, insira um email válido.';
        }
    }
    
    // Phone validation
    else if (field.type === 'tel' && value) {
        const phoneRegex = /^\(\d{2}\)\s\d{4,5}-\d{4}$/;
        if (!phoneRegex.test(value)) {
            isValid = false;
            errorMessage = 'Por favor, insira um telefone válido.';
        }
    }
    
    // Name validation
    else if (fieldName === 'name' && value) {
        if (value.length < 2) {
            isValid = false;
            errorMessage = 'Nome deve ter pelo menos 2 caracteres.';
        }
    }
    
    // Show error if validation failed
    if (!isValid) {
        field.classList.add('error');
        const errorElement = document.createElement('span');
        errorElement.className = 'error-message';
        errorElement.textContent = errorMessage;
        field.parentNode.appendChild(errorElement);
    }
    
    return isValid;
}

// Phone number formatting
function formatPhoneNumber(value) {
    // Remove all non-digits
    const numbers = value.replace(/\D/g, '');
    
    // Format based on length
    if (numbers.length <= 2) {
        return `(${numbers}`;
    } else if (numbers.length <= 6) {
        return `(${numbers.slice(0, 2)}) ${numbers.slice(2)}`;
    } else if (numbers.length <= 10) {
        return `(${numbers.slice(0, 2)}) ${numbers.slice(2, 6)}-${numbers.slice(6)}`;
    } else {
        return `(${numbers.slice(0, 2)}) ${numbers.slice(2, 7)}-${numbers.slice(7, 11)}`;
    }
}

// ===== CHAT WIDGET =====
function initializeChatWidget() {
    const chatToggle = document.getElementById('chatToggle');
    const chatWindow = document.getElementById('chatWindow');
    const chatClose = document.getElementById('chatClose');
    const chatSend = document.getElementById('chatSend');
    const chatInput = document.getElementById('chatInput');
    const chatBody = document.querySelector('.chat-body');
    
    if (!chatToggle || !chatWindow) return;
    
    // Toggle chat window
    chatToggle.addEventListener('click', function() {
        chatWindow.classList.toggle('active');
    });
    
    // Close chat window
    if (chatClose) {
        chatClose.addEventListener('click', function() {
            chatWindow.classList.remove('active');
        });
    }
    
    // Send message
    function sendMessage() {
        const message = chatInput.value.trim();
        if (!message) return;
        
        // Add user message
        addChatMessage(message, 'user');
        chatInput.value = '';
        
        // Simulate bot response
        setTimeout(() => {
            const responses = [
                'Obrigado pela sua mensagem! Um de nossos especialistas entrará em contato em breve.',
                'Para análises de emergência, ligue para (11) 99999-9999.',
                'Você pode agendar uma coleta de amostra pelo nosso formulário de contato.',
                'Nossos cursos de certificação começam toda segunda-feira. Gostaria de mais informações?'
            ];
            const randomResponse = responses[Math.floor(Math.random() * responses.length)];
            addChatMessage(randomResponse, 'bot');
        }, 1000);
    }
    
    if (chatSend) {
        chatSend.addEventListener('click', sendMessage);
    }
    
    if (chatInput) {
        chatInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });
    }
    
    function addChatMessage(message, sender) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `chat-message ${sender}`;
        messageDiv.innerHTML = `<p>${message}</p>`;
        
        if (chatBody) {
            chatBody.appendChild(messageDiv);
            chatBody.scrollTop = chatBody.scrollHeight;
        }
    }
}

// ===== BACK TO TOP =====
function initializeBackToTop() {
    const backToTopBtn = document.getElementById('backToTop');
    
    if (!backToTopBtn) return;
    
    // Show/hide button based on scroll position
    window.addEventListener('scroll', function() {
        if (window.scrollY > 300) {
            backToTopBtn.classList.add('visible');
        } else {
            backToTopBtn.classList.remove('visible');
        }
    });
    
    // Smooth scroll to top
    backToTopBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

// ===== LOADING STATES =====
function initializeLoadingStates() {
    // Add loading states to buttons when needed
}

function setLoadingState(button, isLoading) {
    if (isLoading) {
        button.classList.add('loading');
        button.disabled = true;
        const originalText = button.innerHTML;
        button.setAttribute('data-original-text', originalText);
        button.innerHTML = '<span class="spinner"></span> Enviando...';
    } else {
        button.classList.remove('loading');
        button.disabled = false;
        const originalText = button.getAttribute('data-original-text');
        if (originalText) {
            button.innerHTML = originalText;
        }
    }
}

// ===== SMOOTH SCROLLING =====
function initializeSmoothScrolling() {
    // Smooth scrolling for anchor links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            
            // Skip if href is just "#"
            if (href === '#') return;
            
            const targetElement = document.querySelector(href);
            
            if (targetElement) {
                e.preventDefault();
                
                const headerHeight = document.querySelector('.header').offsetHeight;
                const targetPosition = targetElement.offsetTop - headerHeight - 20;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
}

// ===== NOTIFICATIONS =====
function showNotification(message, type = 'info') {
    // Remove existing notifications
    const existingNotifications = document.querySelectorAll('.notification');
    existingNotifications.forEach(notification => notification.remove());
    
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <div class="notification-content">
            <span class="notification-message">${message}</span>
            <button class="notification-close" aria-label="Fechar notificação">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    
    // Add styles
    const styles = `
        .notification {
            position: fixed;
            top: 100px;
            right: 20px;
            max-width: 400px;
            padding: 16px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 9999;
            transform: translateX(100%);
            transition: transform 0.3s ease-in-out;
        }
        
        .notification.show {
            transform: translateX(0);
        }
        
        .notification-success {
            background-color: #10b981;
            color: white;
        }
        
        .notification-error {
            background-color: #ef4444;
            color: white;
        }
        
        .notification-info {
            background-color: #3b82f6;
            color: white;
        }
        
        .notification-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }
        
        .notification-close {
            background: none;
            border: none;
            color: inherit;
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
            opacity: 0.8;
            transition: opacity 0.2s;
        }
        
        .notification-close:hover {
            opacity: 1;
        }
    `;
    
    // Add styles to head if not already added
    if (!document.querySelector('#notification-styles')) {
        const styleSheet = document.createElement('style');
        styleSheet.id = 'notification-styles';
        styleSheet.textContent = styles;
        document.head.appendChild(styleSheet);
    }
    
    // Add to DOM
    document.body.appendChild(notification);
    
    // Show notification
    setTimeout(() => {
        notification.classList.add('show');
    }, 100);
    
    // Add close functionality
    const closeBtn = notification.querySelector('.notification-close');
    closeBtn.addEventListener('click', () => {
        notification.classList.remove('show');
        setTimeout(() => {
            notification.remove();
        }, 300);
    });
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (notification.parentNode) {
            notification.classList.remove('show');
            setTimeout(() => {
                notification.remove();
            }, 300);
        }
    }, 5000);
}

// ===== UTILITY FUNCTIONS =====

// Debounce function
function debounce(func, wait, immediate) {
    let timeout;
    return function executedFunction() {
        const context = this;
        const args = arguments;
        const later = function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        const callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
}

// Throttle function
function throttle(func, limit) {
    let inThrottle;
    return function() {
        const args = arguments;
        const context = this;
        if (!inThrottle) {
            func.apply(context, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
}

// Check if element is in viewport
function isInViewport(element) {
    const rect = element.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
}

// Format currency (Brazilian Real)
function formatCurrency(value) {
    return new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL'
    }).format(value);
}

// Format date (Brazilian format)
function formatDate(date) {
    return new Intl.DateTimeFormat('pt-BR').format(new Date(date));
}

// ===== ERROR HANDLING =====
window.addEventListener('error', function(e) {
    console.error('JavaScript Error:', e.error);
    // You could send error reports to a logging service here
});

window.addEventListener('unhandledrejection', function(e) {
    console.error('Unhandled Promise Rejection:', e.reason);
    // You could send error reports to a logging service here
});

// ===== PERFORMANCE OPTIMIZATION =====

// Lazy loading for images (if not using native lazy loading)
function initializeLazyLoading() {
    const images = document.querySelectorAll('img[data-src]');
    
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        images.forEach(img => imageObserver.observe(img));
    } else {
        // Fallback for browsers without IntersectionObserver
        images.forEach(img => {
            img.src = img.dataset.src;
            img.classList.remove('lazy');
        });
    }
}

// Preload critical resources
function preloadCriticalResources() {
    const criticalImages = [
        'assets/images/hero-bg.jpg',
        'assets/images/logo.png'
    ];
    
    criticalImages.forEach(imagePath => {
        const link = document.createElement('link');
        link.rel = 'preload';
        link.as = 'image';
        link.href = imagePath;
        document.head.appendChild(link);
    });
}

// Initialize performance optimizations
document.addEventListener('DOMContentLoaded', function() {
    initializeLazyLoading();
    preloadCriticalResources();
});