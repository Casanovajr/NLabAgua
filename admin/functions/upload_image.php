<?php
// TinyMCE image upload handler
// Returns JSON: { location: "<public_url>" }

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

try {
    $rootDir = dirname(__DIR__, 2); // /labag
    $logFile = $rootDir . '/logs/upload_debug.log';
    if (!is_dir($rootDir . '/logs')) { @mkdir($rootDir . '/logs', 0775, true); }
    $log = function ($msg) use ($logFile) {
        @file_put_contents($logFile, '[' . date('Y-m-d H:i:s') . "] " . $msg . "\n", FILE_APPEND);
    };
    $log('request method=' . ($_SERVER['REQUEST_METHOD'] ?? 'n/a') . ', content-length=' . ($_SERVER['CONTENT_LENGTH'] ?? 'n/a'));
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        echo json_encode(['error' => 'Método não permitido']);
        exit;
    }

    if (!isset($_FILES['file'])) {
        $log('no file in request');
        http_response_code(400);
        echo json_encode(['error' => 'Nenhum arquivo enviado']);
        exit;
    }

    $file = $_FILES['file'];

    if ($file['error'] !== UPLOAD_ERR_OK) {
        $errMap = [
            UPLOAD_ERR_INI_SIZE => 'Arquivo excede upload_max_filesize',
            UPLOAD_ERR_FORM_SIZE => 'Arquivo excede MAX_FILE_SIZE do formulário',
            UPLOAD_ERR_PARTIAL => 'Upload parcial',
            UPLOAD_ERR_NO_FILE => 'Nenhum arquivo enviado',
            UPLOAD_ERR_NO_TMP_DIR => 'Pasta temporária ausente',
            UPLOAD_ERR_CANT_WRITE => 'Falha ao escrever no disco',
            UPLOAD_ERR_EXTENSION => 'Upload interrompido por extensão',
        ];
        $log('upload error code=' . $file['error']);
        http_response_code(400);
        echo json_encode(['error' => ($errMap[$file['error']] ?? 'Erro no upload')]);
        exit;
    }

    // Tamanho máximo (8MB)
    $maxBytes = 8 * 1024 * 1024;
    if (!empty($file['size']) && $file['size'] > $maxBytes) {
        $log('file too large: ' . $file['size'] . ' bytes');
        http_response_code(413);
        echo json_encode(['error' => 'Arquivo muito grande (máx. 8MB)']);
        exit;
    }

    // Verificação de MIME real
    $finfo = function_exists('finfo_open') ? finfo_open(FILEINFO_MIME_TYPE) : false;
    $mime = $finfo ? finfo_file($finfo, $file['tmp_name']) : ($file['type'] ?? '');
    if ($finfo) { finfo_close($finfo); }
    $log('detected mime=' . $mime . ', client type=' . ($file['type'] ?? ''));

    $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (!in_array($mime, $allowed, true)) {
        $log('mime not allowed');
        http_response_code(400);
        echo json_encode(['error' => 'Tipo de arquivo não suportado (' . $mime . ')']);
        exit;
    }

    // Destino
    $uploadsDir = $rootDir . '/uploads';
    $canWriteToUploads = true;
    if (!is_dir($uploadsDir)) {
        if (!@mkdir($uploadsDir, 0775, true) && !is_dir($uploadsDir)) {
            $log('failed to create uploads dir: ' . $uploadsDir);
            $canWriteToUploads = false;
        }
    }
    if ($canWriteToUploads && !is_writable($uploadsDir)) {
        @chmod($uploadsDir, 0775);
        if (!is_writable($uploadsDir)) {
            $log('uploads dir not writable: ' . $uploadsDir);
            $canWriteToUploads = false;
        }
    }

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $base = preg_replace('/[^a-zA-Z0-9_-]/', '', pathinfo($file['name'], PATHINFO_FILENAME));
    if ($base === '') { $base = 'image'; }
    $safeName = bin2hex(random_bytes(8)) . '_' . $base . '.' . $ext;
    if ($canWriteToUploads) {
        $targetPath = $uploadsDir . '/' . $safeName;
        if (!@move_uploaded_file($file['tmp_name'], $targetPath)) {
            $log('move_uploaded_file failed from ' . $file['tmp_name'] . ' to ' . $targetPath . ' -> using data URI fallback');
            $binary = @file_get_contents($file['tmp_name']);
            if ($binary !== false) {
                $dataUri = 'data:' . $mime . ';base64,' . base64_encode($binary);
                echo json_encode(['location' => $dataUri]);
                exit;
            }
            http_response_code(500);
            echo json_encode(['error' => 'Falha ao salvar arquivo']);
            exit;
        }

        // URL pública baseada no DOCUMENT_ROOT
        $publicUrl = str_replace($_SERVER['DOCUMENT_ROOT'], '', $targetPath);
        if ($publicUrl === $targetPath) {
            // Fallback para caminho relativo conhecido
            $publicUrl = '/uploads/' . $safeName;
        }

        $log('upload success -> ' . $publicUrl);
        echo json_encode(['location' => $publicUrl]);
    } else {
        // Fallback: retorna data URI (evita 500 em ambientes sem permissão)
        $log('using data URI fallback due to uploads dir issues');
        $binary = @file_get_contents($file['tmp_name']);
        if ($binary === false) {
            http_response_code(500);
            echo json_encode(['error' => 'Falha ao ler arquivo para fallback']);
            exit;
        }
        $dataUri = 'data:' . $mime . ';base64,' . base64_encode($binary);
        echo json_encode(['location' => $dataUri]);
    }
} catch (Throwable $e) {
    http_response_code(500);
    error_log('upload_image.php error: ' . $e->getMessage());
    @file_put_contents(dirname(__DIR__, 2) . '/logs/upload_debug.log', '[' . date('Y-m-d H:i:s') . '] exception: ' . $e->getMessage() . "\n", FILE_APPEND);
    echo json_encode(['error' => 'Erro interno no upload']);
}
exit;
?>


