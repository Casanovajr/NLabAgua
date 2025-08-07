<?php
ob_start();
require_once "functions/db.php";

// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    header("location: login.php");
    exit;
}

$email = $_SESSION['email'];

// Handle status updates
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'update_status') {
        $contact_id = (int)$_POST['contact_id'];
        $status = $_POST['status'];
        $notes = $_POST['notes'] ?? '';
        
        $sql = "UPDATE contacts SET status = ?, notes = ?, replied_at = NOW(), replied_by = (SELECT id FROM admin WHERE email = ?) WHERE id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("sssi", $status, $notes, $email, $contact_id);
        
        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Status atualizado com sucesso!";
        } else {
            $_SESSION['error_message'] = "Erro ao atualizar status.";
        }
        $stmt->close();
    }
    
    header("Location: contacts.php");
    exit;
}

// Get filter parameters
$status_filter = $_GET['status'] ?? '';
$service_filter = $_GET['service'] ?? '';
$search = $_GET['search'] ?? '';

// Build query with filters
$where_conditions = [];
$params = [];
$types = '';

if (!empty($status_filter)) {
    $where_conditions[] = "status = ?";
    $params[] = $status_filter;
    $types .= 's';
}

if (!empty($service_filter)) {
    $where_conditions[] = "service = ?";
    $params[] = $service_filter;
    $types .= 's';
}

if (!empty($search)) {
    $where_conditions[] = "(name LIKE ? OR email LIKE ? OR message LIKE ?)";
    $search_param = "%{$search}%";
    $params[] = $search_param;
    $params[] = $search_param;
    $params[] = $search_param;
    $types .= 'sss';
}

$where_clause = '';
if (!empty($where_conditions)) {
    $where_clause = 'WHERE ' . implode(' AND ', $where_conditions);
}

// Get contacts with pagination
$page = (int)($_GET['page'] ?? 1);
$per_page = 20;
$offset = ($page - 1) * $per_page;

$count_sql = "SELECT COUNT(*) as total FROM contacts " . $where_clause;
$contacts_sql = "SELECT c.*, a.name as replied_by_name 
                FROM contacts c 
                LEFT JOIN admin a ON c.replied_by = a.id 
                " . $where_clause . " 
                ORDER BY c.created_at DESC 
                LIMIT ? OFFSET ?";

// Count total records
if (!empty($params)) {
    $count_stmt = $connection->prepare($count_sql);
    $count_stmt->bind_param($types, ...$params);
    $count_stmt->execute();
    $count_result = $count_stmt->get_result();
    $total_records = $count_result->fetch_assoc()['total'];
    $count_stmt->close();
} else {
    $count_result = $connection->query($count_sql);
    $total_records = $count_result->fetch_assoc()['total'];
}

// Get contacts
$contacts_params = $params;
$contacts_params[] = $per_page;
$contacts_params[] = $offset;
$contacts_types = $types . 'ii';

$contacts_stmt = $connection->prepare($contacts_sql);
if (!empty($contacts_params)) {
    $contacts_stmt->bind_param($contacts_types, ...$contacts_params);
}
$contacts_stmt->execute();
$contacts_result = $contacts_stmt->get_result();

$total_pages = ceil($total_records / $per_page);

// Get statistics
$stats_sql = "SELECT 
    COUNT(*) as total,
    COUNT(CASE WHEN status = 'new' THEN 1 END) as new_count,
    COUNT(CASE WHEN status = 'read' THEN 1 END) as read_count,
    COUNT(CASE WHEN status = 'replied' THEN 1 END) as replied_count,
    COUNT(CASE WHEN status = 'archived' THEN 1 END) as archived_count,
    COUNT(CASE WHEN created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY) THEN 1 END) as week_count
