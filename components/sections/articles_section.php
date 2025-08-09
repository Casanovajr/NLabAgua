<section class="articles" id="artigos">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Últimos Artigos</h2>
                <p class="section-subtitle">Conteúdo técnico e notícias sobre qualidade da água</p>
            </div>
            <div class="articles-grid" data-aos="fade-up" data-aos-delay="100">
                <?php
                try {
                    require_once 'admin/functions/db.php';
                    $sql = 'SELECT * FROM posts ORDER BY date DESC LIMIT 3';
                    $query = mysqli_query($connection, $sql);

                    if ($query && mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_array($query)) {
                            $excerpt = substr(strip_tags($row["content"]), 0, 200) . '...';
                            echo '<article class="article-card">
                                    <h3 class="article-title">
                                        <a href="article.php?id=' . $row["id"] . '">' . htmlspecialchars($row["title"]) . '</a>
                                    </h3>
                                    <p class="article-excerpt">' . htmlspecialchars($excerpt) . '</p>
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