<?php
/**
 * LabÁgua - Newsletter Subscription Handler
 * Handles newsletter subscription with validation
 */

// Set headers for JSON response
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Método não permitido']);
    exit;
}

try {
    // Validate and sanitize input
    $email = sanitizeInput($_POST['email'] ?? '');
    $name = sanitizeInput($_POST['name'] ?? '');
    
    // Validation
    $errors = [];
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email válido é obrigatório';
    }
    
    // Check for spam (honeypot)
    if (isset($_POST['website']) && !empty($_POST['website'])) {
        $errors[] = 'Spam detectado';
    }
    
    // Rate limiting
    $ip = $_SERVER['REMOTE_ADDR'];
    $rate_limit_file = sys_get_temp_dir() . '/labagua_newsletter_' . md5($ip);
    
    if (file_exists($rate_limit_file)) {
        $last_submission = file_get_contents($rate_limit_file);
        if (time() - $last_submission < 300) { // 5 minutes between submissions
            $errors[] = 'Muitas tentativas. Aguarde 5 minutos antes de tentar novamente.';
        }
    }
    
    if (!empty($errors)) {
        echo json_encode([
            'success' => false,
            'message' => implode('; ', $errors)
        ]);
        exit;
    }
    
    // Check if already subscribed
    if (isAlreadySubscribed($email)) {
        echo json_encode([
            'success' => true,
            'message' => 'Este email já está inscrito em nossa newsletter.'
        ]);
        exit;
    }
    
    // Save rate limit timestamp
    file_put_contents($rate_limit_file, time());
    
    // Save subscription
    $subscription_data = [
        'email' => $email,
        'name' => $name,
        'ip' => $ip,
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
        'subscribed_at' => date('Y-m-d H:i:s'),
        'status' => 'active',
        'source' => 'website'
    ];
    
    // Save to database or file
    saveNewsletterSubscription($subscription_data);
    
    // Send welcome email
    sendWelcomeEmail($email, $name);
    
    // Log successful subscription
    logSubmission('newsletter', $email, 'success');
    
    echo json_encode([
        'success' => true,
        'message' => 'Inscrição realizada com sucesso! Verifique seu email para confirmação.'
    ]);
    
} catch (Exception $e) {
    // Log error
    error_log('Newsletter subscription error: ' . $e->getMessage());
    logSubmission('newsletter', $email ?? 'unknown', 'error', $e->getMessage());
    
    echo json_encode([
        'success' => false,
        'message' => 'Erro interno. Tente novamente mais tarde.'
    ]);
}

/**
 * Sanitize input data
 */
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

/**
 * Check if email is already subscribed
 */
