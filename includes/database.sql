-- LabÁgua Database Schema
-- SQL script to create the necessary database tables

-- Create database (run this first)
-- CREATE DATABASE labagua_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
-- USE labagua_db;

-- Contacts table for form submissions
CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    service VARCHAR(50) NOT NULL,
    message TEXT,
    newsletter TINYINT(1) DEFAULT 0,
    ip VARCHAR(45),
    user_agent TEXT,
    status ENUM('new', 'contacted', 'converted', 'closed') DEFAULT 'new',
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_status (status),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Newsletter subscribers table
CREATE TABLE IF NOT EXISTS newsletter_subscribers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    name VARCHAR(255),
    ip VARCHAR(45),
    user_agent TEXT,
    status ENUM('active', 'unsubscribed', 'bounced') DEFAULT 'active',
    source VARCHAR(50) DEFAULT 'website',
    subscribed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    unsubscribed_at TIMESTAMP NULL,
    last_email_sent TIMESTAMP NULL,
    email_count INT DEFAULT 0,
    INDEX idx_email (email),
    INDEX idx_status (status),
    INDEX idx_subscribed_at (subscribed_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Email campaigns table (for future use)
CREATE TABLE IF NOT EXISTS email_campaigns (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    content TEXT,
    html_content LONGTEXT,
    status ENUM('draft', 'scheduled', 'sending', 'sent', 'cancelled') DEFAULT 'draft',
    scheduled_at TIMESTAMP NULL,
    sent_at TIMESTAMP NULL,
    recipient_count INT DEFAULT 0,
    opened_count INT DEFAULT 0,
    clicked_count INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_status (status),
    INDEX idx_scheduled_at (scheduled_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Email tracking table (for analytics)
CREATE TABLE IF NOT EXISTS email_tracking (
    id INT AUTO_INCREMENT PRIMARY KEY,
    campaign_id INT,
    subscriber_id INT,
    email VARCHAR(255) NOT NULL,
    event_type ENUM('sent', 'delivered', 'opened', 'clicked', 'bounced', 'unsubscribed') NOT NULL,
    event_data JSON,
    ip VARCHAR(45),
    user_agent TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (campaign_id) REFERENCES email_campaigns(id) ON DELETE SET NULL,
    FOREIGN KEY (subscriber_id) REFERENCES newsletter_subscribers(id) ON DELETE SET NULL,
    INDEX idx_campaign_id (campaign_id),
    INDEX idx_subscriber_id (subscriber_id),
    INDEX idx_email (email),
    INDEX idx_event_type (event_type),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Services table (for course/service management)
CREATE TABLE IF NOT EXISTS services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    description TEXT,
    price DECIMAL(10,2),
    duration_hours INT,
    category ENUM('analysis', 'course', 'consultation') NOT NULL,
    status ENUM('active', 'inactive') DEFAULT 'active',
    features JSON,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_slug (slug),
    INDEX idx_category (category),
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default services
INSERT INTO services (name, slug, description, price, duration_hours, category, features) VALUES
('Análise Residencial', 'analise-residencial', 'Testes essenciais de qualidade da água para uso doméstico', 149.00, 24, 'analysis', 
 JSON_ARRAY('Análise microbiológica básica', 'pH e cloro', 'Turbidez e cor', 'Relatório digital', 'Resultado em 48h')),
 
('Análise Comercial', 'analise-comercial', 'Análise completa para estabelecimentos comerciais', 289.00, 24, 'analysis',
 JSON_ARRAY('Conformidade ANVISA', 'Laudos técnicos', 'Monitoramento contínuo', 'Suporte técnico')),
 
('Análise Industrial', 'analise-industrial', 'Testes especializados para uso industrial', 449.00, 48, 'analysis',
 JSON_ARRAY('Análises customizadas', 'Controle de processo', 'Certificações ambientais', 'Consultoria especializada')),
 
('Certificado Básico em Análise de Água', 'curso-basico', 'Fundamentos da análise de água e interpretação de resultados', 890.00, 40, 'course',
 JSON_ARRAY('Princípios da qualidade da água', 'Técnicas de coleta', 'Análises físico-químicas básicas', 'Interpretação de laudos')),
 
('Técnicas Laboratoriais Avançadas', 'curso-avancado', 'Métodos avançados de análise e controle de qualidade', 1590.00, 80, 'course',
 JSON_ARRAY('Cromatografia e espectrometria', 'Microbiologia da água', 'Controle de qualidade', 'Validação de métodos')),
 
('Gestão de Segurança da Água', 'curso-gestao', 'Planejamento e implementação de sistemas de gestão', 1290.00, 60, 'course',
 JSON_ARRAY('Legislação e normas', 'Planos de segurança', 'Monitoramento contínuo', 'Auditoria e certificação'));

-- User roles table (for admin panel - future use)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    full_name VARCHAR(255),
    role ENUM('admin', 'manager', 'analyst') DEFAULT 'analyst',
    status ENUM('active', 'inactive') DEFAULT 'active',
    last_login TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_username (username),
    INDEX idx_email (email),
    INDEX idx_role (role)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default admin user (password: admin123 - change this!)
-- Password hash for 'admin123' - CHANGE THIS IN PRODUCTION!
INSERT INTO users (username, email, password_hash, full_name, role) VALUES
('admin', 'admin@labagua.com.br', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrador', 'admin');

-- Settings table for site configuration
CREATE TABLE IF NOT EXISTS settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) NOT NULL UNIQUE,
    setting_value TEXT,
    setting_type ENUM('string', 'number', 'boolean', 'json') DEFAULT 'string',
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_setting_key (setting_key)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default settings
INSERT INTO settings (setting_key, setting_value, setting_type, description) VALUES
('site_name', 'LabÁgua', 'string', 'Nome do site'),
('site_email', 'contato@labagua.com.br', 'string', 'Email principal do site'),
('site_phone', '(11) 3456-7890', 'string', 'Telefone principal'),
('site_emergency_phone', '(11) 99999-9999', 'string', 'Telefone de emergência'),
('site_address', 'Rua das Análises, 123 - Centro, São Paulo - SP - CEP: 01234-567', 'string', 'Endereço completo'),
('business_hours', 'Segunda a Sexta: 8h às 18h, Sábado: 8h às 12h', 'string', 'Horário de funcionamento'),
('smtp_host', 'smtp.hostinger.com', 'string', 'Servidor SMTP'),
('smtp_port', '587', 'number', 'Porta SMTP'),
('smtp_username', 'contato@labagua.com.br', 'string', 'Usuário SMTP'),
('newsletter_enabled', '1', 'boolean', 'Newsletter habilitada'),
('contact_form_enabled', '1', 'boolean', 'Formulário de contato habilitado'),
('analytics_code', '', 'string', 'Código do Google Analytics'),
('facebook_url', '', 'string', 'URL do Facebook'),
('instagram_url', '', 'string', 'URL do Instagram'),
('linkedin_url', '', 'string', 'URL do LinkedIn'),
('youtube_url', '', 'string', 'URL do YouTube');

-- Create indexes for better performance
ALTER TABLE contacts ADD INDEX idx_service (service);
ALTER TABLE contacts ADD INDEX idx_newsletter (newsletter);

-- Create a view for contact statistics
CREATE VIEW contact_stats AS
SELECT 
    DATE(created_at) as date,
    COUNT(*) as total_contacts,
    COUNT(CASE WHEN newsletter = 1 THEN 1 END) as newsletter_signups,
    COUNT(CASE WHEN service = 'residencial' THEN 1 END) as residential,
    COUNT(CASE WHEN service = 'comercial' THEN 1 END) as commercial,
    COUNT(CASE WHEN service = 'industrial' THEN 1 END) as industrial,
    COUNT(CASE WHEN service = 'curso' THEN 1 END) as courses,
    COUNT(CASE WHEN service = 'emergencia' THEN 1 END) as emergency
FROM contacts 
GROUP BY DATE(created_at)
ORDER BY date DESC;

-- Create a view for newsletter statistics
CREATE VIEW newsletter_stats AS
SELECT 
    DATE(subscribed_at) as date,
    COUNT(*) as new_subscribers,
    COUNT(CASE WHEN status = 'active' THEN 1 END) as active_subscribers,
    COUNT(CASE WHEN status = 'unsubscribed' THEN 1 END) as unsubscribed
FROM newsletter_subscribers 
GROUP BY DATE(subscribed_at)
ORDER BY date DESC;