<?php
/**
 * LabÁgua - Contact Form Handler
 * Handles contact form submissions with validation and email sending
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

// Configuration
$config = [
    'smtp_host' => 'smtp.hostinger.com',
    'smtp_port' => 587,
    'smtp_username' => 'contato@labagua.com.br',
    'smtp_password' => 'your_email_password', // Change this
    'from_email' => 'contato@labagua.com.br',
    'from_name' => 'LabÁgua',
    'to_email' => 'contato@labagua.com.br',
    'to_name' => 'LabÁgua',
    'max_file_size' => 5 * 1024 * 1024, // 5MB
    'allowed_file_types' => ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx']
];

try {
    // Validate and sanitize input
    $name = sanitizeInput($_POST['name'] ?? '');
    $email = sanitizeInput($_POST['email'] ?? '');
    $phone = sanitizeInput($_POST['phone'] ?? '');
    $service = sanitizeInput($_POST['service'] ?? '');
    $message = sanitizeInput($_POST['message'] ?? '');
    $newsletter = isset($_POST['newsletter']) ? 1 : 0;
    
    // Validation
    $errors = [];
    
    if (empty($name) || strlen($name) < 2) {
        $errors[] = 'Nome é obrigatório e deve ter pelo menos 2 caracteres';
    }
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email válido é obrigatório';
    }
    
    if (empty($phone)) {
        $errors[] = 'Telefone é obrigatório';
    }
    
    if (empty($service)) {
        $errors[] = 'Tipo de serviço é obrigatório';
    }
    
    // Check for spam (basic honeypot and rate limiting)
    if (isset($_POST['website']) && !empty($_POST['website'])) {
        // Honeypot field filled - likely spam
        $errors[] = 'Spam detectado';
    }
    
    // Rate limiting (simple IP-based)
    $ip = $_SERVER['REMOTE_ADDR'];
    $rate_limit_file = sys_get_temp_dir() . '/labagua_rate_limit_' . md5($ip);
    
    if (file_exists($rate_limit_file)) {
        $last_submission = file_get_contents($rate_limit_file);
        if (time() - $last_submission < 60) { // 1 minute between submissions
            $errors[] = 'Muitas tentativas. Aguarde 1 minuto antes de enviar novamente.';
        }
    }
    
    if (!empty($errors)) {
        echo json_encode([
            'success' => false,
            'message' => implode('; ', $errors)
        ]);
        exit;
    }
    
    // Save rate limit timestamp
    file_put_contents($rate_limit_file, time());
    
    // Prepare email content
    $subject = 'Nova Solicitação de Contato - LabÁgua';
    
    $html_body = generateEmailTemplate([
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'service' => getServiceName($service),
        'message' => $message,
        'newsletter' => $newsletter ? 'Sim' : 'Não',
        'ip' => $ip,
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
        'timestamp' => date('d/m/Y H:i:s')
    ]);
    
    $text_body = generateTextEmail([
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'service' => getServiceName($service),
        'message' => $message,
        'newsletter' => $newsletter ? 'Sim' : 'Não'
    ]);
    
    // Send email using PHP mail() function (compatible with most hosting providers)
    $headers = [
        'MIME-Version: 1.0',
        'Content-Type: text/html; charset=UTF-8',
        'From: ' . $config['from_name'] . ' <' . $config['from_email'] . '>',
        'Reply-To: ' . $name . ' <' . $email . '>',
        'X-Mailer: PHP/' . phpversion(),
        'X-Priority: 3',
        'Return-Path: ' . $config['from_email']
    ];
    
    $mail_sent = mail(
        $config['to_email'],
        $subject,
        $html_body,
        implode("\r\n", $headers)
    );
    
    if ($mail_sent) {
        // Send confirmation email to customer
        sendConfirmationEmail($email, $name, $config);
        
        // Save to database if available
        saveToDatabase([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'service' => $service,
            'message' => $message,
            'newsletter' => $newsletter,
            'ip' => $ip,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        
        // Log successful submission
        logSubmission('contact', $email, 'success');
        
        echo json_encode([
            'success' => true,
            'message' => 'Mensagem enviada com sucesso! Entraremos em contato em breve.'
        ]);
    } else {
        throw new Exception('Falha ao enviar email');
    }
    
} catch (Exception $e) {
    // Log error
    error_log('Contact form error: ' . $e->getMessage());
    logSubmission('contact', $email ?? 'unknown', 'error', $e->getMessage());
    
    echo json_encode([
        'success' => false,
        'message' => 'Erro interno. Tente novamente ou entre em contato por telefone.'
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
 * Get service name from code
 */
