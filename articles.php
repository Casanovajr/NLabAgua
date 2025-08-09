<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="LabÁgua - Artigos e notícias sobre qualidade da água, análises laboratoriais e tecnologia.">
    <meta name="keywords" content="artigos água, qualidade da água, laboratório, análise, tecnologia">
    <title>Artigos - LabÁgua</title>
    
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
                <a href="index.php#transparencia" class="institutional-link">
                    <i class="fas fa-eye"></i>
                    Transparência
                </a>
                <a href="index.php#sobre" class="institutional-link">
                    <i class="fas fa-certificate"></i>
                    Certificações
                </a>
            </div>
        </div>
    </div>

    <!-- Header -->
    <header class="header" id="header">
        <nav class="navbar">
            <div class="container">
                <div class="nav-brand">
                    <div class="logo">
                        <div class="logo-icon">
                            <img src="images/LabAguaLogo.png" alt="LabÁgua">
                        </div>
                        
                    </div>
                </div>
                
                <div class="nav-menu" id="nav-menu">
                    <ul class="nav-list">
                        <li class="nav-item"><a href="index.php#inicio" class="nav-link">Início</a></li>
                        <li class="nav-item"><a href="index.php#servicos" class="nav-link">Serviços</a></li>
                        <li class="nav-item"><a href="index.php#cursos" class="nav-link">Cursos</a></li>
                        <li class="nav-item"><a href="index.php#sobre" class="nav-link">Sobre</a></li>
                        <li class="nav-item"><a href="articles.php" class="nav-link active">Artigos</a></li>
                        <li class="nav-item"><a href="members.php" class="nav-link">Equipe</a></li>
                        <li class="nav-item"><a href="labagua/admin/login.php" class="nav-link" target="_blank">Admin</a></li>
                        <li class="nav-item"><a href="index.php#contato" class="nav-link">Contato</a></li>
                    </ul>
                    <div class="nav-cta">
                        <a href="index.php#contato" class="btn btn-primary">Solicitar Teste</a>
                    </div>
                </div>
                
                <div class="nav-toggle" id="nav-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main id="main-content">
        <!-- Page Header -->
        <section class="page-header">
            <div class="container">
                <div class="page-header-content" data-aos="fade-up">
                    <nav class="breadcrumb">
                        <a href="index.php">Início</a>
                        <i class="fas fa-chevron-right"></i>
                        <span>Artigos</span>
                    </nav>
                    <h1 class="page-title">Artigos e Notícias</h1>
                    <p class="page-subtitle">
                        Conteúdo técnico, novidades e insights sobre qualidade da água, 
                        análises laboratoriais e tecnologia aplicada ao setor.
                    </p>
                </div>
            </div>
        </section>

        <!-- Articles Section -->
        <section class="articles" style="padding-top: var(--spacing-8);">
            <div class="container">
                <?php
                try {
                    require_once "admin/functions/db.php";
                    $sql = 'SELECT * FROM posts ORDER BY date DESC';
                    $query = mysqli_query($connection, $sql);
                } catch (Exception $e) {
                    $query = false;
                }
                ?>
                
                <div class="articles-grid" data-aos="fade-up" data-aos-delay="100">
                    <?php
                    if (!$query || mysqli_num_rows($query) == 0) {
                        echo '<div class="col-12 text-center" style="grid-column: 1 / -1;">
                                <div class="empty-state">
                                    <i class="fas fa-newspaper" style="font-size: 4rem; color: var(--gray-400); margin-bottom: var(--spacing-4);"></i>
                                    <h3 style="color: var(--gray-600); margin-bottom: var(--spacing-2);">Desculpe, ainda não há postagens :( Em breve postaremos novos conteúdos!</h3>
                                </div>
                              </div>';
                    } else {
                        while ($row = mysqli_fetch_array($query)) {
                            $excerpt = substr(strip_tags($row["content"]), 0, 200) . '...';
                            echo '<article class="article-card">
                                    <h2 class="article-title">
                                        <a href="article.php?id=' . $row["id"] . '">' . htmlspecialchars($row["title"]) . '</a>
                                    </h2>
                                    <p class="article-excerpt">' . htmlspecialchars($excerpt) . '</p>
                                    <div class="article-meta">
                                        <span class="article-author">' . htmlspecialchars($row["author"]) . '</span>
                                        <span class="article-date">' . htmlspecialchars($row["date"]) . '</span>
                                    </div>
                                  </article>';
                        }
                    }
                    ?>
                </div>

                <!-- CTA Section -->
                <div class="text-center" data-aos="fade-up" data-aos-delay="200" style="margin-top: var(--spacing-12);">
                    <div style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); 
                                padding: var(--spacing-8); 
                                border-radius: var(--border-radius-xl); 
                                color: var(--white); 
                                text-align: center;">
                        <h3 style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); margin-bottom: var(--spacing-4);">
                            Precisa de Análise de Água?
                        </h3>
                        <p style="font-size: var(--font-size-lg); margin-bottom: var(--spacing-6); opacity: 0.9;">
                            Nossa equipe está pronta para atender suas necessidades com precisão e rapidez
                        </p>
                        <a href="index.php#contato" class="btn" style="background: var(--white); color: var(--primary-color); font-weight: var(--font-weight-semibold); padding: var(--spacing-3) var(--spacing-6);">
                            <i class="fas fa-flask"></i>
                            Solicitar Teste Agora
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <div class="footer-logo">
                        <div class="logo">
                            <div class="logo-icon">
                                <i class="fas fa-tint"></i>
                                <i class="fas fa-flask"></i>
                            </div>
                            <span class="logo-text">LabÁgua</span>
                        </div>
                    </div>
                    <p class="footer-description">
                        Líder em análise profissional de água no Brasil. Precisão, confiabilidade e excelência em cada teste.
                    </p>
                    <div class="social-links">
                        <a href="#" class="social-link"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                
                <div class="footer-section">
                    <h3 class="footer-title">Serviços</h3>
                    <ul class="footer-links">
                        <li><a href="index.php#servicos">Análise Residencial</a></li>
                        <li><a href="index.php#servicos">Análise Comercial</a></li>
                        <li><a href="index.php#servicos">Análise Industrial</a></li>
                        <li><a href="index.php#precos">Planos e Preços</a></li>
                        <li><a href="index.php#contato">Teste de Emergência</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3 class="footer-title">Conteúdo</h3>
                    <ul class="footer-links">
                        <li><a href="articles.php">Artigos</a></li>
                        <li><a href="members.php">Nossa Equipe</a></li>
                        <li><a href="index.php#cursos">Cursos</a></li>
                        <li><a href="index.php#sobre">Certificações</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3 class="footer-title">Empresa</h3>
                    <ul class="footer-links">
                        <li><a href="index.php#sobre">Sobre Nós</a></li>
                        <li><a href="index.php#transparencia">Transparência</a></li>
                        <li><a href="index.php#contato">Contato</a></li>
                        <li><a href="#">Política de Privacidade</a></li>
                        <li><a href="#">Termos de Uso</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <div class="footer-copyright">
                    <p>&copy; 2024 LabÁgua. Todos os direitos reservados.</p>
                </div>
                <div class="footer-certifications">
                    <span class="cert-badge">ISO 17025</span>
                    <span class="cert-badge">ANVISA</span>
                    <span class="cert-badge">EPA</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="backToTop" class="back-to-top" aria-label="Voltar ao topo">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- JavaScript -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>
