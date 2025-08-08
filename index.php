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

<<<<<<< Updated upstream
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
                    require_once 'admin/functions/db.php';
                    $sql = "SELECT nome, cargo, lattes, foto FROM membros WHERE status = 'aprovado' ORDER BY nome ASC LIMIT 6";
                    $result = mysqli_query($connection, $sql);
                    if ($result === false) {
                        echo '<!-- SQL error: ' . htmlspecialchars(mysqli_error($connection)) . ' -->';
                    }
                } catch (Exception $e) {
                    $result = false;
                }
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $photo_src = !empty($row['foto']) ? 'data:image/jpeg;base64,' . base64_encode($row['foto']) : 'assets/images/default-avatar.jpg';
                        echo '<div class="member-card">'
                           . '<div class="member-photo">'
                           .     '<img src="' . $photo_src . '" alt="' . htmlspecialchars($row['nome']) . '">'
                           . '</div>'
                           . '<h3 class="member-name">' . htmlspecialchars($row['nome']) . '</h3>'
                           . '<p class="member-position">' . htmlspecialchars($row['cargo']) . '</p>'
                           . '<div class="member-links">'
                           .     (!empty($row['lattes']) ? '<a href="' . htmlspecialchars($row['lattes']) . '" class="member-link" target="_blank"><i class="fas fa-graduation-cap"></i> Currículo Lattes</a>' : '')
                           . '</div>'
                           . '</div>';
                    }
                } else {
                    $default_members = [
                        ['nome' => 'Dr. Carlos Silva', 'cargo' => 'Diretor Técnico'],
                        ['nome' => 'Dra. Maria Santos', 'cargo' => 'Coordenadora de Análises'],
                        ['nome' => 'Dr. João Oliveira', 'cargo' => 'Especialista em Qualidade']
                    ];
                    foreach ($default_members as $member) {
                        echo '<div class="member-card">'
                           . '<div class="member-photo">'
                           .     '<img src="assets/images/default-avatar.jpg" alt="' . htmlspecialchars($member['nome']) . '">'
                           . '</div>'
                           . '<h3 class="member-name">' . htmlspecialchars($member['nome']) . '</h3>'
                           . '<p class="member-position">' . htmlspecialchars($member['cargo']) . '</p>'
                           . '</div>';
                    }
                }
                ?>
            </div>
            <div class="text-center" data-aos="fade-up" data-aos-delay="200" style="margin-top: var(--spacing-6);">
                <a href="members.php" class="btn btn-outline">Conhecer Toda a Equipe</a>
            </div>
        </div>
    </section>
=======
        <!-- Members Section -->
        <?php include_once 'components/sections/members_section.php'; ?>
>>>>>>> Stashed changes

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