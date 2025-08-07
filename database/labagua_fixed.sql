-- =============================================
-- LabÁgua Database Schema - VERSÃO CORRIGIDA
-- Banco de dados para sistema de análise de água
-- =============================================

-- Criar banco de dados
CREATE DATABASE IF NOT EXISTS labagua CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE labagua;

-- =============================================
-- Tabela de Administradores (PRIMEIRA - sem dependências)
-- =============================================
CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('super_admin', 'admin', 'editor') DEFAULT 'admin',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    status ENUM('active', 'inactive') DEFAULT 'active'
);

-- =============================================
-- Tabela de Posts/Artigos (SEGUNDA - sem dependências)
-- =============================================
CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content LONGTEXT NOT NULL,
    author VARCHAR(100) NOT NULL,
    date DATETIME DEFAULT CURRENT_TIMESTAMP,
    status ENUM('published', 'draft', 'archived') DEFAULT 'published',
    featured_image VARCHAR(255) NULL,
    excerpt TEXT NULL,
    slug VARCHAR(255) NULL,
    meta_description TEXT NULL,
    views INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_status (status),
    INDEX idx_date (date),
    INDEX idx_slug (slug)
);

-- =============================================
-- Tabela de Membros da Equipe (TERCEIRA - sem dependências)
-- =============================================
CREATE TABLE IF NOT EXISTS membros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cargo VARCHAR(100) NOT NULL,
    especialidade VARCHAR(150) NULL,
    bio TEXT NULL,
    lattes VARCHAR(255) NULL,
    orcid VARCHAR(50) NULL,
    email VARCHAR(100) NULL,
    telefone VARCHAR(20) NULL,
    foto LONGBLOB NULL,
    foto_nome VARCHAR(255) NULL,
    foto_tipo VARCHAR(50) NULL,
    status ENUM('pendente', 'aprovado', 'rejeitado') DEFAULT 'pendente',
    ordem_exibicao INT DEFAULT 0,
    linkedin VARCHAR(255) NULL,
    researchgate VARCHAR(255) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_status (status),
    INDEX idx_ordem (ordem_exibicao)
);

-- =============================================
-- Tabela de Contatos/Mensagens (QUARTA - depende de admin)
-- =============================================
CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NULL,
    service VARCHAR(50) NULL,
    subject VARCHAR(200) NULL,
    message TEXT NOT NULL,
    status ENUM('new', 'read', 'replied', 'archived') DEFAULT 'new',
    priority ENUM('low', 'normal', 'high', 'urgent') DEFAULT 'normal',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    replied_at TIMESTAMP NULL,
    replied_by INT NULL,
    notes TEXT NULL,
    INDEX idx_status (status),
    INDEX idx_created (created_at),
    FOREIGN KEY (replied_by) REFERENCES admin(id) ON DELETE SET NULL
);

-- =============================================
-- Tabela de Newsletter/Inscritos (QUINTA - sem dependências)
-- =============================================
CREATE TABLE IF NOT EXISTS subscribers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    name VARCHAR(100) NULL,
    status ENUM('active', 'inactive', 'unsubscribed') DEFAULT 'active',
    subscribed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    unsubscribed_at TIMESTAMP NULL,
    source VARCHAR(50) DEFAULT 'website',
    preferences JSON NULL,
    INDEX idx_email_status (email, status)
);

-- =============================================
-- Tabela de Configurações do Sistema (SEXTA - sem dependências)
-- =============================================
CREATE TABLE IF NOT EXISTS settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) NOT NULL UNIQUE,
    setting_value TEXT NULL,
    setting_type ENUM('string', 'number', 'boolean', 'json') DEFAULT 'string',
    description TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- =============================================
-- Tabela de Logs do Sistema (SÉTIMA - depende de admin)
-- =============================================
CREATE TABLE IF NOT EXISTS system_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NULL,
    action VARCHAR(100) NOT NULL,
    table_name VARCHAR(50) NULL,
    record_id INT NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    details JSON NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES admin(id) ON DELETE SET NULL,
    INDEX idx_action (action),
    INDEX idx_created (created_at)
);

-- =============================================
-- Tabela de Análises Solicitadas (OITAVA - depende de admin)
-- =============================================
CREATE TABLE IF NOT EXISTS analysis_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    request_number VARCHAR(20) NOT NULL UNIQUE,
    client_name VARCHAR(100) NOT NULL,
    client_email VARCHAR(100) NOT NULL,
    client_phone VARCHAR(20) NULL,
    client_address TEXT NULL,
    analysis_type ENUM('residential', 'commercial', 'industrial', 'emergency') NOT NULL,
    package_type ENUM('basic', 'complete', 'professional') NOT NULL,
    sample_collection_method ENUM('pickup', 'delivery', 'lab_dropoff') DEFAULT 'pickup',
    collection_date DATE NULL,
    collection_time TIME NULL,
    special_instructions TEXT NULL,
    status ENUM('pending', 'collected', 'analyzing', 'completed', 'delivered', 'cancelled') DEFAULT 'pending',
    price DECIMAL(10,2) NULL,
    payment_status ENUM('pending', 'paid', 'cancelled') DEFAULT 'pending',
    results_file VARCHAR(255) NULL,
    notes TEXT NULL,
    assigned_to INT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (assigned_to) REFERENCES admin(id) ON DELETE SET NULL,
    INDEX idx_status (status),
    INDEX idx_request_number (request_number),
    INDEX idx_client_email (client_email),
    INDEX idx_created (created_at)
);

