<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="LabÁgua - Artigo">
    <title>Artigo - LabÁgua</title>

    <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
      .article-content img { max-width: 100%; height: auto; border-radius: 6px; }
      .article-content table { width: 100%; border-collapse: collapse; margin: 16px 0; }
      .article-content table th,
      .article-content table td { border: 1px solid var(--gray-200); padding: 8px 10px; }
      .article-content blockquote { border-left: 4px solid var(--primary-color); padding: 8px 16px; background: var(--gray-50); color: var(--gray-800); margin: 16px 0; }
      .article-content pre { background: #1f2937; color: #e5e7eb; padding: 12px; border-radius: 6px; overflow-x: auto; }
      .article-content code { background: #f3f4f6; padding: 2px 6px; border-radius: 4px; }
      .article-content h1, .article-content h2, .article-content h3 { margin-top: 1.25em; margin-bottom: .5em; }
      .article-content ul, .article-content ol { padding-left: 1.2em; margin: .75em 0; }
    </style>
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
                        <li class="nav-item"><a href="members.php" class="nav-link">Equipe</a></li>
                        <li class="nav-item"><a href="labagua/admin/login.php" class="nav-link" target="_blank">Admin</a></li>
                        <li class="nav-item"><a href="index.php#contato" class="nav-link">Contato</a></li>
                    </ul>
                    <div class="nav-cta">
                        <a href="index.php#contato" class="btn btn-primary">Solicitar Teste</a>
                    </div>
                </div>
                <div class="nav-toggle" id="nav-toggle">
                    <span></span><span></span><span></span>
                </div>
            </div>
        </nav>
    </header>

    <?php
    require_once 'admin/functions/db.php';

    $postId = isset($_GET['id']) ? (int) $_GET['id'] : 0;
    $post = null;
    $errorMessage = null;

    if ($postId > 0) {
        // Busca o post
        $postQuery = mysqli_query($connection, "SELECT id, title, author, content, date FROM posts WHERE id = " . $postId . " LIMIT 1");
        if ($postQuery && mysqli_num_rows($postQuery) === 1) {
            $post = mysqli_fetch_assoc($postQuery);
        } else {
            $errorMessage = 'Artigo não encontrado.';
        }

        // Inserção de comentário
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_comment') {
            $nameInput = trim($_POST['name'] ?? '');
            $commentInput = trim($_POST['comment'] ?? '');

            if ($nameInput !== '' && $commentInput !== '') {
                $stmt = mysqli_prepare($connection, 'INSERT INTO comments (name, comment, blogid, date) VALUES (?, ?, ?, NOW())');
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, 'ssi', $nameInput, $commentInput, $postId);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                    header('Location: article.php?id=' . $postId . '#comments');
                    exit;
                }
            } else {
                $errorMessage = 'Preencha seu nome e comentário.';
            }
        }
    } else {
        $errorMessage = 'Artigo inválido.';
    }

    // Buscar comentários (mesmo com erro, não tenta se post inválido)
    $comments = [];
    if ($postId > 0) {
        $commentsQuery = mysqli_query($connection, 'SELECT id, name, comment, date FROM comments WHERE blogid = ' . $postId . ' ORDER BY date DESC');
        if ($commentsQuery && mysqli_num_rows($commentsQuery) > 0) {
            while ($row = mysqli_fetch_assoc($commentsQuery)) {
                $comments[] = $row;
            }
        }
    }
    ?>

    <main id="main-content">
        <section class="page-header">
            <div class="container">
                <div class="page-header-content" data-aos="fade-up">
                    <nav class="breadcrumb">
                        <a href="index.php">Início</a>
                        <i class="fas fa-chevron-right"></i>
                        <a href="articles.php">Artigos</a>
                        <i class="fas fa-chevron-right"></i>
                        <span>Leitura</span>
                    </nav>
                    <h1 class="page-title">Artigo</h1>
                    <p class="page-subtitle">Leitura completa e comentários</p>
                </div>
            </div>
        </section>

        <section class="article-view" style="padding-top: var(--spacing-8);">
            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <?php if ($errorMessage): ?>
                    <div class="empty-state" style="text-align:center;">
                        <i class="fas fa-exclamation-circle" style="font-size: 3rem; color: var(--gray-400);"></i>
                        <h3 style="color: var(--gray-700); margin-top: var(--spacing-3);"><?= htmlspecialchars($errorMessage) ?></h3>
                        <p style="color: var(--gray-500);"><a href="articles.php" class="member-link">Voltar para artigos</a></p>
                    </div>
                <?php else: ?>
                    <article class="article-full">
                        <header class="article-header" style="margin-bottom: var(--spacing-6);">
                            <h2 class="article-title" style="font-size: var(--font-size-3xl); line-height: 1.2;"><?= htmlspecialchars($post['title']) ?></h2>
                            <div class="article-meta" style="margin-top: var(--spacing-2); color: var(--gray-600);">
                                <span><i class="fas fa-user"></i> <?= htmlspecialchars($post['author']) ?></span>
                                <span style="margin: 0 8px; color: var(--gray-400);">|</span>
                                <span><i class="fas fa-calendar"></i> <?= date('d/m/Y H:i', strtotime($post['date'])) ?></span>
                            </div>
                        </header>

                        <?php
                          $rawContent = $post['content'] ?? '';
                          // Remover <script>...</script>
                          $safeContent = preg_replace('/<script\\b[^>]*>[\\s\\S]*?<\\/script>/i', '', $rawContent);
                          // Remover atributos inline do tipo on*
                          $safeContent = preg_replace('/\\son[a-zA-Z]+\\s*=\\s*(\"[^\"]*\"|\'[^\']*\')/i', '', $safeContent);
                          // Neutralizar javascript: em href/src
                          $safeContent = preg_replace('/\\s(href|src)\\s*=\\s*(\"|\')\\s*javascript:[^\"\']*?\2/i', ' $1="#"', $safeContent);
                        ?>
                        <div class="article-content" style="color: var(--gray-800); font-size: var(--font-size-lg); line-height: 1.8;">
                            <?= $safeContent ?>
                        </div>
                    </article>

                    <hr style="margin: var(--spacing-10) 0; border-color: var(--gray-200);">

                    <section id="comments" class="comments" data-aos="fade-up" data-aos-delay="150">
                        <h3 style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); margin-bottom: var(--spacing-4);">Comentários (<?= count($comments) ?>)</h3>

                        <?php if (count($comments) === 0): ?>
                            <p style="color: var(--gray-600);">Seja o primeiro a comentar.</p>
                        <?php else: ?>
                            <div class="comments-list" style="display: grid; gap: var(--spacing-4); margin-bottom: var(--spacing-8);">
                                <?php foreach ($comments as $c): ?>
                                    <div class="comment-card" style="background: var(--gray-50); padding: var(--spacing-4); border-radius: var(--border-radius-lg); border: 1px solid var(--gray-200);">
                                        <div style="display:flex; align-items:center; gap: 10px; margin-bottom: 6px; color: var(--gray-700);">
                                            <i class="fas fa-user-circle" style="font-size: 1.25rem;"></i>
                                            <strong><?= htmlspecialchars($c['name']) ?></strong>
                                            <span style="margin-left:auto; color: var(--gray-500); font-size: 0.9em;">
                                                <?= date('d/m/Y H:i', strtotime($c['date'])) ?>
                                            </span>
                                        </div>
                                        <div style="color: var(--gray-800); white-space: pre-wrap;">
                                            <?= nl2br(htmlspecialchars($c['comment'])) ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <div class="comment-form" style="background: var(--gray-50); padding: var(--spacing-6); border-radius: var(--border-radius-lg); border: 1px solid var(--gray-200);">
                            <h4 style="margin-bottom: var(--spacing-3);">Deixe seu comentário</h4>
                            <?php if ($errorMessage && $_SERVER['REQUEST_METHOD'] === 'POST'): ?>
                                <p style="color:#b00020; margin-bottom: var(--spacing-3);"><?= htmlspecialchars($errorMessage) ?></p>
                            <?php endif; ?>
                            <form method="POST" action="article.php?id=<?= $postId ?>#comments" style="display: grid; gap: var(--spacing-3);">
                                <input type="hidden" name="action" value="add_comment">
                                <div>
                                    <label for="name" style="display:block; margin-bottom: 6px;">Seu nome</label>
                                    <input type="text" id="name" name="name" required class="input" style="width:100%; padding: 10px; border:1px solid var(--gray-300); border-radius: 8px;">
                                </div>
                                <div>
                                    <label for="comment" style="display:block; margin-bottom: 6px;">Comentário</label>
                                    <textarea id="comment" name="comment" rows="4" required class="textarea" style="width:100%; padding: 10px; border:1px solid var(--gray-300); border-radius: 8px;"></textarea>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-paper-plane"></i> Enviar comentário
                                    </button>
                                </div>
                            </form>
                        </div>
                    </section>
                <?php endif; ?>
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
                    <p class="footer-description">Líder em análise profissional de água no Brasil. Precisão, confiabilidade e excelência em cada teste.</p>
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
            </div>
            <div class="footer-bottom">
                <div class="footer-certifications">
                    <span class="cert-badge">ISO 17025</span>
                    <span class="cert-badge">ANVISA</span>
                    <span class="cert-badge">EPA</span>
                </div>
            </div>
        </div>
    </footer>

    <button id="backToTop" class="back-to-top" aria-label="Voltar ao topo">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>

