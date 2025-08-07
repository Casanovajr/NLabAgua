<?php
/**
 * Verificador de Recursos - Admin
 * LabÁgua - Sistema de Análise de Água
 * 
 * Este arquivo verifica quais recursos (CSS, JS, imagens) estão faltando
 * e causando erros 404.
 */

// Habilitar exibição de erros para debug
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>🔍 Verificador de Recursos - Admin LabÁgua</h1>";

// Lista de recursos que devem existir
$resources = [
    // CSS Files
    'bootstrap/dist/css/bootstrap.min.css' => 'Bootstrap CSS',
    '../plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css' => 'Bootstrap Extension CSS',
    '../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css' => 'Sidebar Navigation CSS',
    '../plugins/bower_components/toast-master/css/jquery.toast.css' => 'Toast CSS',
    '../plugins/bower_components/morrisjs/morris.css' => 'Morris Charts CSS',
    'css/animate.css' => 'Animate CSS',
    'css/style.css' => 'Custom Style CSS',
    'css/colors/blue.css' => 'Blue Theme CSS',
    
    // JavaScript Files
    '../plugins/bower_components/jquery/dist/jquery.min.js' => 'jQuery',
    'bootstrap/dist/js/tether.min.js' => 'Tether JS',
    'bootstrap/dist/js/bootstrap.min.js' => 'Bootstrap JS',
    '../plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js' => 'Bootstrap Extension JS',
    '../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js' => 'Sidebar Navigation JS',
    'js/jquery.slimscroll.js' => 'Slimscroll JS',
    'js/waves.js' => 'Waves JS',
    '../plugins/bower_components/waypoints/lib/jquery.waypoints.js' => 'Waypoints JS',
    '../plugins/bower_components/counterup/jquery.counterup.min.js' => 'Counter Up JS',
    '../plugins/bower_components/raphael/raphael-min.js' => 'Raphael JS',
    '../plugins/bower_components/morrisjs/morris.js' => 'Morris Charts JS',
    'js/custom.min.js' => 'Custom JS',
    'js/dashboard1.js' => 'Dashboard JS',
    '../plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js' => 'Sparkline JS',
    '../plugins/bower_components/jquery-sparkline/jquery.charts-sparkline.js' => 'Charts Sparkline JS',
    '../plugins/bower_components/toast-master/js/jquery.toast.js' => 'Toast JS',
    '../plugins/bower_components/styleswitcher/jQuery.style.switcher.js' => 'Style Switcher JS',
    
    // Images
    '../images/agua.png' => 'Logo Água',
    '../plugins/images/user.jpg' => 'User Avatar',
    
    // Fonts (verificar se existem)
    'bootstrap/dist/fonts/' => 'Bootstrap Fonts Directory',
    '../plugins/bower_components/font-awesome/fonts/' => 'Font Awesome Fonts Directory'
];

echo "<h2>📁 Verificando Recursos</h2>";

$missing = [];
$found = [];

foreach ($resources as $path => $description) {
    $fullPath = __DIR__ . '/' . $path;
    
    if (file_exists($fullPath) || is_dir($fullPath)) {
        $found[] = "✅ $description ($path)";
    } else {
        $missing[] = "❌ $description ($path)";
    }
}

echo "<h3>✅ Recursos Encontrados (" . count($found) . "):</h3>";
echo "<ul>";
foreach ($found as $item) {
    echo "<li>$item</li>";
}
echo "</ul>";

echo "<h3>❌ Recursos Faltando (" . count($missing) . "):</h3>";
if (empty($missing)) {
    echo "<p style='color: green;'>🎉 Todos os recursos estão presentes!</p>";
} else {
    echo "<ul>";
    foreach ($missing as $item) {
        echo "<li>$item</li>";
    }
    echo "</ul>";
}

// Verificar estrutura de diretórios
echo "<h2>📂 Estrutura de Diretórios</h2>";

$directories = [
    'bootstrap' => 'Bootstrap Framework',
    'css' => 'CSS Files',
    'js' => 'JavaScript Files',
    '../plugins' => 'Plugins Directory',
    '../images' => 'Images Directory'
];

foreach ($directories as $dir => $description) {
    $fullPath = __DIR__ . '/' . $dir;
    if (is_dir($fullPath)) {
        echo "✅ $description ($dir)<br>";
    } else {
        echo "❌ $description ($dir) - <strong>DIRETÓRIO FALTANDO!</strong><br>";
    }
}

