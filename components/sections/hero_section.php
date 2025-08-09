<?php
// Carrossel com as 3 últimas postagens (título sobreposto e imagem de capa extraída do conteúdo)
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    require_once __DIR__ . '/../../admin/functions/db.php';
} catch (Exception $e) {
    echo "<!-- Erro ao conectar ao banco: " . $e->getMessage() . " -->";
}

function extractFirstImageSrc(string $html): ?string {
    // 1) src/data-mce-src com caminho em uploads
    if (preg_match('/(?:data-mce-src|src)\s*=\s*["\']([^"\']*\/uploads\/[^"\']+)["\']/i', $html, $m)) {
        $path = $m[1];
        // Normalizar o caminho - remover /labag se presente
        if (strpos($path, '/labag/uploads/') === 0) {
            $path = 'uploads/' . basename($path);
        } elseif (strpos($path, '/uploads/') === 0) {
            $path = 'uploads/' . basename($path);
        }
        return $path;
    }
    // 2) Fallback: primeira imagem
    if (preg_match('/<img[^>]+src=["\']([^"\']+)["\']/i', $html, $m)) {
        $path = $m[1];
        // Normalizar o caminho - remover /labag se presente
        if (strpos($path, '/labag/uploads/') === 0) {
            $path = 'uploads/' . basename($path);
        } elseif (strpos($path, '/uploads/') === 0) {
            $path = 'uploads/' . basename($path);
        }
        return $path;
    }
    return null;
}

$slides = [];
$debugInfo = [];

if (isset($connection)) {
    $q = mysqli_query($connection, "SELECT id, title, content FROM posts ORDER BY date DESC LIMIT 3");
    if ($q && mysqli_num_rows($q) > 0) {
        $debugInfo[] = "Posts encontrados: " . mysqli_num_rows($q);
        while ($r = mysqli_fetch_assoc($q)) {
            $img = extractFirstImageSrc($r['content'] ?? '') ?: 'assets/images/wallpaper1.jpg';
            $slides[] = [
                'id' => (int)$r['id'],
                'title' => $r['title'],
                'image' => $img,
            ];
            $debugInfo[] = "Post: {$r['title']} -> Imagem: $img";
        }
    } else {
        $debugInfo[] = "Nenhum post encontrado ou erro na query";
        if ($q === false) {
            $debugInfo[] = "Erro MySQL: " . mysqli_error($connection);
        }
    }
} else {
    $debugInfo[] = "Conexão com banco não disponível";
}

// Debug como comentário HTML
echo "<!-- DEBUG HERO SECTION:\n" . implode("\n", $debugInfo) . "\n-->";
?>

