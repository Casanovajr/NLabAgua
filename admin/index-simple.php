<?php
/**
 * Dashboard Simplificado - Admin
 * LabÁgua - Sistema de Análise de Água
 * 
 * Versão que funciona sem recursos externos (CSS/JS)
 */

// Incluir configuração centralizada
require_once __DIR__ . '/includes/config.php';

// Verificar autenticação com sessão segura
requireAuth('login.php');

$email = sanitizeOutput($_SESSION['email']);

// Usar as funções do banco de dados configuradas
$posts = fetchMultiple("SELECT * FROM posts");
$contacts = fetchMultiple("SELECT * FROM contacts");
$subscribers = fetchMultiple("SELECT * FROM subscribers");
$comments = fetchMultiple("SELECT * FROM comments");

// Contar registros
$postsCount = count($posts);
$contactsCount = count($contacts);
$subscribersCount = count($subscribers);
$commentsCount = count($comments);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - LabÁgua Admin</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            color: #333;
            line-height: 1.6;
        }
        
        .header {
            background: #3c8dbc;
            color: white;
            padding: 1rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .header h1 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }
        
        .header p {
            opacity: 0.9;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            text-align: center;
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            color: #666;
            font-size: 0.9rem;
        }
        
        .posts { color: #e74c3c; }
        .comments { color: #9b59b6; }
        .contacts { color: #3498db; }
        .subscribers { color: #27ae60; }
        
        .content-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }
        
        .content-card {
            background: white;
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .content-card h3 {
            margin-bottom: 1rem;
            color: #333;
            border-bottom: 2px solid #3c8dbc;
            padding-bottom: 0.5rem;
        }
        
        .comment-item, .post-item {
            padding: 1rem;
            border-bottom: 1px solid #eee;
            margin-bottom: 1rem;
        }
        
        .comment-item:last-child, .post-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }
        
        .comment-author, .post-title {
            font-weight: bold;
            color: #3c8dbc;
            margin-bottom: 0.5rem;
        }
        
        .comment-text, .post-date {
            color: #666;
            font-size: 0.9rem;
        }
        
        .nav-menu {
            background: #2c3e50;
            padding: 1rem;
            margin-bottom: 2rem;
        }
        
        .nav-menu a {
            color: white;
            text-decoration: none;
            margin-right: 1rem;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: background 0.3s;
        }
        
        .nav-menu a:hover {
            background: #34495e;
        }
        
        .nav-menu a.active {
            background: #3c8dbc;
        }
        
        .alert {
            padding: 1rem;
            border-radius: 4px;
            margin-bottom: 1rem;
        }
        
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .empty-message {
            text-align: center;
            color: #666;
            font-style: italic;
            padding: 2rem;
        }
        
        .btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            background: #3c8dbc;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 1rem;
        }
        
        .btn:hover {
            background: #367fa9;
        }
        
        @media (max-width: 768px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
            
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🏢 LabÁgua - Área Administrativa</h1>
        <p>Bem-vindo, <?php echo $email; ?> | <a href="functions/logout.php" style="color: white;">Sair</a></p>
    </div>
    
    <div class="nav-menu">
        <a href="index-simple.php" class="active">Dashboard</a>
        <a href="posts.php">Artigos</a>
        <a href="comments.php">Comentários</a>
        <a href="inbox.php">Mensagens</a>
        <a href="subscribers.php">Inscritos</a>
        <a href="users.php">Usuários</a>
        <a href="check_resources.php">Verificar Recursos</a>
    </div>
    
    <div class="container">
        <?php if (isset($_GET['set'])): ?>
            <div class="alert alert-success">
                <strong>Sucesso!</strong> Sua senha foi atualizada com sucesso.
            </div>
        <?php endif; ?>
        
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number posts"><?php echo $postsCount; ?></div>
                <div class="stat-label">Artigos Publicados</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number comments"><?php echo $commentsCount; ?></div>
                <div class="stat-label">Comentários</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number contacts"><?php echo $contactsCount; ?></div>
                <div class="stat-label">Mensagens</div>
            </div>
            
            <div class="stat-card">
                <div class="stat-number subscribers"><?php echo $subscribersCount; ?></div>
                <div class="stat-label">Inscritos</div>
            </div>
        </div>
        
        <div class="content-grid">
            <div class="content-card">
                <h3>💬 Comentários Recentes</h3>
                <?php if (empty($comments)): ?>
                    <div class="empty-message">Nenhum comentário ainda.</div>
                <?php else: ?>
                    <?php 
                    $counter = 0;
                    $max = 3;
                    
                    foreach ($comments as $comment) {
                        if ($counter >= $max) break;
                        
                        $blogid = $comment["blogid"];
                        $post = fetchSingle("SELECT * FROM posts WHERE id = ?", [$blogid]);
                        
                        if ($post) {
                            echo '<div class="comment-item">';
                            echo '<div class="comment-author">' . htmlspecialchars($comment["name"]) . '</div>';
                            echo '<div class="comment-text">' . htmlspecialchars($comment["comment"]) . '</div>';
                            echo '<div class="post-title">Artigo: ' . htmlspecialchars($post["title"]) . '</div>';
                            echo '<div class="post-date">' . htmlspecialchars($comment["date"]) . '</div>';
                            echo '</div>';
                            $counter++;
                        }
                    }
                    ?>
                    <a href="comments.php" class="btn">Ver Todos os Comentários</a>
                <?php endif; ?>
            </div>
            
            <div class="content-card">
                <h3>📰 Artigos Recentes</h3>
                <?php if (empty($posts)): ?>
                    <div class="empty-message">Nenhum artigo publicado ainda.</div>
                <?php else: ?>
                    <?php 
                    $counter = 0;
                    $max = 3;
                    
                    foreach ($posts as $post) {
                        if ($counter >= $max) break;
                        
                        $postid = $post["id"];
                        $commentsForPost = fetchMultiple("SELECT * FROM comments WHERE blogid = ?", [$postid]);
                        $commentsCount = count($commentsForPost);
                        
                        echo '<div class="post-item">';
                        echo '<div class="post-title">' . htmlspecialchars($post["title"]) . '</div>';
                        echo '<div class="post-date">' . htmlspecialchars($post["date"]) . '</div>';
                        echo '<div class="comment-text">Comentários: ' . $commentsCount . '</div>';
                        echo '</div>';
                        $counter++;
                    }
                    ?>
                    <a href="posts.php" class="btn">Ver Todos os Artigos</a>
                <?php endif; ?>
            </div>
        </div>
        
        <div style="text-align: center; margin-top: 2rem; padding: 1rem; background: #f8f9fa; border-radius: 8px;">
            <p><strong>💡 Dica:</strong> Esta é a versão simplificada do dashboard. Para a versão completa com todos os recursos visuais, execute o verificador de recursos primeiro.</p>
            <a href="check_resources.php" class="btn">🔍 Verificar Recursos</a>
        </div>
    </div>
</body>
</html>
