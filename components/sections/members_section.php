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