function getServiceName($service) {
    $services = [
        'residencial' => 'Análise Residencial',
        'comercial' => 'Análise Comercial',
        'industrial' => 'Análise Industrial',
        'curso' => 'Curso de Certificação',
        'emergencia' => 'Teste de Emergência'
    ];
    
    return $services[$service] ?? 'Não especificado';
}

/**
 * Generate HTML email template
 */
function generateEmailTemplate($data) {
    $template = '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Nova Solicitação - LabÁgua</title>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background: linear-gradient(135deg, #1e40af, #3b82f6); color: white; padding: 20px; text-align: center; }
            .content { background: #f8fafc; padding: 30px; }
            .field { margin-bottom: 15px; }
            .label { font-weight: bold; color: #1e40af; }
            .value { margin-left: 10px; }
            .footer { background: #1e293b; color: white; padding: 20px; text-align: center; font-size: 12px; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>LabÁgua</h1>
                <p>Nova Solicitação de Contato</p>
            </div>
            <div class="content">
                <div class="field">
                    <span class="label">Nome:</span>
                    <span class="value">' . htmlspecialchars($data['name']) . '</span>
                </div>
                <div class="field">
                    <span class="label">Email:</span>
                    <span class="value">' . htmlspecialchars($data['email']) . '</span>
                </div>
                <div class="field">
                    <span class="label">Telefone:</span>
                    <span class="value">' . htmlspecialchars($data['phone']) . '</span>
                </div>
                <div class="field">
                    <span class="label">Serviço:</span>
                    <span class="value">' . htmlspecialchars($data['service']) . '</span>
                </div>
                <div class="field">
                    <span class="label">Newsletter:</span>
                    <span class="value">' . htmlspecialchars($data['newsletter']) . '</span>
                </div>
                <div class="field">
                    <span class="label">Mensagem:</span>
                    <div class="value" style="margin-top: 10px; padding: 15px; background: white; border-left: 4px solid #1e40af;">
                        ' . nl2br(htmlspecialchars($data['message'])) . '
                    </div>
                </div>
                <div class="field" style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #e2e8f0; font-size: 12px; color: #64748b;">
                    <div>IP: ' . htmlspecialchars($data['ip']) . '</div>
                    <div>Data/Hora: ' . htmlspecialchars($data['timestamp']) . '</div>
                </div>
            </div>
            <div class="footer">
                <p>&copy; 2024 LabÁgua. Todos os direitos reservados.</p>
            </div>
        </div>
    </body>
    </html>';
    
    return $template;
}

/**
 * Generate plain text email
 */
function generateTextEmail($data) {
    return "
NOVA SOLICITAÇÃO DE CONTATO - LABÁGUA

Nome: {$data['name']}
Email: {$data['email']}
Telefone: {$data['phone']}
Serviço: {$data['service']}
Newsletter: {$data['newsletter']}

Mensagem:
{$data['message']}

---
Este email foi enviado automaticamente pelo sistema de contato do site LabÁgua.
";
}

/**
 * Send confirmation email to customer
 */
function sendConfirmationEmail($email, $name, $config) {
    $subject = 'Confirmação de Contato - LabÁgua';
    
    $html_body = '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Confirmação de Contato - LabÁgua</title>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; }
            .header { background: linear-gradient(135deg, #1e40af, #3b82f6); color: white; padding: 20px; text-align: center; }
            .content { background: #f8fafc; padding: 30px; }
            .footer { background: #1e293b; color: white; padding: 20px; text-align: center; font-size: 12px; }
            .btn { display: inline-block; background: #1e40af; color: white; padding: 12px 24px; text-decoration: none; border-radius: 6px; margin: 10px 0; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>LabÁgua</h1>
                <p>Análise Precisa de Água. Resultados Confiáveis.</p>
            </div>
            <div class="content">
                <h2>Olá, ' . htmlspecialchars($name) . '!</h2>
                <p>Recebemos sua solicitação de contato e agradecemos pelo interesse em nossos serviços.</p>
                <p>Nossa equipe analisará sua mensagem e entrará em contato em breve, normalmente dentro de 24 horas em dias úteis.</p>
                
                <h3>Próximos Passos:</h3>
                <ul>
                    <li>Análise da sua solicitação por nossa equipe técnica</li>
                    <li>Contato telefônico ou por email para esclarecimentos</li>
                    <li>Agendamento de coleta ou visita técnica (se necessário)</li>
                    <li>Envio de proposta personalizada</li>
                </ul>
                
                <p><strong>Precisa de atendimento urgente?</strong></p>
                <p>Para emergências, ligue: <strong>(11) 99999-9999</strong> (24h)</p>
                
                <p>Atenciosamente,<br><strong>Equipe LabÁgua</strong></p>
            </div>
            <div class="footer">
                <p>LabÁgua - Laboratório de Análise de Água</p>
                <p>Rua das Análises, 123 - Centro, São Paulo - SP</p>
                <p>Telefone: (11) 3456-7890 | Email: contato@labagua.com.br</p>
            </div>
        </div>
    </body>
    </html>';
    
    $headers = [
        'MIME-Version: 1.0',
        'Content-Type: text/html; charset=UTF-8',
        'From: ' . $config['from_name'] . ' <' . $config['from_email'] . '>',
        'X-Mailer: PHP/' . phpversion()
    ];
    
    mail($email, $subject, $html_body, implode("\r\n", $headers));
}

/**
 * Save to database (if available)
 */
function saveToDatabase($data) {
    try {
        // Include database configuration
        require_once __DIR__ . '/../config/database.php';
        
        // Use the configured database connection
        $connection = getMysqliConnection();
        
        // Prepare data for the new contacts table structure
        $subject = 'Solicitação de ' . getServiceName($data['service']);
        
        // Insert into contacts table with new structure
        $sql = "INSERT INTO contacts (name, email, phone, service, subject, message, status, priority, created_at) 
                VALUES (?, ?, ?, ?, ?, ?, 'new', 'normal', NOW())";
        
        $stmt = $connection->prepare($sql);
        $stmt->bind_param(
            'ssssss',
            $data['name'],
            $data['email'],
            $data['phone'],
            $data['service'],
            $subject,
            $data['message']
        );
        
        if ($stmt->execute()) {
            $contact_id = $connection->insert_id;
            
            // If user wants newsletter, add to subscribers table
            if (isset($data['newsletter']) && $data['newsletter']) {
                saveToNewsletter($data['email'], $data['name'], $connection);
            }
            
            // Log successful database save
            logSubmission('contact_db', $data['email'], 'saved', null, $contact_id);
            
            return $contact_id;
        }
        
        $stmt->close();
        $connection->close();
        
    } catch (Exception $e) {
        // Database not available or error - continue without saving
        error_log('Database save error: ' . $e->getMessage());
        logSubmission('contact_db', $data['email'] ?? 'unknown', 'error', $e->getMessage());
        return false;
    }
}

/**
 * Save to newsletter subscribers
 */
function saveToNewsletter($email, $name, $connection) {
    try {
        // Check if email already exists
        $check_sql = "SELECT id FROM subscribers WHERE email = ? AND status = 'active'";
        $check_stmt = $connection->prepare($check_sql);
        $check_stmt->bind_param('s', $email);
        $check_stmt->execute();
        $result = $check_stmt->get_result();
        
        if ($result->num_rows === 0) {
            // Email doesn't exist, add new subscriber
            $insert_sql = "INSERT INTO subscribers (email, name, status, subscribed_at, source) 
                          VALUES (?, ?, 'active', NOW(), 'contact_form')";
            $insert_stmt = $connection->prepare($insert_sql);
            $insert_stmt->bind_param('ss', $email, $name);
            $insert_stmt->execute();
            $insert_stmt->close();
        }
        
        $check_stmt->close();
        
    } catch (Exception $e) {
        error_log('Newsletter subscription error: ' . $e->getMessage());
    }
}

/**
 * Log submission for monitoring
 */
function logSubmission($type, $email, $status, $error = null, $contact_id = null) {
    $log_entry = [
        'timestamp' => date('Y-m-d H:i:s'),
        'type' => $type,
        'email' => $email,
        'status' => $status,
        'contact_id' => $contact_id,
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
    
    // Also try to save to system_logs table if database is available
    try {
        require_once __DIR__ . '/../config/database.php';
        $connection = getMysqliConnection();
        
        $details = json_encode([
            'type' => $type,
            'email' => $email,
            'contact_id' => $contact_id,
            'error' => $error,
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? ''
        ]);
        
        $sql = "INSERT INTO system_logs (action, table_name, record_id, ip_address, user_agent, details, created_at) 
                VALUES (?, 'contacts', ?, ?, ?, ?, NOW())";
        
        $stmt = $connection->prepare($sql);
        $stmt->bind_param('sisss', $status, $contact_id, $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT'], $details);
        $stmt->execute();
        $stmt->close();
        $connection->close();
        
    } catch (Exception $e) {
        // Continue if database logging fails
        error_log('System log error: ' . $e->getMessage());
    }
}
?>