-- =============================================
-- Tabela de Comentários (NONA - depende de posts)
-- =============================================
CREATE TABLE IF NOT EXISTS comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    comment TEXT NOT NULL,
    status ENUM('approved', 'pending', 'rejected') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE,
    INDEX idx_post_status (post_id, status)
);

-- =============================================
-- DADOS INICIAIS
-- =============================================

-- Inserir administrador padrão
INSERT INTO admin (name, email, password, role, status) VALUES 
('Administrador', 'admin@labagua.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'super_admin', 'active');

-- Inserir posts de exemplo
INSERT INTO posts (title, content, author, status, excerpt) VALUES 
('Qualidade da Água: Por que é Importante?', 'A qualidade da água é fundamental para a saúde humana e ambiental. Neste artigo, exploramos os principais parâmetros que determinam se a água é segura para consumo...', 'Dr. Carlos Silva', 'published', 'Entenda os parâmetros que determinam a qualidade da água e sua importância para a saúde.'),
('Análise Microbiológica da Água', 'A análise microbiológica é essencial para detectar a presença de microrganismos patogênicos na água. Vamos explicar os métodos utilizados em nosso laboratório...', 'Dra. Maria Santos', 'published', 'Conheça os métodos de análise microbiológica utilizados para garantir água segura.'),
('Legislação Brasileira sobre Qualidade da Água', 'A legislação brasileira estabelece padrões rigorosos para a qualidade da água. Neste artigo, apresentamos as principais normas e regulamentações...', 'Dr. João Oliveira', 'published', 'Conheça as principais normas e regulamentações sobre qualidade da água no Brasil.');

-- Inserir membros de exemplo
INSERT INTO membros (nome, cargo, especialidade, bio, lattes, status) VALUES 
('Dr. Carlos Silva', 'Diretor Técnico', 'Análise de Qualidade da Água', 'Especialista com mais de 15 anos de experiência em análise de qualidade da água e gestão de laboratórios.', 'http://lattes.cnpq.br/123456789', 'aprovado'),
('Dra. Maria Santos', 'Coordenadora de Análises', 'Microbiologia da Água', 'Doutora em Microbiologia com especialização em análise de água para consumo humano.', 'http://lattes.cnpq.br/987654321', 'aprovado'),
('Dr. João Oliveira', 'Especialista em Qualidade', 'Química Analítica', 'Especialista em métodos analíticos para determinação de contaminantes em água.', 'http://lattes.cnpq.br/456789123', 'aprovado');

-- Inserir configurações padrão
INSERT INTO settings (setting_key, setting_value, setting_type, description) VALUES 
('site_name', 'LabÁgua', 'string', 'Nome do site'),
('site_description', 'Laboratório de Análise de Qualidade da Água', 'string', 'Descrição do site'),
('contact_email', 'contato@labagua.com', 'string', 'Email de contato principal'),
('contact_phone', '(11) 99999-9999', 'string', 'Telefone de contato'),
('address', 'Rua das Análises, 123 - São Paulo, SP', 'string', 'Endereço do laboratório'),
('business_hours', 'Segunda a Sexta: 8h às 18h', 'string', 'Horário de funcionamento'),
('emergency_phone', '(11) 99999-8888', 'string', 'Telefone de emergência'),
('iso_certification', 'ISO 17025', 'string', 'Certificação ISO'),
('maintenance_mode', 'false', 'boolean', 'Modo de manutenção');

-- =============================================
-- ÍNDICES ADICIONAIS
-- =============================================
CREATE INDEX idx_posts_author_date ON posts(author, date);
CREATE INDEX idx_contacts_email ON contacts(email);
CREATE INDEX idx_members_nome ON membros(nome);
CREATE INDEX idx_analysis_client ON analysis_requests(client_email, status);

-- =============================================
-- VIEWS PARA ESTATÍSTICAS
-- =============================================
CREATE VIEW post_stats AS
SELECT 
    COUNT(*) as total_posts,
    COUNT(CASE WHEN status = 'published' THEN 1 END) as published_posts,
    COUNT(CASE WHEN status = 'draft' THEN 1 END) as draft_posts
FROM posts;

CREATE VIEW member_stats AS
SELECT 
    COUNT(*) as total_members,
    COUNT(CASE WHEN status = 'aprovado' THEN 1 END) as approved_members,
    COUNT(CASE WHEN status = 'pendente' THEN 1 END) as pending_members
FROM membros;

CREATE VIEW contact_stats AS
SELECT 
    COUNT(*) as total_contacts,
    COUNT(CASE WHEN status = 'new' THEN 1 END) as new_contacts,
    COUNT(CASE WHEN status = 'read' THEN 1 END) as read_contacts,
    COUNT(CASE WHEN status = 'replied' THEN 1 END) as replied_contacts
FROM contacts;

-- =============================================
-- FIM DO SCRIPT
-- =============================================
