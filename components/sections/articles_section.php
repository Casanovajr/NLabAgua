<?php
// Função para extrair primeira imagem do conteúdo
function extractFirstImageForArticles(string $html): ?string {
    if (preg_match('/(?:data-mce-src|src)\s*=\s*["\']([^"\']*\/uploads\/[^"\']+)["\']/i', $html, $m)) {
        $path = $m[1];
        if (strpos($path, '/labag/uploads/') === 0) {
            return 'uploads/' . basename($path);
        } elseif (strpos($path, '/uploads/') === 0) {
            return 'uploads/' . basename($path);
        }
        return $path;
    }
    if (preg_match('/<img[^>]+src=["\']([^"\']+)["\']/i', $html, $m)) {
        return $m[1];
    }
    return null;
}

// Função para determinar categoria baseada no conteúdo
function getArticleCategory($title, $content): array {
    $title_lower = strtolower($title);
    $content_lower = strtolower($content);
    
    if (strpos($title_lower, 'análise') !== false || strpos($content_lower, 'análise') !== false) {
        return ['name' => 'ANÁLISE', 'color' => '#007cc0'];
    } elseif (strpos($title_lower, 'qualidade') !== false || strpos($content_lower, 'qualidade') !== false) {
        return ['name' => 'QUALIDADE', 'color' => '#0094d6'];
    } elseif (strpos($title_lower, 'laboratório') !== false || strpos($content_lower, 'laboratório') !== false) {
        return ['name' => 'LABORATÓRIO', 'color' => '#00a2ff'];
    } elseif (strpos($title_lower, 'pesquisa') !== false || strpos($content_lower, 'pesquisa') !== false) {
        return ['name' => 'PESQUISA', 'color' => '#189dfb'];
    } else {
        return ['name' => 'NOTÍCIAS', 'color' => '#005a8c'];
    }
}
?>