function isAlreadySubscribed($email) {
    try {
        // Try database first
        $db_config = [
            'host' => 'localhost',
            'dbname' => 'labagua_db',
            'username' => 'labagua_user',
            'password' => 'your_db_password'
        ];
        
        $pdo = new PDO(
            "mysql:host={$db_config['host']};dbname={$db_config['dbname']};charset=utf8mb4",
            $db_config['username'],
            $db_config['password'],
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
        
        $stmt = $pdo->prepare("SELECT id FROM newsletter_subscribers WHERE email = ? AND status = 'active'");
        $stmt->execute([$email]);
        
        return $stmt->rowCount() > 0;
        
    } catch (PDOException $e) {
        // Fallback to file-based check
        $subscribers_file = __DIR__ . '/../data/newsletter_subscribers.json';
        
        if (file_exists($subscribers_file)) {
            $subscribers = json_decode(file_get_contents($subscribers_file), true) ?? [];
            
            foreach ($subscribers as $subscriber) {
                if ($subscriber['email'] === $email && $subscriber['status'] === 'active') {
                    return true;
                }
            }
        }
        
        return false;
    }
}

/**
 * Save newsletter subscription
 */
function saveNewsletterSubscription($data) {
    try {
        // Try database first
        $db_config = [
            'host' => 'localhost',
            'dbname' => 'labagua_db',
            'username' => 'labagua_user',
            'password' => 'your_db_password'
        ];
        
        $pdo = new PDO(
            "mysql:host={$db_config['host']};dbname={$db_config['dbname']};charset=utf8mb4",
            $db_config['username'],
            $db_config['password'],
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        );
        
        $sql = "INSERT INTO newsletter_subscribers (email, name, ip, user_agent, subscribed_at, status, source) 
                VALUES (:email, :name, :ip, :user_agent, :subscribed_at, :status, :source)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute($data);
        
    } catch (PDOException $e) {
        // Fallback to file storage
        $subscribers_file = __DIR__ . '/../data/newsletter_subscribers.json';
        $data_dir = dirname($subscribers_file);
        
        // Create data directory if it doesn't exist
        if (!is_dir($data_dir)) {
            mkdir($data_dir, 0755, true);
        }
        
        // Load existing subscribers
        $subscribers = [];
        if (file_exists($subscribers_file)) {
            $subscribers = json_decode(file_get_contents($subscribers_file), true) ?? [];
        }
        
        // Add new subscriber
        $data['id'] = uniqid();
        $subscribers[] = $data;
        
        // Save to file
        file_put_contents($subscribers_file, json_encode($subscribers, JSON_PRETTY_PRINT), LOCK_EX);
    }
}

/**
 * Send welcome email
 */
function sendWelcomeEmail($email, $name) {
    $config = [
        'from_email' => 'contato@labagua.com.br',
        'from_name' => 'LabÁgua'
    ];
    
    $subject = 'Bem-vindo à Newsletter LabÁgua!';
    
    $html_body = generateWelcomeEmailTemplate($name);
    
    $headers = [
        'MIME-Version: 1.0',
        'Content-Type: text/html; charset=UTF-8',
        'From: ' . $config['from_name'] . ' <' . $config['from_email'] . '>',
        'X-Mailer: PHP/' . phpversion()
    ];
    
    mail($email, $subject, $html_body, implode("\r\n", $headers));
}

/**
 * Generate welcome email template
 */
function generateWelcomeEmailTemplate($name) {
    $display_name = !empty($name) ? htmlspecialchars($name) : 'Caro(a) assinante';
    
    return '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bem-vindo à Newsletter LabÁgua</title>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 0; }
            .container { max-width: 600px; margin: 0 auto; background: white; }
            .header { background: linear-gradient(135deg, #1e40af, #3b82f6); color: white; padding: 40px 20px; text-align: center; }
            .logo { font-size: 28px; font-weight: bold; margin-bottom: 10px; }
            .content { padding: 40px 30px; }
            .welcome-box { background: #f8fafc; border-left: 4px solid #1e40af; padding: 20px; margin: 20px 0; }
            .benefits { background: #f0f9ff; padding: 20px; border-radius: 8px; margin: 20px 0; }
            .benefit-item { display: flex; align-items: center; margin: 10px 0; }
            .benefit-icon { color: #10b981; margin-right: 10px; font-weight: bold; }
            .footer { background: #1e293b; color: #94a3b8; padding: 30px 20px; text-align: center; font-size: 12px; }
            .footer a { color: #3b82f6; text-decoration: none; }
            .btn { display: inline-block; background: #1e40af; color: white; padding: 12px 24px; text-decoration: none; border-radius: 6px; margin: 20px 0; }
            .unsubscribe { margin-top: 20px; font-size: 11px; color: #6b7280; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <div class="logo">LabÁgua</div>
                <p style="margin: 0; font-size: 18px;">Análise Precisa de Água. Resultados Confiáveis.</p>
            </div>
            
            <div class="content">
                <h1 style="color: #1e40af;">Bem-vindo(a) à nossa newsletter!</h1>
                
                <div class="welcome-box">
                    <h2 style="margin-top: 0; color: #1e40af;">Olá, ' . $display_name . '!</h2>
                    <p>Obrigado por se inscrever na newsletter da LabÁgua. Agora você receberá as melhores informações sobre qualidade da água, dicas de análise e novidades do setor.</p>
                </div>
                
                <h3 style="color: #1e40af;">O que você receberá:</h3>
                <div class="benefits">
                    <div class="benefit-item">
                        <span class="benefit-icon">✓</span>
                        <span>Dicas mensais sobre qualidade da água</span>
                    </div>
                    <div class="benefit-item">
                        <span class="benefit-icon">✓</span>
                        <span>Novidades em análises e tecnologias</span>
                    </div>
                    <div class="benefit-item">
                        <span class="benefit-icon">✓</span>
                        <span>Promoções exclusivas em nossos serviços</span>
                    </div>
                    <div class="benefit-item">
                        <span class="benefit-icon">✓</span>
                        <span>Informações sobre cursos e certificações</span>
                    </div>
                    <div class="benefit-item">
                        <span class="benefit-icon">✓</span>
                        <span>Alertas sobre mudanças na legislação</span>
                    </div>
                </div>
                
                <p><strong>Precisa de uma análise de água agora?</strong></p>
                <p>Nossa equipe está pronta para atendê-lo com os mais altos padrões de qualidade e rapidez.</p>
                
                <center>
                    <a href="https://labagua.com.br/#contato" class="btn">Solicitar Análise</a>
                </center>
                
                <p>Atenciosamente,<br>
                <strong>Equipe LabÁgua</strong></p>
            </div>
            
            <div class="footer">
                <p><strong>LabÁgua - Laboratório de Análise de Água</strong></p>
                <p>Rua das Análises, 123 - Centro, São Paulo - SP | CEP: 01234-567</p>
                <p>Telefone: (11) 3456-7890 | Email: contato@labagua.com.br</p>
                <p><a href="https://labagua.com.br">www.labagua.com.br</a></p>
                
                <div class="unsubscribe">
                    <p>Você está recebendo este email porque se inscreveu em nossa newsletter.</p>
                    <p><a href="https://labagua.com.br/unsubscribe?email=' . urlencode($email ?? '') . '">Cancelar inscrição</a></p>
                </div>
            </div>
        </div>
    </body>
    </html>';
}

/**
 * Log submission for monitoring
 */
function logSubmission($type, $email, $status, $error = null) {
    $log_entry = [
        'timestamp' => date('Y-m-d H:i:s'),
        'type' => $type,
        'email' => $email,
        'status' => $status,
        'ip' => $_SERVER['REMOTE_ADDR'],
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
        'error' => $error
    ];
    
    $log_file = __DIR__ . '/../logs/submissions.log';
    
    // Create logs directory if it doesn't exist
    $log_dir = dirname($log_file);
    if (!is_dir($log_dir)) {
        mkdir($log_dir, 0755, true);
    }
    
    file_put_contents($log_file, json_encode($log_entry) . "\n", FILE_APPEND | LOCK_EX);
}
?>