// Verificar se o Bootstrap está presente
echo "<h2>🎨 Verificação do Bootstrap</h2>";
$bootstrapPath = __DIR__ . '/bootstrap';
if (is_dir($bootstrapPath)) {
    echo "✅ Bootstrap encontrado em: $bootstrapPath<br>";
    
    // Verificar arquivos principais do Bootstrap
    $bootstrapFiles = [
        'dist/css/bootstrap.min.css',
        'dist/js/bootstrap.min.js',
        'dist/js/tether.min.js'
    ];
    
    foreach ($bootstrapFiles as $file) {
        $fullPath = $bootstrapPath . '/' . $file;
        if (file_exists($fullPath)) {
            echo "✅ $file<br>";
        } else {
            echo "❌ $file - <strong>ARQUIVO FALTANDO!</strong><br>";
        }
    }
} else {
    echo "❌ <strong>Bootstrap não encontrado!</strong><br>";
    echo "💡 Solução: Baixe o Bootstrap e extraia na pasta admin/<br>";
}

// Verificar plugins
echo "<h2>🔌 Verificação de Plugins</h2>";
$pluginsPath = __DIR__ . '/../plugins';
if (is_dir($pluginsPath)) {
    echo "✅ Plugins encontrado em: $pluginsPath<br>";
    
    // Verificar alguns plugins importantes
    $importantPlugins = [
        'bower_components/jquery/dist/jquery.min.js',
        'bower_components/bootstrap-extension/css/bootstrap-extension.css',
        'bower_components/sidebar-nav/dist/sidebar-nav.min.css'
    ];
    
    foreach ($importantPlugins as $plugin) {
        $fullPath = $pluginsPath . '/' . $plugin;
        if (file_exists($fullPath)) {
            echo "✅ $plugin<br>";
        } else {
            echo "❌ $plugin - <strong>PLUGIN FALTANDO!</strong><br>";
        }
    }
} else {
    echo "❌ <strong>Pasta plugins não encontrada!</strong><br>";
    echo "💡 Solução: Verifique se a pasta plugins existe na raiz do projeto<br>";
}

// Sugestões de correção
if (!empty($missing)) {
    echo "<h2>🔧 Sugestões de Correção</h2>";
    echo "<div style='background: #fff3cd; border: 1px solid #ffc107; padding: 15px; border-radius: 5px;'>";
    echo "<h3>Para resolver os erros 404:</h3>";
    echo "<ol>";
    echo "<li><strong>Baixe o Bootstrap:</strong> <a href='https://getbootstrap.com/docs/3.3/getting-started/#download' target='_blank'>Bootstrap 3.3.7</a></li>";
    echo "<li><strong>Extraia na pasta admin/</strong> para criar admin/bootstrap/</li>";
    echo "<li><strong>Verifique a pasta plugins:</strong> Deve estar em ../plugins/</li>";
    echo "<li><strong>Verifique as imagens:</strong> Deve estar em ../images/</li>";
    echo "<li><strong>Verifique os arquivos CSS/JS:</strong> Deve estar em admin/css/ e admin/js/</li>";
    echo "</ol>";
    echo "</div>";
}

// Verificar permissões
echo "<h2>🔐 Verificação de Permissões</h2>";
$pathsToCheck = [
    'bootstrap' => 'Bootstrap Directory',
    'css' => 'CSS Directory',
    'js' => 'JavaScript Directory',
    '../plugins' => 'Plugins Directory',
    '../images' => 'Images Directory'
];

foreach ($pathsToCheck as $path => $description) {
    $fullPath = __DIR__ . '/' . $path;
    if (is_dir($fullPath)) {
        $perms = substr(sprintf('%o', fileperms($fullPath)), -4);
        echo "📁 $description: $perms<br>";
        
        if ($perms < '0755') {
            echo "⚠️ Permissões baixas para $description<br>";
        }
    }
}

echo "<h2>🎯 Próximos Passos</h2>";
echo "<div style='background: #d1ecf1; border: 1px solid #bee5eb; padding: 15px; border-radius: 5px;'>";
echo "<p><strong>Se houver recursos faltando:</strong></p>";
echo "<ul>";
echo "<li>Baixe os arquivos necessários</li>";
echo "<li>Coloque-os nos diretórios corretos</li>";
echo "<li>Verifique as permissões dos arquivos</li>";
echo "<li>Teste novamente o admin/index.php</li>";
echo "</ul>";
echo "</div>";

echo "<p><a href='index.php'>← Voltar para o Dashboard</a></p>";

?>
