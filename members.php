<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="LabÁgua - Conheça nossa equipe de especialistas em análise de água e qualidade laboratorial.">
    <meta name="keywords" content="equipe labágua, especialistas água, laboratório, profissionais">
    <title>Nossa Equipe - LabÁgua</title>
    
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
                            <i class="fas fa-tint"></i>
                            <i class="fas fa-flask"></i>
                        </div>
                        <span class="logo-text">LabÁgua</span>
                    </div>
                </div>
                
                <div class="nav-menu" id="nav-menu">
                    <ul class="nav-list">
                        <li class="nav-item"><a href="index.php#inicio" class="nav-link">Início</a></li>
                        <li class="nav-item"><a href="index.php#servicos" class="nav-link">Serviços</a></li>
                        <li class="nav-item"><a href="index.php#cursos" class="nav-link">Cursos</a></li>
                        <li class="nav-item"><a href="index.php#sobre" class="nav-link">Sobre</a></li>
                        <li class="nav-item"><a href="articles.php" class="nav-link">Artigos</a></li>
                        <li class="nav-item"><a href="members.php" class="nav-link active">Equipe</a></li>
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
                        <span>Equipe</span>
                    </nav>
                    <h1 class="page-title">Nossa Equipe</h1>
                    <p class="page-subtitle">
                        Profissionais especializados e experientes, comprometidos com a excelência 
                        em análise de água e garantia da qualidade dos resultados.
                    </p>
                </div>
            </div>
        </section>

        <!-- Members Section -->
        <section class="members" style="padding-top: var(--spacing-8);">
            <div class="container">
                <?php
                try {
                    require_once "admin/functions/db.php";
                    // Buscar todos os membros (ordem: aprovados primeiro). Se falhar (coluna 'status' ausente), usa fallback por nome.
                    $hasStatus = true;
                    $sql = "SELECT id, nome, cargo, lattes, foto, status FROM membros ORDER BY (status = 'aprovado') DESC, nome ASC";
                    $result = mysqli_query($connection, $sql);
                    if ($result === false) {
                        $hasStatus = false;
                        $sql = "SELECT id, nome, cargo, lattes, foto FROM membros ORDER BY nome ASC";
                        $result = mysqli_query($connection, $sql);
                    }
                    // Debug não intrusivo (comentário HTML): contagem de registros e erro da consulta, se houver
                    $count_debug = mysqli_query($connection, "SELECT COUNT(*) AS c FROM membros");
                    $count_row = $count_debug ? mysqli_fetch_assoc($count_debug) : null;
                    echo '<!-- membros: count=' . htmlspecialchars($count_row['c'] ?? 'n/a') . ' | hasStatus=' . ($hasStatus ? '1' : '0') . ' | last_sql_error=' . htmlspecialchars(mysqli_error($connection)) . ' -->';
                } catch (Exception $e) {
                    $result = false;
                    $hasStatus = false;
                }
                ?>
                
                <div class="members-grid" data-aos="fade-up" data-aos-delay="100">
                    <?php
                    if ($result === false) {
                        echo '<div class="col-12 text-center" style="grid-column: 1 / -1;">
                                <div class="empty-state">
                                    <i class="fas fa-database" style="font-size: 4rem; color: var(--gray-400); margin-bottom: var(--spacing-4);"></i>
                                    <h3 style="color: var(--gray-600); margin-bottom: var(--spacing-2);">Não foi possível carregar os membros</h3>
                                    <p style="color: var(--gray-500);">Verifique se a tabela <strong>membros</strong> existe e contém dados (consulte o comentário HTML de debug no código-fonte).</p>
                                </div>
                              </div>';
                    } else if ($result && mysqli_num_rows($result) == 0) {
                        echo '<div class="col-12 text-center" style="grid-column: 1 / -1;">
                                <div class="empty-state">
                                    <i class="fas fa-users" style="font-size: 4rem; color: var(--gray-400); margin-bottom: var(--spacing-4);"></i>
                                    <h3 style="color: var(--gray-600); margin-bottom: var(--spacing-2);">Equipe em formação</h3>
                                    <p style="color: var(--gray-500);">Em breve apresentaremos nossos especialistas em análise de água.</p>
                                </div>
                              </div>';
                    } else {
                        // Adicionar membros padrão se não houver no banco
                        $default_members = [
                            [
                                'nome' => 'Dr. Carlos Silva',
                                'cargo' => 'Diretor Técnico',
                                'lattes' => '#',
                                'foto' => null,
                                'especialidade' => 'Microbiologia da Água'
                            ],
                            [
                                'nome' => 'Dra. Maria Santos',
                                'cargo' => 'Coordenadora de Análises',
                                'lattes' => '#',
                                'foto' => null,
                                'especialidade' => 'Química Analítica'
                            ],
                            [
                                'nome' => 'Dr. João Oliveira',
                                'cargo' => 'Especialista em Qualidade',
                                'lattes' => '#',
                                'foto' => null,
                                'especialidade' => 'Controle de Qualidade'
                            ]
                        ];
                        
                        $members_displayed = false;
                        
                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $members_displayed = true;
                                $photo_src = !empty($row['foto']) ? 'data:image/jpeg;base64,' . base64_encode($row['foto']) : 'assets/images/default-avatar.jpg';
                                $status_badge = '';
                                if ($hasStatus && !empty($row['status']) && $row['status'] !== 'aprovado') {
                                    $label = $row['status'] === 'pendente' ? 'Pendente' : ($row['status'] === 'rejeitado' ? 'Rejeitado' : $row['status']);
                                    $status_badge = '<span class="badge" style="margin-left:8px; background: var(--gray-200); color: var(--gray-700); padding: 2px 6px; border-radius: 999px; font-size: 12px; vertical-align: middle;">' . htmlspecialchars(ucfirst($label)) . '</span>';
                                }
                                
                                echo '<div class="member-card">
                                        <div class="member-photo">
                                            <img src="' . $photo_src . '" alt="' . htmlspecialchars($row['nome']) . '">
                                        </div>
                                        <h3 class="member-name">' . htmlspecialchars($row['nome']) . $status_badge . '</h3>
                                        <p class="member-position">' . htmlspecialchars($row['cargo']) . '</p>
                                        <div class="member-links">
                                            <a href="' . htmlspecialchars($row['lattes']) . '" class="member-link" target="_blank">
                                                <i class="fas fa-graduation-cap"></i>
                                                Currículo Lattes
                                            </a>
                                        </div>
                                      </div>';
                            }
                        }
                        
                        // Se não há membros no banco, mostrar membros padrão
                        if (!$members_displayed) {
                            foreach ($default_members as $member) {
                                echo '<div class="member-card">
                                        <div class="member-photo">
                                            <img src="assets/images/default-avatar.jpg" alt="' . htmlspecialchars($member['nome']) . '">
                                        </div>
                                        <h3 class="member-name">' . htmlspecialchars($member['nome']) . '</h3>
                                        <p class="member-position">' . htmlspecialchars($member['cargo']) . '</p>
                                        <p style="color: var(--gray-600); font-size: var(--font-size-sm); margin-bottom: var(--spacing-4);">' . htmlspecialchars($member['especialidade']) . '</p>
                                        <div class="member-links">
                                            <a href="' . htmlspecialchars($member['lattes']) . '" class="member-link">
                                                <i class="fas fa-graduation-cap"></i>
                                                Currículo Lattes
                                            </a>
                                        </div>
                                      </div>';
                            }
                        }
                    }
                    ?>
                </div>

                <!-- Join Team Section -->
                <div class="text-center" data-aos="fade-up" data-aos-delay="200" style="margin-top: var(--spacing-12);">
                    <div style="background: var(--gray-50); 
                                padding: var(--spacing-8); 
                                border-radius: var(--border-radius-xl); 
                                border: 2px solid var(--gray-200);">
                        <i class="fas fa-handshake" style="font-size: 3rem; color: var(--primary-color); margin-bottom: var(--spacing-4);"></i>
                        <h3 style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); margin-bottom: var(--spacing-4); color: var(--gray-900);">
                            Faça Parte da Nossa Equipe
                        </h3>
                        <p style="font-size: var(--font-size-lg); margin-bottom: var(--spacing-6); color: var(--gray-600);">
                            Procuramos profissionais qualificados para compor nossa equipe técnica especializada
                        </p>
                        <div style="display: flex; gap: var(--spacing-4); justify-content: center; flex-wrap: wrap;">
                            <a href="labagua/create-member.php" class="btn btn-primary">
                                <i class="fas fa-user-plus"></i>
                                Cadastre-se na Equipe
                            </a>
                            <a href="index.php#contato" class="btn btn-outline">
                                <i class="fas fa-envelope"></i>
                                Entre em Contato
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Institutional Values -->
                <div class="institutional-values" data-aos="fade-up" data-aos-delay="300" style="margin-top: var(--spacing-12);">
                    <h3 style="text-align: center; font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); margin-bottom: var(--spacing-8); color: var(--gray-900);">
                        Nossos Valores
                    </h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: var(--spacing-6);">
                        <div style="text-align: center; padding: var(--spacing-6);">
                            <i class="fas fa-microscope" style="font-size: 2.5rem; color: var(--primary-color); margin-bottom: var(--spacing-4);"></i>
                            <h4 style="font-size: var(--font-size-lg); font-weight: var(--font-weight-semibold); margin-bottom: var(--spacing-3); color: var(--gray-900);">Precisão Científica</h4>
                            <p style="color: var(--gray-600);">Compromisso com a exatidão e rigor científico em todas as análises realizadas</p>
                        </div>
                        <div style="text-align: center; padding: var(--spacing-6);">
                            <i class="fas fa-shield-alt" style="font-size: 2.5rem; color: var(--primary-color); margin-bottom: var(--spacing-4);"></i>
                            <h4 style="font-size: var(--font-size-lg); font-weight: var(--font-weight-semibold); margin-bottom: var(--spacing-3); color: var(--gray-900);">Confiabilidade</h4>
                            <p style="color: var(--gray-600);">Resultados seguros e confiáveis que você pode usar para tomar decisões importantes</p>
                        </div>
                        <div style="text-align: center; padding: var(--spacing-6);">
                            <i class="fas fa-graduation-cap" style="font-size: 2.5rem; color: var(--primary-color); margin-bottom: var(--spacing-4);"></i>
                            <h4 style="font-size: var(--font-size-lg); font-weight: var(--font-weight-semibold); margin-bottom: var(--spacing-3); color: var(--gray-900);">Excelência Técnica</h4>
                            <p style="color: var(--gray-600);">Equipe altamente qualificada com formação especializada e experiência comprovada</p>
                        </div>
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
