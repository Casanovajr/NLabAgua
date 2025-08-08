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
    <div class="accessibility-bar">
        <div class="container">
            <div class="accessibility-controls">
                <button class="accessibility-btn" id="highContrast" title="Alto Contraste">
                    <i class="fas fa-adjust"></i>
                    Alto Contraste
                </button>
                <div class="font-size-controls">
                    <button class="accessibility-btn" id="smallFont" title="Diminuir Fonte" aria-label="Diminuir Fonte (A-)" >A-</button>
                    <button class="accessibility-btn" id="normalFont" aria-label="Fonte Normal" title="Fonte Normal">A</button>
                    <button class="accessibility-btn" id="largeFont" title="Aumentar Fonte" aria-label="Aumentar Fonte (A+)" >A+</button>
                </div>
                
            </div>
            <div class="institutional-links">
                <a href="#transparencia" class="institutional-link">
                    <i class="fas fa-eye"></i>
                    Transparência
                </a>
                <a href="#certificacoes" class="institutional-link">
                    <i class="fas fa-certificate"></i>
                    Certificações
                </a>
            </div>
        </div>
    </div>
    
    <!-- Header -->
    <?php include_once 'components/header/header.php'; ?>

    <!-- Hero Section -->
    <main id="main-content">
    <section class="hero" id="inicio">
        <div class="hero-background">
            <div class="hero-overlay">
                <img src="images/wallpaper1.jpg" alt="LabÁgua">
            </div>
        </div>
        <div class="container">
            <div class="hero-content" data-aos="fade-up">
                <h1 class="hero-title">
                    <span class="hero-main-text">Análise Precisa de Água</span><br>
                    <span class="text-gradient">Resultados Confiáveis</span>
                </h1>
                <p class="hero-subtitle">
                    Testes laboratoriais profissionais para avaliação da qualidade da água residencial, comercial e industrial
                </p>
                <div class="hero-cta">
                    <a href="#contato" class="btn btn-primary btn-large">Testar Água Agora</a>
                    <a href="#servicos" class="btn btn-secondary btn-large">Ver Tipos de Teste</a>
                </div>
                <div class="trust-indicators">
                    <div class="trust-item">
                        <i class="fas fa-award"></i>
                        <span>Certificado ISO 17025</span>
                    </div>
                    <div class="trust-item">
                        <i class="fas fa-clock"></i>
                        <span>Resultados em 24-48h</span>
                    </div>
                    <div class="trust-item">
                        <i class="fas fa-chart-line"></i>
                        <span>+15 Anos de Experiência</span>
                    </div>
                    <div class="trust-item">
                        <i class="fas fa-users"></i>
                        <span>+10.000 Clientes Atendidos</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services" id="servicos">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Nossos Serviços</h2>
                <p class="section-subtitle">Soluções completas em análise de água para todas as suas necessidades</p>
            </div>
            
            <div class="services-grid">
                <div class="service-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-icon">
                        <i class="fas fa-home"></i>
                    </div>
                    <h3 class="service-title">Análise Residencial</h3>
                    <p class="service-description">
                        Qualidade da água doméstica, água de poço e segurança da água potável para sua família
                    </p>
                    <ul class="service-features">
                        <li><i class="fas fa-check"></i> Análise microbiológica</li>
                        <li><i class="fas fa-check"></i> Metais pesados</li>
                        <li><i class="fas fa-check"></i> Cloro e pH</li>
                        <li><i class="fas fa-check"></i> Relatório detalhado</li>
                    </ul>
                    <a href="#contato" class="btn btn-outline">Solicitar Teste</a>
                </div>
                
                <div class="service-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <h3 class="service-title">Análise Comercial</h3>
                    <p class="service-description">
                        Conformidade para restaurantes, hotéis e empresas com as normas sanitárias vigentes
                    </p>
                    <ul class="service-features">
                        <li><i class="fas fa-check"></i> Conformidade ANVISA</li>
                        <li><i class="fas fa-check"></i> Laudos técnicos</li>
                        <li><i class="fas fa-check"></i> Monitoramento contínuo</li>
                        <li><i class="fas fa-check"></i> Suporte técnico</li>
                    </ul>
                    <a href="#contato" class="btn btn-outline">Solicitar Teste</a>
                </div>
                
                <div class="service-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-icon">
                        <i class="fas fa-industry"></i>
                    </div>
                    <h3 class="service-title">Análise Industrial</h3>
                    <p class="service-description">
                        Testes especializados para manufatura, agricultura e necessidades industriais específicas
                    </p>
                    <ul class="service-features">
                        <li><i class="fas fa-check"></i> Análises customizadas</li>
                        <li><i class="fas fa-check"></i> Controle de processo</li>
                        <li><i class="fas fa-check"></i> Certificações ambientais</li>
                        <li><i class="fas fa-check"></i> Consultoria especializada</li>
                    </ul>
                    <a href="#contato" class="btn btn-outline">Solicitar Teste</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Service Portal Section -->
    <section class="service-portal">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Portal de <strong>Serviços</strong></h2>
                <p class="section-subtitle">
                    O Portal de Serviços LabÁgua é sua alternativa online para solicitações de análise. 
                    Informações e serviços especializados em qualidade da água estão centralizados neste portal.
                </p>
            </div>
            
            <div class="service-categories" data-aos="fade-up" data-aos-delay="100">
                <div class="category-tabs">
                    <button class="category-tab active" data-category="residencial">
                        <i class="fas fa-home"></i>
                        <span>Residencial</span>
                    </button>
                    <button class="category-tab" data-category="empresarial">
                        <i class="fas fa-building"></i>
                        <span>Empresarial</span>
                    </button>
                    <button class="category-tab" data-category="industrial">
                        <i class="fas fa-industry"></i>
                        <span>Industrial</span>
                    </button>
                    <button class="category-tab" data-category="educacional">
                        <i class="fas fa-graduation-cap"></i>
                        <span>Educacional</span>
                    </button>
                </div>
                
                <div class="service-grid" id="serviceGrid">
                    <!-- Residencial Services -->
                    <div class="service-item" data-category="residencial">
                        <i class="fas fa-tint"></i>
                        <span>Análise de Água Potável</span>
                    </div>
                    <div class="service-item" data-category="residencial">
                        <i class="fas fa-microscope"></i>
                        <span>Teste Microbiológico</span>
                    </div>
                    <div class="service-item" data-category="residencial">
                        <i class="fas fa-vial"></i>
                        <span>Análise de Poço Artesiano</span>
                    </div>
                    <div class="service-item" data-category="residencial">
                        <i class="fas fa-shield-alt"></i>
                        <span>Certificado de Potabilidade</span>
                    </div>
                    <div class="service-item" data-category="residencial">
                        <i class="fas fa-file-alt"></i>
                        <span>Laudo Técnico Residencial</span>
                    </div>
                    <div class="service-item" data-category="residencial">
                        <i class="fas fa-phone"></i>
                        <span>Consultoria Domiciliar</span>
                    </div>
                </div>
                
                <div class="portal-cta" data-aos="fade-up" data-aos-delay="200">
                    <a href="#contato" class="btn btn-primary btn-large">
                        <i class="fas fa-arrow-right"></i>
                        Acessar Portal de Serviços
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Section -->
    <section class="why-choose">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Por que Escolher a LabÁgua</h2>
                <p class="section-subtitle">Mais de 15 anos de experiência em análise de água com os mais altos padrões de qualidade e precisão científica</p>
            </div>
            
            <div class="features-grid">
                <div class="feature-item" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-icon">
                        <i class="fas fa-award"></i>
                    </div>
                    <h3 class="feature-title">Excelência Certificada</h3>
                    <p class="feature-description">Laboratório credenciado ISO 17025 e certificado pela ANVISA, seguindo rigorosamente os protocolos internacionais de qualidade</p>
                </div>
                
                <div class="feature-item" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3 class="feature-title">Resultados Rápidos</h3>
                    <p class="feature-description">Maioria dos testes concluídos em 24-48 horas com precisão garantida</p>
                </div>
                
                <div class="feature-item" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h3 class="feature-title">Relatórios Completos</h3>
                    <p class="feature-description">Análises detalhadas e fáceis de entender com recomendações práticas</p>
                </div>
                
                <div class="feature-item" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-icon">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <h3 class="feature-title">Consultoria Especializada</h3>
                    <p class="feature-description">Interpretação gratuita dos resultados com cada teste realizado</p>
                </div>
                
                <div class="feature-item" data-aos="fade-up" data-aos-delay="500">
                    <div class="feature-icon">
                        <i class="fas fa-microscope"></i>
                    </div>
                    <h3 class="feature-title">Tecnologia Avançada</h3>
                    <p class="feature-description">Equipamentos de última geração para análises mais precisas</p>
                </div>
                
                <div class="feature-item" data-aos="fade-up" data-aos-delay="600">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="feature-title">Garantia de Qualidade</h3>
                    <p class="feature-description">Satisfação garantida ou refazemos o teste sem custo adicional</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Courses Section -->
    <section class="courses" id="cursos">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Cursos de Certificação</h2>
                <p class="section-subtitle">Capacite-se em análise e gestão da qualidade da água</p>
            </div>
            
            <div class="courses-grid">
                <div class="course-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="course-header">
                        <h3 class="course-title">Certificado Básico em Análise de Água</h3>
                        <div class="course-duration">40 horas</div>
                    </div>
                    <div class="course-content">
                        <p class="course-description">Fundamentos da análise de água, coleta de amostras e interpretação de resultados básicos.</p>
                        <ul class="course-topics">
                            <li><i class="fas fa-check"></i> Princípios da qualidade da água</li>
                            <li><i class="fas fa-check"></i> Técnicas de coleta</li>
                            <li><i class="fas fa-check"></i> Análises físico-químicas básicas</li>
                            <li><i class="fas fa-check"></i> Interpretação de laudos</li>
                        </ul>
                        <div class="course-price">R$ 890</div>
                        <a href="#contato" class="btn btn-primary">Inscrever-se</a>
                    </div>
                </div>
                
                <div class="course-card featured" data-aos="fade-up" data-aos-delay="200">
                    <div class="course-badge">Mais Procurado</div>
                    <div class="course-header">
                        <h3 class="course-title">Técnicas Laboratoriais Avançadas</h3>
                        <div class="course-duration">80 horas</div>
                    </div>
                    <div class="course-content">
                        <p class="course-description">Métodos avançados de análise, equipamentos especializados e controle de qualidade laboratorial.</p>
                        <ul class="course-topics">
                            <li><i class="fas fa-check"></i> Cromatografia e espectrometria</li>
                            <li><i class="fas fa-check"></i> Microbiologia da água</li>
                            <li><i class="fas fa-check"></i> Controle de qualidade</li>
                            <li><i class="fas fa-check"></i> Validação de métodos</li>
                        </ul>
                        <div class="course-price">R$ 1.590</div>
                        <a href="#contato" class="btn btn-primary">Inscrever-se</a>
                    </div>
                </div>
                
                <div class="course-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="course-header">
                        <h3 class="course-title">Gestão de Segurança da Água</h3>
                        <div class="course-duration">60 horas</div>
                    </div>
                    <div class="course-content">
                        <p class="course-description">Planejamento e implementação de sistemas de gestão da qualidade da água em organizações.</p>
                        <ul class="course-topics">
                            <li><i class="fas fa-check"></i> Legislação e normas</li>
                            <li><i class="fas fa-check"></i> Planos de segurança</li>
                            <li><i class="fas fa-check"></i> Monitoramento contínuo</li>
                            <li><i class="fas fa-check"></i> Auditoria e certificação</li>
                        </ul>
                        <div class="course-price">R$ 1.290</div>
                        <a href="#contato" class="btn btn-primary">Inscrever-se</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Section -->
    <section class="process">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Processo de Análise</h2>
                <p class="section-subtitle">Simples, rápido e confiável em 4 etapas</p>
            </div>
            
            <div class="process-steps">
                <div class="process-step" data-aos="fade-up" data-aos-delay="100">
                    <div class="step-number">1</div>
                    <div class="step-icon">
                        <i class="fas fa-box"></i>
                    </div>
                    <h3 class="step-title">Coleta da Amostra</h3>
                    <p class="step-description">Entregamos kit de coleta ou você pode deixar a amostra em nosso laboratório</p>
                </div>
                
                <div class="process-step" data-aos="fade-up" data-aos-delay="200">
                    <div class="step-number">2</div>
                    <div class="step-icon">
                        <i class="fas fa-flask"></i>
                    </div>
                    <h3 class="step-title">Análise Laboratorial</h3>
                    <p class="step-description">Procedimentos de teste avançados com equipamentos de última geração</p>
                </div>
                
                <div class="process-step" data-aos="fade-up" data-aos-delay="300">
                    <div class="step-number">3</div>
                    <div class="step-icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <h3 class="step-title">Relatório de Resultados</h3>
                    <p class="step-description">Relatório digital completo com análise detalhada e fácil compreensão</p>
                </div>
                
                <div class="process-step" data-aos="fade-up" data-aos-delay="400">
                    <div class="step-number">4</div>
                    <div class="step-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <h3 class="step-title">Consultoria Especializada</h3>
                    <p class="step-description">Interpretação profissional e recomendações personalizadas</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Articles Section -->
    <section class="articles" id="artigos">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Últimos Artigos</h2>
                <p class="section-subtitle">Conteúdo técnico e notícias sobre qualidade da água</p>
            </div>
            <div class="articles-grid" data-aos="fade-up" data-aos-delay="100">
                <?php
                try {
                    // Usar a configuração da pasta admin
                    if (file_exists('admin/config.php')) {
                        require_once 'admin/config.php';
                        
                        $sql = 'SELECT * FROM posts ORDER BY date DESC LIMIT 3';
                        $query = mysqli_query($connection, $sql);
                        
                        if ($query && mysqli_num_rows($query) > 0) {
                            while ($row = mysqli_fetch_array($query)) {
                                $excerpt = substr(strip_tags($row["content"]), 0, 150) . '...';
                                $date = date('d/m/Y', strtotime($row["date"]));
                                
                                echo '<article class="article-card">
                                        <h3 class="article-title">
                                            <a href="articles.php?id=' . $row["id"] . '">' . htmlspecialchars($row["title"]) . '</a>
                                        </h3>
                                        <p class="article-excerpt">' . htmlspecialchars($excerpt) . '</p>
                                        <div class="article-meta">
                                            <span class="article-author">' . htmlspecialchars($row["author"]) . '</span>
                                            <span class="article-date">' . $date . '</span>
                                        </div>
                                      </article>';
                            }
                        } else {
                            echo '<div class="col-12 text-center" style="grid-column: 1 / -1;">
                                    <p style="color: var(--gray-500);">Em breve publicaremos novos artigos técnicos sobre qualidade da água.</p>
                                  </div>';
                        }
                    } else {
                        echo '<div class="col-12 text-center" style="grid-column: 1 / -1;">
                                <p style="color: var(--gray-500);">Sistema em configuração. Em breve publicaremos novos artigos.</p>
                              </div>';
                    }
                } catch (Exception $e) {
                    echo '<div class="col-12 text-center" style="grid-column: 1 / -1;">
                            <p style="color: var(--gray-500);">Em breve publicaremos novos artigos técnicos sobre qualidade da água.</p>
                          </div>';
                }
                ?>
            </div>
            <div class="text-center" data-aos="fade-up" data-aos-delay="200">
                <a href="articles.php" class="btn btn-primary">Ver Todos os Artigos</a>
            </div>
        </div>
    </section>

    <!-- Members Section -->
    <section class="members" id="membros">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Nossa Equipe</h2>
                <p class="section-subtitle">Profissionais especializados garantindo resultados confiáveis</p>
            </div>
            <div class="members-grid" data-aos="fade-up" data-aos-delay="100">
                <?php
                try {
                    // Usar a configuração da pasta admin
                    if (file_exists('admin/config.php')) {
                        require_once 'admin/config.php';
                        
                        $sql = "SELECT * FROM membros WHERE status = 'aprovado' ORDER BY nome ASC LIMIT 3";
                        $result = mysqli_query($connection, $sql);
                        
                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $photo_src = $row['foto'] ? 'data:image/jpeg;base64,' . base64_encode($row['foto']) : 'assets/images/default-avatar.jpg';
                                
                                echo '<div class="member-card">
                                        <div class="member-photo">
                                            <img src="' . $photo_src . '" alt="' . htmlspecialchars($row['nome']) . '">
                                        </div>
                                        <h3 class="member-name">' . htmlspecialchars($row['nome']) . '</h3>
                                        <p class="member-position">' . htmlspecialchars($row['cargo']) . '</p>
                                        <div class="member-links">
                                            <a href="' . htmlspecialchars($row['lattes'] ?? '#') . '" class="member-link" target="_blank">
                                                <i class="fas fa-graduation-cap"></i>
                                                Currículo Lattes
                                            </a>
                                        </div>
                                      </div>';
                            }
                        } else {
                            // Membros padrão para demonstração
                            $default_members = [
                                ['nome' => 'Dr. Carlos Silva', 'cargo' => 'Diretor Técnico'],
                                ['nome' => 'Dra. Maria Santos', 'cargo' => 'Coordenadora de Análises'],
                                ['nome' => 'Dr. João Oliveira', 'cargo' => 'Especialista em Qualidade']
                            ];
                            
                            foreach (array_slice($default_members, 0, 3) as $member) {
                                echo '<div class="member-card">
                                        <div class="member-photo">
                                            <img src="assets/images/default-avatar.jpg" alt="' . htmlspecialchars($member['nome']) . '">
                                        </div>
                                        <h3 class="member-name">' . htmlspecialchars($member['nome']) . '</h3>
                                        <p class="member-position">' . htmlspecialchars($member['cargo']) . '</p>
                                        <div class="member-links">
                                            <a href="members.php" class="member-link">
                                                <i class="fas fa-user"></i>
                                                Ver Perfil
                                            </a>
                                        </div>
                                      </div>';
                            }
                        }
                    } else {
                        echo '<div class="col-12 text-center" style="grid-column: 1 / -1;">
                                <p style="color: var(--gray-500);">Sistema em configuração. Em breve apresentaremos nossa equipe.</p>
                              </div>';
                    }
                } catch (Exception $e) {
                    // Membros padrão em caso de erro
                    $default_members = [
                        ['nome' => 'Dr. Carlos Silva', 'cargo' => 'Diretor Técnico'],
                        ['nome' => 'Dra. Maria Santos', 'cargo' => 'Coordenadora de Análises'],
                        ['nome' => 'Dr. João Oliveira', 'cargo' => 'Especialista em Qualidade']
                    ];
                    
                    foreach (array_slice($default_members, 0, 3) as $member) {
                        echo '<div class="member-card">
                                <div class="member-photo">
                                    <img src="assets/images/default-avatar.jpg" alt="' . htmlspecialchars($member['nome']) . '">
                                </div>
                                <h3 class="member-name">' . htmlspecialchars($member['nome']) . '</h3>
                                <p class="member-position">' . htmlspecialchars($member['cargo']) . '</p>
                                <div class="member-links">
                                    <a href="members.php" class="member-link">
                                        <i class="fas fa-user"></i>
                                        Ver Perfil
                                    </a>
                                </div>
                              </div>';
                    }
                }
                ?>
            </div>
            <div class="text-center" data-aos="fade-up" data-aos-delay="200" style="margin-top: var(--spacing-6);">
                <a href="members.php" class="btn btn-outline">Conhecer Toda a Equipe</a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">O que Nossos Clientes Dizem</h2>
                <p class="section-subtitle">Confiança construída através de resultados excepcionais</p>
            </div>
            
            <div class="testimonials-grid">
                <div class="testimonial-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="testimonial-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">
                        "Excelente serviço! Descobrimos problemas na água do nosso poço que não sabíamos que existiam. O relatório foi muito claro e as recomendações nos ajudaram muito."
                    </p>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <img src="assets/images/testimonial-1.jpg" alt="Maria Silva">
                        </div>
                        <div class="author-info">
                            <h4 class="author-name">Maria Silva</h4>
                            <p class="author-title">Proprietária Residencial</p>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="testimonial-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">
                        "Como gerente de restaurante, preciso garantir a qualidade da água. A LabÁgua sempre entrega resultados rápidos e precisos. Parceria de confiança!"
                    </p>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <img src="assets/images/testimonial-2.jpg" alt="Carlos Santos">
                        </div>
                        <div class="author-info">
                            <h4 class="author-name">Carlos Santos</h4>
                            <p class="author-title">Gerente de Restaurante</p>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="testimonial-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">
                        "O curso de certificação superou minhas expectativas. Conteúdo atualizado, instrutores qualificados e certificação reconhecida no mercado."
                    </p>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <img src="assets/images/testimonial-3.jpg" alt="Ana Costa">
                        </div>
                        <div class="author-info">
                            <h4 class="author-name">Ana Costa</h4>
                            <p class="author-title">Técnica de Laboratório</p>
                        </div>
                    </div>
                </div>
                
                <div class="testimonial-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="testimonial-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p class="testimonial-text">
                        "Para nossa indústria, a precisão é fundamental. A LabÁgua oferece análises detalhadas que nos ajudam a manter os padrões de qualidade exigidos."
                    </p>
                    <div class="testimonial-author">
                        <div class="author-avatar">
                            <img src="assets/images/testimonial-4.jpg" alt="Roberto Lima">
                        </div>
                        <div class="author-info">
                            <h4 class="author-name">Roberto Lima</h4>
                            <p class="author-title">Gerente Industrial</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="pricing" id="precos">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Planos e Preços</h2>
                <p class="section-subtitle">Escolha o pacote ideal para suas necessidades</p>
            </div>
            
            <div class="pricing-grid">
                <div class="pricing-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="pricing-header">
                        <h3 class="pricing-title">Pacote Básico</h3>
                        <div class="pricing-price">
                            <span class="price-currency">R$</span>
                            <span class="price-amount">149</span>
                        </div>
                        <p class="pricing-subtitle">Testes essenciais de qualidade da água</p>
                    </div>
                    <div class="pricing-features">
                        <ul>
                            <li><i class="fas fa-check"></i> Análise microbiológica básica</li>
                            <li><i class="fas fa-check"></i> pH e cloro</li>
                            <li><i class="fas fa-check"></i> Turbidez e cor</li>
                            <li><i class="fas fa-check"></i> Relatório digital</li>
                            <li><i class="fas fa-check"></i> Resultado em 48h</li>
                        </ul>
                    </div>
                    <a href="#contato" class="btn btn-outline">Escolher Plano</a>
                </div>
                
                <div class="pricing-card featured" data-aos="fade-up" data-aos-delay="200">
                    <div class="pricing-badge">Mais Popular</div>
                    <div class="pricing-header">
                        <h3 class="pricing-title">Pacote Completo</h3>
                        <div class="pricing-price">
                            <span class="price-currency">R$</span>
                            <span class="price-amount">289</span>
                        </div>
                        <p class="pricing-subtitle">Análise abrangente e detalhada</p>
                    </div>
                    <div class="pricing-features">
                        <ul>
                            <li><i class="fas fa-check"></i> Todos os testes do Básico</li>
                            <li><i class="fas fa-check"></i> Metais pesados</li>
                            <li><i class="fas fa-check"></i> Pesticidas e herbicidas</li>
                            <li><i class="fas fa-check"></i> Análise química completa</li>
                            <li><i class="fas fa-check"></i> Consultoria inclusa</li>
                            <li><i class="fas fa-check"></i> Resultado em 24h</li>
                        </ul>
                    </div>
                    <a href="#contato" class="btn btn-primary">Escolher Plano</a>
                </div>
                
                <div class="pricing-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="pricing-header">
                        <h3 class="pricing-title">Pacote Profissional</h3>
                        <div class="pricing-price">
                            <span class="price-currency">R$</span>
                            <span class="price-amount">449</span>
                        </div>
                        <p class="pricing-subtitle">Espectro completo + consultoria especializada</p>
                    </div>
                    <div class="pricing-features">
                        <ul>
                            <li><i class="fas fa-check"></i> Todos os testes do Completo</li>
                            <li><i class="fas fa-check"></i> Análises especializadas</li>
                            <li><i class="fas fa-check"></i> Radioatividade</li>
                            <li><i class="fas fa-check"></i> Consultoria presencial</li>
                            <li><i class="fas fa-check"></i> Plano de ação personalizado</li>
                            <li><i class="fas fa-check"></i> Suporte prioritário</li>
                        </ul>
                    </div>
                    <a href="#contato" class="btn btn-outline">Escolher Plano</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Emergency Testing -->
    <section class="emergency">
        <div class="container">
            <div class="emergency-content" data-aos="fade-up">
                <div class="emergency-icon">
                    <i class="fas fa-phone-alt"></i>
                </div>
                <div class="emergency-text">
                    <h2 class="emergency-title">Atendimento de Emergência 24/7</h2>
                    <p class="emergency-description">
                        Para situações críticas que requerem análise imediata, nossa equipe técnica especializada 
                        está disponível 24 horas por dia com garantia de resposta em até 2 horas.
                    </p>
                </div>
                <div class="emergency-cta">
                    <a href="tel:+5511999999999" class="btn btn-primary btn-large">
                        <i class="fas fa-phone"></i>
                        Emergência: (11) 99999-9999
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Certifications -->
    <section class="certifications" id="sobre">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Certificações e Credenciamentos</h2>
                <p class="section-subtitle">Reconhecimento e conformidade com os mais altos padrões</p>
            </div>
            
            <div class="certifications-grid">
                <div class="certification-item" data-aos="fade-up" data-aos-delay="100">
                    <div class="cert-logo">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <h3 class="cert-title">ISO 17025</h3>
                    <p class="cert-description">Credenciamento para laboratórios de ensaio e calibração</p>
                </div>
                
                <div class="certification-item" data-aos="fade-up" data-aos-delay="200">
                    <div class="cert-logo">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="cert-title">Certificação EPA</h3>
                    <p class="cert-description">Aprovação da Agência de Proteção Ambiental</p>
                </div>
                
                <div class="certification-item" data-aos="fade-up" data-aos-delay="300">
                    <div class="cert-logo">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3 class="cert-title">Aprovação ANVISA</h3>
                    <p class="cert-description">Departamento de Vigilância Sanitária</p>
                </div>
                
                <div class="certification-item" data-aos="fade-up" data-aos-delay="400">
                    <div class="cert-logo">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="cert-title">ABNT</h3>
                    <p class="cert-description">Associação Brasileira de Normas Técnicas</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact" id="contato">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Entre em Contato</h2>
                <p class="section-subtitle">Estamos prontos para atender suas necessidades</p>
            </div>
            
            <div class="contact-content">
                <div class="contact-info" data-aos="fade-up" data-aos-delay="100">
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-details">
                            <h3>Endereço</h3>
                            <p>Rua das Análises, 123<br>Centro, São Paulo - SP<br>CEP: 01234-567</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="contact-details">
                            <h3>Telefones</h3>
                            <p>Principal: (11) 3456-7890<br>Emergência: (11) 99999-9999<br>WhatsApp: (11) 98888-8888</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-details">
                            <h3>E-mail</h3>
                            <p>contato@labagua.com.br<br>emergencia@labagua.com.br<br>cursos@labagua.com.br</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="contact-details">
                            <h3>Horário de Funcionamento</h3>
                            <p>Segunda a Sexta: 8h às 18h<br>Sábado: 8h às 12h<br>Emergência: 24h/7 dias</p>
                        </div>
                    </div>
                </div>
                
                <div class="contact-form" data-aos="fade-up" data-aos-delay="200">
                    <form id="contactForm" action="includes/contact.php" method="POST">
                        <div class="form-group">
                            <label for="name">Nome Completo *</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">E-mail *</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Telefone *</label>
                            <input type="tel" id="phone" name="phone" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="service">Tipo de Serviço *</label>
                            <select id="service" name="service" required>
                                <option value="">Selecione um serviço</option>
                                <option value="residencial">Análise Residencial</option>
                                <option value="comercial">Análise Comercial</option>
                                <option value="industrial">Análise Industrial</option>
                                <option value="curso">Curso de Certificação</option>
                                <option value="emergencia">Teste de Emergência</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Mensagem</label>
                            <textarea id="message" name="message" rows="5" placeholder="Descreva suas necessidades ou dúvidas..."></textarea>
                        </div>
                        
                        <div class="form-group checkbox-group">
                            <label class="checkbox-label">
                                <input type="checkbox" name="newsletter" value="1">
                                <span class="checkmark"></span>
                                Desejo receber informações sobre novos serviços e promoções
                            </label>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-large">
                            <i class="fas fa-paper-plane"></i>
                            Enviar Mensagem
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Transparency Section -->
    <section class="transparency" id="transparencia">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Transparência e Responsabilidade</h2>
                <p class="section-subtitle">
                    Comprometidos com a transparência total em nossos processos, resultados e operações. 
                    Acesse informações públicas sobre nossos serviços e certificações.
                </p>
            </div>
            
            <div class="transparency-grid">
                <div class="transparency-item" data-aos="fade-up" data-aos-delay="100">
                    <div class="transparency-icon">
                        <i class="fas fa-file-contract"></i>
                    </div>
                    <h3 class="transparency-title">Relatórios Anuais</h3>
                    <p class="transparency-description">Relatórios completos de atividades, análises realizadas e impacto social</p>
                    <a href="#" class="transparency-link">Acessar Relatórios</a>
                </div>
                
                <div class="transparency-item" data-aos="fade-up" data-aos-delay="200">
                    <div class="transparency-icon">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <h3 class="transparency-title">Certificações Vigentes</h3>
                    <p class="transparency-description">Documentos de certificação ISO 17025, ANVISA e demais órgãos reguladores</p>
                    <a href="#certificacoes" class="transparency-link">Ver Certificados</a>
                </div>
                
                <div class="transparency-item" data-aos="fade-up" data-aos-delay="300">
                    <div class="transparency-icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <h3 class="transparency-title">Indicadores de Qualidade</h3>
                    <p class="transparency-description">Métricas de desempenho, tempo de resposta e índices de satisfação</p>
                    <a href="#" class="transparency-link">Consultar Indicadores</a>
                </div>
                
                <div class="transparency-item" data-aos="fade-up" data-aos-delay="400">
                    <div class="transparency-icon">
                        <i class="fas fa-gavel"></i>
                    </div>
                    <h3 class="transparency-title">Marco Regulatório</h3>
                    <p class="transparency-description">Legislação aplicável, normas técnicas e procedimentos operacionais</p>
                    <a href="#" class="transparency-link">Acessar Normas</a>
                </div>
                
                <div class="transparency-item" data-aos="fade-up" data-aos-delay="500">
                    <div class="transparency-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <h3 class="transparency-title">Canal de Ouvidoria</h3>
                    <p class="transparency-description">Reclamações, sugestões e denúncias tratadas com total confidencialidade</p>
                    <a href="#contato" class="transparency-link">Entrar em Contato</a>
                </div>
                
                <div class="transparency-item" data-aos="fade-up" data-aos-delay="600">
                    <div class="transparency-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="transparency-title">Política de Privacidade</h3>
                    <p class="transparency-description">Tratamento de dados pessoais conforme LGPD e políticas de segurança</p>
                    <a href="#" class="transparency-link">Ler Política</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Institutional Numbers -->
    <section class="institutional-numbers">
        <div class="container">
            <div class="numbers-grid" data-aos="fade-up">
                <div class="number-item">
                    <div class="number-value" data-target="15">0</div>
                    <div class="number-label">Anos de Experiência</div>
                </div>
                <div class="number-item">
                    <div class="number-value" data-target="10000">0</div>
                    <div class="number-label">Análises Realizadas</div>
                </div>
                <div class="number-item">
                    <div class="number-value" data-target="500">0</div>
                    <div class="number-label">Empresas Atendidas</div>
                </div>
                <div class="number-item">
                    <div class="number-value" data-target="98">0</div>
                    <div class="number-label">% Satisfação</div>
                </div>
                <div class="number-item">
                    <div class="number-value" data-target="24">0</div>
                    <div class="number-label">Horas de Atendimento</div>
                </div>
            </div>
        </div>
    </section>
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