<section class="hero" id="inicio">
  <div class="hero-carousel" data-aos="fade-up">
    <style>
      /* OVERRIDE CSS principal - usar !important para garantir prioridade */
      .hero { 
        position: relative !important; 
        min-height: 70vh !important; 
        height: auto !important; 
        display: block !important; 
        padding: 0 !important; 
        background: none !important;
        border-radius: 8px !important;
        overflow: hidden !important;
      }
      .hero-carousel { 
        position: relative !important; 
        height: 70vh !important; 
        min-height: 420px !important; 
        overflow: hidden !important; 
        border-radius: 8px !important;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1) !important;
      }
      .hero-slide { 
        position: absolute !important; 
        inset: 0 !important; 
        background-size: contain !important; 
        background-position: center !important; 
        background-repeat: no-repeat !important;
        background-color: #f8f9fa !important; /* Fundo neutro para áreas vazias */
        opacity: 0 !important; 
        transition: opacity .6s ease !important; 
        display: block !important; 
        text-decoration: none !important; 
      }
      .hero-slide.active { opacity: 1 !important; }
      .hero-gradient { 
        position: absolute !important; 
        inset: 0 !important; 
        background: linear-gradient(to bottom, 
          rgba(0,0,0,.1) 0%, 
          rgba(0,0,0,.05) 40%, 
          rgba(0,0,0,.3) 70%, 
          rgba(0,0,0,.7) 100%
        ) !important; 
      }
      .hero-caption { 
        position: absolute !important; 
        left: 6% !important; 
        right: 6% !important; 
        bottom: 8% !important; 
        color: #fff !important; 
        z-index: 10 !important; 
        text-align: left !important;
        max-width: 600px !important;
        background: rgba(0,0,0,0.3) !important; /* Fundo semi-transparente para legibilidade */
        padding: 20px !important;
        border-radius: 12px !important;
        backdrop-filter: blur(5px) !important;
      }
      .hero-caption h2 { 
        font-size: clamp(24px, 4vw, 48px) !important; 
        font-weight: 800 !important; 
        line-height: 1.1 !important; 
        margin: 0 0 .8rem 0 !important; 
        color: #fff !important;
        text-shadow: 2px 2px 8px rgba(0,0,0,0.7) !important;
        letter-spacing: -0.5px !important;
      }
      .hero-caption p { 
        font-size: clamp(16px, 2.2vw, 20px) !important; 
        margin: 0 0 1.5rem 0 !important; 
        color: #fff !important;
        text-shadow: 1px 1px 4px rgba(0,0,0,0.6) !important;
        line-height: 1.4 !important;
        opacity: 0.95 !important;
      }
      .btn.btn-primary { 
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%) !important; 
        color: white !important; 
        padding: 14px 28px !important; 
        border: none !important; 
        border-radius: 8px !important; 
        text-decoration: none !important; 
        display: inline-block !important; 
        font-weight: 600 !important; 
        font-size: 16px !important;
        box-shadow: 0 4px 15px rgba(0,123,255,0.3) !important;
        transition: all 0.3s ease !important;
        text-shadow: none !important;
      }
      .btn.btn-primary:hover { 
        background: linear-gradient(135deg, #0056b3 0%, #004085 100%) !important; 
        transform: translateY(-2px) !important;
        box-shadow: 0 6px 20px rgba(0,123,255,0.4) !important;
      }
      .hero-dots { 
        position: absolute !important; 
        bottom: 6% !important; 
        left: 0 !important; 
        right: 0 !important; 
        display: flex !important; 
        gap: 12px !important; 
        justify-content: center !important; 
        z-index: 10 !important; 
      }
      .hero-dot { 
        width: 14px !important; 
        height: 14px !important; 
        border-radius: 50% !important; 
        background: rgba(255,255,255,.4) !important; 
        cursor: pointer !important; 
        transition: all 0.3s ease !important;
        border: 2px solid rgba(255,255,255,.6) !important;
      }
      .hero-dot.active { 
        background: #fff !important; 
        border-color: #fff !important;
        transform: scale(1.2) !important;
      }
      .hero-dot:hover { 
        background: rgba(255,255,255,.7) !important; 
        transform: scale(1.1) !important;
      }
    </style>

    <?php if (count($slides) === 0): ?>
      <!-- FALLBACK: Sem posts no banco -->
      <div class="hero-slide active" style="background-image: url('assets/images/wallpaper1.jpg');">
        <div class="hero-gradient"></div>
        <div class="hero-caption">
          <h2>Análise Precisa de Água</h2>
          <p>Laboratório especializado em análise de qualidade da água</p>
          <a href="#servicos" class="btn btn-primary">Ver Serviços</a>
        </div>
      </div>
    <?php else: ?>
      <!-- CARROSSEL COM POSTS -->
      <?php foreach ($slides as $i => $s): ?>
        <a class="hero-slide <?= $i === 0 ? 'active' : '' ?>" href="article.php?id=<?= $s['id'] ?>" style="background-image: url('<?= htmlspecialchars($s['image']) ?>');">
          <div class="hero-gradient"></div>
          <div class="hero-caption">
            <h2><?= htmlspecialchars($s['title']) ?></h2>
          </div>
        </a>
      <?php endforeach; ?>
      <div class="hero-dots">
        <?php foreach ($slides as $i => $_): ?>
          <div class="hero-dot <?= $i === 0 ? 'active' : '' ?>" data-index="<?= $i ?>"></div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>

  <script>
    (function(){
      var slides = Array.prototype.slice.call(document.querySelectorAll('.hero-slide'));
      var dots = Array.prototype.slice.call(document.querySelectorAll('.hero-dot'));
      var idx = 0, timer;
      function show(n){
        slides.forEach(function(s,i){ s.classList.toggle('active', i===n); });
        dots.forEach(function(d,i){ d.classList.toggle('active', i===n); });
        idx = n;
      }
      function next(){ show((idx+1) % slides.length); }
      function start(){ if(slides.length>1){ timer = setInterval(next, 6000); } }
      function stop(){ if(timer){ clearInterval(timer); timer=null; } }
      dots.forEach(function(d,i){ d.addEventListener('click', function(){ stop(); show(i); start(); }); });
      start();
    })();
  </script>
</section>