FROM contacts";
$stats_result = $connection->query($stats_sql);
$stats = $stats_result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contatos - LabÁgua Admin</title>
    <link rel="icon" type="image/png" sizes="16x16" href="../images/agua.png">
    
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
    <link href="../plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    
    <!-- Menu CSS -->
    <link href="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- Animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- Color CSS -->
    <link href="css/colors/blue.css" id="theme" rel="stylesheet">
    
    <style>
        .contact-card {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }
        .contact-card:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .contact-header {
            background: #f8f9fa;
            padding: 15px;
            border-bottom: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .contact-body {
            padding: 20px;
        }
        .contact-actions {
            padding: 15px;
            background: #f8f9fa;
            border-top: 1px solid #e9ecef;
        }
        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }
        .status-new { background: #fff3cd; color: #856404; }
        .status-read { background: #d4edda; color: #155724; }
        .status-replied { background: #cce7ff; color: #004085; }
        .status-archived { background: #f8d7da; color: #721c24; }
        .priority-high { border-left: 4px solid #dc3545; }
        .priority-urgent { border-left: 4px solid #fd7e14; }
        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .filter-form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
    </style>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <a class="navbar-toggle hidden-sm hidden-md hidden-lg" href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse">
                    <i class="ti-menu"></i>
                </a>
                <div class="top-left-part">
                    <a class="logo" href="index.php">
                        <b><img src="../images/agua.png" style="width: 30px; height: 30px;" alt="home" /></b>
                        <span class="hidden-xs"><b>LabÁgua</b></span>
                    </a>
                </div>
                <ul class="nav navbar-top-links navbar-left hidden-xs">
                    <li><a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light"><i class="icon-arrow-left-circle ti-menu"></i></a></li>
                </ul>
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li class="right-side-toggle"><a class="waves-effect waves-light" href="javascript:void(0)"><i class="ti-settings"></i></a></li>
                </ul>
            </div>
        </nav>
        
        <!-- Left navbar-header -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse slimscrollsidebar">
                <ul class="nav" id="side-menu">
                    <li class="user-pro">
                        <a href="#" class="waves-effect"><img src="../plugins/images/user.jpg" alt="user-img" class="img-circle"> <span class="hide-menu"> Conta<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="settings.php"><i class="ti-settings"></i> Configuração de Conta</a></li>
                            <li><a href="login.php"><i class="fa fa-power-off"></i> Sair</a></li>
                        </ul>
                    </li>
                    <li class="nav-small-cap m-t-10">--- Menu Principal</li>
                    <li><a href="index.php" class="waves-effect"><i class="linea-icon linea-basic fa-fw" data-icon="v"></i> <span class="hide-menu">Dashboard</span></a></li>
                    <li><a href="#" class="waves-effect"><i data-icon="&#xe00b;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Artigos<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="posts.php">Todos as Postagens</a></li>
                            <li><a href="new-post.php">Criar Postagem</a></li>
                            <li><a href="comments.php">Comentários</a></li>
                        </ul>
                    </li>
                    <li><a href="contacts.php" class="waves-effect active"><i data-icon=")" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Contatos</span></a></li>
                    <li><a href="subscribers.php" class="waves-effect"><i data-icon="n" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Inscritos</span></a></li>
                    <li class="nav-small-cap">--- Outros</li>
                    <li><a href="#" class="waves-effect"><i data-icon="H" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Acesso<span class="fa arrow"></span></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="users.php">Administradores</a></li>
                            <li><a href="new-user.php">Criar Administrador</a></li>
                            <li><a href="member.php">Aceitar Membro</a></li>
                            <li><a href="del-member.php">Apagar Membro</a></li>
                        </ul>
                    </li>
                    <li><a href="login.php" class="waves-effect"><i class="icon-logout fa-fw"></i> <span class="hide-menu">Sair</span></a></li>
                </ul>
            </div>
        </div>
        
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Contatos</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="index.php">Dashboard</a></li>
                            <li class="active">Contatos</li>
                        </ol>
                    </div>
                </div>
                
                <!-- Success/Error Messages -->
                <?php if (isset($_SESSION['success_message'])): ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?php echo $_SESSION['success_message']; unset($_SESSION['success_message']); ?>
                    </div>
                <?php endif; ?>
                
                <?php if (isset($_SESSION['error_message'])): ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?>
                    </div>
                <?php endif; ?>
                
                <!-- Statistics -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="stats-card">
                            <div class="row">
                                <div class="col-md-2 text-center">
                                    <h3 class="m-b-0"><?php echo $stats['total']; ?></h3>
                                    <small>Total de Contatos</small>
                                </div>
                                <div class="col-md-2 text-center">
                                    <h3 class="m-b-0"><?php echo $stats['new_count']; ?></h3>
                                    <small>Novos</small>
                                </div>
                                <div class="col-md-2 text-center">
                                    <h3 class="m-b-0"><?php echo $stats['read_count']; ?></h3>
                                    <small>Lidos</small>
                                </div>
                                <div class="col-md-2 text-center">
                                    <h3 class="m-b-0"><?php echo $stats['replied_count']; ?></h3>
                                    <small>Respondidos</small>
                                </div>
                                <div class="col-md-2 text-center">
                                    <h3 class="m-b-0"><?php echo $stats['archived_count']; ?></h3>
                                    <small>Arquivados</small>
                                </div>
                                <div class="col-md-2 text-center">
                                    <h3 class="m-b-0"><?php echo $stats['week_count']; ?></h3>
                                    <small>Esta Semana</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Filters -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="filter-form">
                            <form method="GET" class="form-inline">
                                <div class="form-group">
                                    <label>Status:</label>
                                    <select name="status" class="form-control">
                                        <option value="">Todos</option>
                                        <option value="new" <?php echo $status_filter === 'new' ? 'selected' : ''; ?>>Novos</option>
                                        <option value="read" <?php echo $status_filter === 'read' ? 'selected' : ''; ?>>Lidos</option>
                                        <option value="replied" <?php echo $status_filter === 'replied' ? 'selected' : ''; ?>>Respondidos</option>
                                        <option value="archived" <?php echo $status_filter === 'archived' ? 'selected' : ''; ?>>Arquivados</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Serviço:</label>
                                    <select name="service" class="form-control">
                                        <option value="">Todos</option>
                                        <option value="residencial" <?php echo $service_filter === 'residencial' ? 'selected' : ''; ?>>Residencial</option>
                                        <option value="comercial" <?php echo $service_filter === 'comercial' ? 'selected' : ''; ?>>Comercial</option>
                                        <option value="industrial" <?php echo $service_filter === 'industrial' ? 'selected' : ''; ?>>Industrial</option>
                                        <option value="curso" <?php echo $service_filter === 'curso' ? 'selected' : ''; ?>>Curso</option>
                                        <option value="emergencia" <?php echo $service_filter === 'emergencia' ? 'selected' : ''; ?>>Emergência</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Buscar:</label>
                                    <input type="text" name="search" class="form-control" placeholder="Nome, email ou mensagem..." value="<?php echo htmlspecialchars($search); ?>">
                                </div>
                                <button type="submit" class="btn btn-info">Filtrar</button>
                                <a href="contacts.php" class="btn btn-default">Limpar</a>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Contacts List -->
                <div class="row">
                    <div class="col-md-12">
                        <?php if ($contacts_result->num_rows > 0): ?>
                            <?php while ($contact = $contacts_result->fetch_assoc()): ?>
                                <div class="contact-card <?php echo $contact['priority'] === 'high' ? 'priority-high' : ($contact['priority'] === 'urgent' ? 'priority-urgent' : ''); ?>">
                                    <div class="contact-header">
                                        <div>
                                            <h5 class="m-b-0"><?php echo htmlspecialchars($contact['name']); ?></h5>
                                            <small class="text-muted"><?php echo htmlspecialchars($contact['email']); ?> | <?php echo htmlspecialchars($contact['phone'] ?? 'N/A'); ?></small>
                                        </div>
                                        <div>
                                            <span class="status-badge status-<?php echo $contact['status']; ?>"><?php echo ucfirst($contact['status']); ?></span>
                                        </div>
                                    </div>
                                    <div class="contact-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <p><strong>Serviço:</strong> <?php echo htmlspecialchars($contact['service']); ?></p>
                                                <?php if ($contact['subject']): ?>
                                                    <p><strong>Assunto:</strong> <?php echo htmlspecialchars($contact['subject']); ?></p>
                                                <?php endif; ?>
                                                <p><strong>Mensagem:</strong></p>
                                                <div style="background: #f8f9fa; padding: 15px; border-radius: 5px; max-height: 200px; overflow-y: auto;">
                                                    <?php echo nl2br(htmlspecialchars($contact['message'])); ?>
                                                </div>
                                                <?php if ($contact['notes']): ?>
                                                    <p class="m-t-15"><strong>Observações:</strong></p>
                                                    <div style="background: #fff3cd; padding: 10px; border-radius: 5px;">
                                                        <?php echo nl2br(htmlspecialchars($contact['notes'])); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-md-4">
                                                <p><strong>Data:</strong> <?php echo date('d/m/Y H:i', strtotime($contact['created_at'])); ?></p>
                                                <p><strong>Prioridade:</strong> <?php echo ucfirst($contact['priority']); ?></p>
                                                <?php if ($contact['replied_at']): ?>
                                                    <p><strong>Respondido em:</strong> <?php echo date('d/m/Y H:i', strtotime($contact['replied_at'])); ?></p>
                                                    <?php if ($contact['replied_by_name']): ?>
                                                        <p><strong>Por:</strong> <?php echo htmlspecialchars($contact['replied_by_name']); ?></p>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="contact-actions">
                                        <form method="POST" class="form-inline">
                                            <input type="hidden" name="action" value="update_status">
                                            <input type="hidden" name="contact_id" value="<?php echo $contact['id']; ?>">
                                            <div class="form-group">
                                                <select name="status" class="form-control">
                                                    <option value="new" <?php echo $contact['status'] === 'new' ? 'selected' : ''; ?>>Novo</option>
                                                    <option value="read" <?php echo $contact['status'] === 'read' ? 'selected' : ''; ?>>Lido</option>
                                                    <option value="replied" <?php echo $contact['status'] === 'replied' ? 'selected' : ''; ?>>Respondido</option>
                                                    <option value="archived" <?php echo $contact['status'] === 'archived' ? 'selected' : ''; ?>>Arquivado</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="notes" class="form-control" placeholder="Observações..." value="<?php echo htmlspecialchars($contact['notes'] ?? ''); ?>">
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-sm">Atualizar</button>
                                            <a href="mailto:<?php echo htmlspecialchars($contact['email']); ?>?subject=Re: <?php echo urlencode($contact['subject'] ?? 'Sua solicitação'); ?>" class="btn btn-success btn-sm">Responder</a>
                                        </form>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                            
                            <!-- Pagination -->
                            <?php if ($total_pages > 1): ?>
                                <div class="text-center">
                                    <nav>
                                        <ul class="pagination">
                                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                                <li class="<?php echo $i === $page ? 'active' : ''; ?>">
                                                    <a href="?page=<?php echo $i; ?>&status=<?php echo urlencode($status_filter); ?>&service=<?php echo urlencode($service_filter); ?>&search=<?php echo urlencode($search); ?>"><?php echo $i; ?></a>
                                                </li>
                                            <?php endfor; ?>
                                        </ul>
                                    </nav>
                                </div>
                            <?php endif; ?>
                            
                        <?php else: ?>
                            <div class="text-center">
                                <h4>Nenhum contato encontrado</h4>
                                <p>Não há contatos com os filtros selecionados.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <footer class="footer text-center">2024 &copy; LabÁgua</footer>
        </div>
    </div>
    
    <!-- jQuery -->
    <script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!-- Slimscroll JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!-- Wave Effects -->
    <script src="js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.min.js"></script>
</body>
</html>

<?php
$contacts_stmt->close();
$connection->close();
?>