<section class="articles-modern" id="artigos">
    <style>
        .articles-modern {
            padding: 60px 0;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            position: relative;
        }
        .articles-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent 0%, var(--primary-color) 50%, transparent 100%);
        }
        .articles-header {
            text-align: center;
            margin-bottom: 50px;
        }
        .articles-header h2 {
            font-size: clamp(28px, 4vw, 42px);
            font-weight: 700;
            color: var(--primary-color);
            margin: 0 0 12px 0;
            position: relative;
        }
        .articles-header p {
            font-size: 18px;
            color: var(--gray-600);
            margin: 0;
        }
        .articles-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .article-card-modern {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 124, 192, 0.08);
            transition: all 0.3s ease;
            position: relative;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .article-card-modern:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 124, 192, 0.15);
        }
        .article-image {
            position: relative;
            height: 220px;
            background-size: cover;
            background-position: center;
            background-color: var(--gray-100);
            overflow: hidden;
        }
        .article-image::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(0,124,192,0.1) 0%, rgba(0,148,214,0.2) 100%);
            z-index: 1;
        }
        .article-image.no-image {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .article-image.no-image::after {
            content: '📄';
            font-size: 48px;
            opacity: 0.7;
            z-index: 2;
            position: relative;
        }
        .article-category {
            position: absolute;
            top: 16px;
            left: 16px;
            background: rgba(255,255,255,0.95);
            color: var(--primary-color);
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            z-index: 2;
            backdrop-filter: blur(10px);
        }
        .article-content {
            padding: 24px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        .article-meta-top {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
            font-size: 13px;
            color: var(--gray-500);
        }
        .article-date {
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .article-date::before {
            content: '📅';
            font-size: 12px;
        }
        .article-title-modern {
            margin: 0 0 16px 0;
            flex-grow: 1;
        }
        .article-title-modern a {
            color: var(--gray-800);
            text-decoration: none;
            font-size: clamp(18px, 2.5vw, 22px);
            font-weight: 700;
            line-height: 1.3;
            display: block;
            transition: color 0.3s ease;
        }
        .article-title-modern a:hover {
            color: var(--primary-color);
        }
        .article-excerpt-modern {
            color: var(--gray-600);
            font-size: 15px;
            line-height: 1.6;
            margin-bottom: 20px;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .article-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 16px;
            border-top: 1px solid var(--gray-200);
            margin-top: auto;
        }
        .article-author {
            color: var(--gray-500);
            font-size: 14px;
            font-weight: 500;
        }
        .article-author::before {
            content: '✍️ ';
            margin-right: 4px;
        }
        .read-more {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            padding: 8px 16px;
            border-radius: 8px;
            border: 1px solid transparent;
        }
        .read-more:hover {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }
        .articles-cta {
            text-align: center;
            margin-top: 50px;
        }
        .btn-view-all {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 16px 32px;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(0, 124, 192, 0.3);
        }
        .btn-view-all:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 124, 192, 0.4);
            color: white;
        }
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--gray-500);
            grid-column: 1 / -1;
        }
        .empty-state h3 {
            color: var(--gray-600);
            margin-bottom: 12px;
        }
        
        @media (max-width: 1024px) {
            .articles-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 25px;
            }
        }
        
        @media (max-width: 768px) {
            .articles-grid {
                grid-template-columns: 1fr;
                gap: 20px;
                padding: 0 16px;
            }
            .article-card-modern:hover {
                transform: none;
            }
        }
    </style>

    <div class="container">
        <div class="articles-header" data-aos="fade-up">
            <h2>🔬 Últimas Notícias</h2>
            <p>Conteúdo técnico e atualizações sobre análise de água</p>
        </div>

        <div class="articles-grid" data-aos="fade-up" data-aos-delay="100">
            <?php
            try {
                require_once 'admin/functions/db.php';
                $sql = 'SELECT * FROM posts ORDER BY date DESC LIMIT 3';
                $query = mysqli_query($connection, $sql);

                if ($query && mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_array($query)) {
                        $title = htmlspecialchars($row['title']);
                        $author = htmlspecialchars($row['author']);
                        $date = date('d/m H\hi', strtotime($row['date']));
                        $content = $row['content'] ?? '';
                        
                        // Extrair imagem
                        $image = extractFirstImageForArticles($content);
                        $imageStyle = $image ? "background-image: url('$image');" : '';
                        $imageClass = $image ? '' : ' no-image';
                        
                        // Determinar categoria
                        $category = getArticleCategory($title, $content);
                        
                        // Criar excerpt limpo
                        $excerpt = strip_tags($content);
                        $excerpt = mb_substr($excerpt, 0, 150) . '...';
                        
                        echo '<article class="article-card-modern" data-aos="fade-up" data-aos-delay="' . (rand(100, 300)) . '">
                                <div class="article-image' . $imageClass . '" style="' . $imageStyle . '">
                                    <div class="article-category" style="color: ' . $category['color'] . ';">' . $category['name'] . '</div>
                                </div>
                                <div class="article-content">
                                    <div class="article-meta-top">
                                        <span class="article-date">' . $date . '</span>
                                    </div>
                                    <h3 class="article-title-modern">
                                        <a href="article.php?id=' . $row['id'] . '">' . $title . '</a>
                                    </h3>
                                    <p class="article-excerpt-modern">' . $excerpt . '</p>
                                    <div class="article-footer">
                                        <span class="article-author">' . $author . '</span>
                                        <a href="article.php?id=' . $row['id'] . '" class="read-more">Ler mais</a>
                                    </div>
                                </div>
                              </article>';
                    }
                } else {
                    echo '<div class="empty-state">
                            <h3>📰 Em breve!</h3>
                            <p>Novos artigos técnicos sobre análise de água serão publicados em breve.</p>
                          </div>';
                }
            } catch (Exception $e) {
                echo '<div class="empty-state">
                        <h3>📰 Em breve!</h3>
                        <p>Novos artigos técnicos sobre análise de água serão publicados em breve.</p>
                      </div>';
            }
            ?>
        </div>

        <div class="articles-cta" data-aos="fade-up" data-aos-delay="200">
            <a href="articles.php" class="btn-view-all">MAIS NOTÍCIAS</a>
        </div>
    </div>
</section>