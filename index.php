<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="LabÁgua - Análise Profissional de Água. Testes precisos para residencial, comercial e industrial. Resultados em 24-48 horas.">
    <meta name="keywords" content="análise de água, laboratório, qualidade da água, testes de água, certificação ISO">
    <title>LabÁgua - Análise Precisa de Água. Resultados Confiáveis.</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">
    
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body>
    <!-- Accessibility Bar -->
    <?php include_once 'components/accessibility_bar.php'; ?>
    
    <!-- Header -->
    <?php include_once 'components/header/header.php'; ?>

    <!-- Hero Section -->
    <main id="main-content">
        <?php include_once 'components/sections/hero_section.php'; ?>

        <!-- Services Section -->
        <?php include_once 'components/sections/services_section.php'; ?>

        <!-- Service Portal Section -->
        <?php include_once 'components/sections/service_portal_section.php'; ?>

        <!-- Why Choose Section -->
        <?php include_once 'components/sections/why_choose_section.php'; ?>

        <!-- Courses Section -->
        <?php include_once 'components/sections/courses_section.php'; ?>

        <!-- Process Section -->
        <?php include_once 'components/sections/process_section.php'; ?>

        <!-- Articles Section -->
        <?php include_once 'components/sections/articles_section.php'; ?>


    <!-- Members Section -->
    <?php include_once 'components/sections/members_section.php'; ?>

        <!-- Members Section -->
        <?php include_once 'components/sections/members_section.php'; ?>

        <!-- Feedback Section -->
        <?php include_once 'components/sections/feedback_section.php'; ?>

        <!-- Pricing Section -->
        <?php include_once 'components/sections/pricing_section.php'; ?>

        <!-- Emergency Care Section -->
        <?php include_once 'components/sections/emergency_care.php'; ?>

        <!-- Certifications -->
        <?php include_once 'components/sections/certifications_section.php'; ?>

        <!-- Contact Section -->
        <?php include_once 'components/sections/contact_section.php'; ?>

        <!-- Transparency Section -->
        <?php include_once 'components/sections/transparency_section.php'; ?>

        <!-- Institutional Numbers -->
        <?php include_once 'components/sections/institucional_numbers_section.php'; ?>

    </main>

    <!-- Footer -->
    <?php include 'components/footer/footer.php'; ?>

    <!-- Back to Top Button -->
    <button id="backToTop" class="back-to-top" aria-label="Voltar ao topo">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Live Chat Widget -->
    <div id="chatWidget" class="chat-widget">
        <div class="chat-toggle" id="chatToggle">
            <i class="fas fa-comments"></i>
        </div>
        <div class="chat-window" id="chatWindow">
            <div class="chat-header">
                <h4>Chat Online</h4>
                <button class="chat-close" id="chatClose">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="chat-body">
                <div class="chat-message bot">
                    <p>Olá! Como posso ajudá-lo com análise de água?</p>
                </div>
            </div>
            <div class="chat-footer">
                <input type="text" placeholder="Digite sua mensagem..." id="chatInput">
                <button id="chatSend">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>