<section class="articles" id="artigos">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Últimos Artigos</h2>
                <p class="section-subtitle">Conteúdo técnico e notícias sobre qualidade da água</p>
            </div>
            <style>
              .article-excerpt.rich-excerpt { 
                display: -webkit-box; -webkit-line-clamp: 6; -webkit-box-orient: vertical; overflow: hidden; 
                color: var(--gray-800); line-height: 1.7; min-height: 7.5em;
              }
              .article-excerpt.rich-excerpt img, 
              .article-excerpt.rich-excerpt table, 
              .article-excerpt.rich-excerpt pre { display: none !important; }
              .article-excerpt.rich-excerpt ul, .article-excerpt.rich-excerpt ol { padding-left: 1.2em; }
            </style>
            <div class="articles-grid" data-aos="fade-up" data-aos-delay="100">
                <?php
                try {
                    require_once 'admin/functions/db.php';
                    $sql = 'SELECT * FROM posts ORDER BY date DESC LIMIT 3';
                    $query = mysqli_query($connection, $sql);

                    if ($query && mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_array($query)) {
                            $raw = $row['content'] ?? '';
                            $safe = preg_replace('/<script\\b[^>]*>[\\s\\S]*?<\\/script>/i', '', $raw);
                            $safe = preg_replace('/\\son[a-zA-Z]+\\s*=\\s*(\"[^\"]*\"|\'[^\']*\')/i', '', $safe);
                            $safe = preg_replace('/\\s(href|src)\\s*=\\s*(\"|\')\\s*javascript:[^\"\']*?\2/i', ' $1="#"', $safe);
                            // Remove imagens do resumo para manter o layout limpo
                            $safe = preg_replace('/<img[^>]*>/i', '', $safe);
                            echo '<article class="article-card">
                                    <h3 class="article-title">
                                        <a href="article.php?id=' . $row["id"] . '">' . htmlspecialchars($row["title"]) . '</a>
                                    </h3>
                                    <div class="article-excerpt rich-excerpt">' . $safe . '</div>
                                    <div class="article-meta">
                                        <span class="article-author">' . htmlspecialchars($row["author"]) . '</span>
                                        <span class="article-date">' . htmlspecialchars($row["date"]) . '</span>
                                    </div>
                                  </article>';
                        }
                    } else {
                        echo '<div class="col-12 text-center" style="grid-column: 1 / -1;">
                                <p style="color: var(--gray-500);">Desculpe, ainda não há postagens :( Em breve postaremos novos conteúdos!</p>
                              </div>';
                    }
                } catch (Exception $e) {
                    echo '<div class="col-12 text-center" style="grid-column: 1 / -1;">
                            <p style="color: var(--gray-500);">Desculpe, ainda não há postagens :( Em breve postaremos novos conteúdos!</p>
                          </div>';
                }
                ?>
            </div>
            <div class="text-center" data-aos="fade-up" data-aos-delay="200">
                <a href="articles.php" class="btn btn-primary">Ver Todos os Artigos</a>
            </div>
        </div>
    </section>