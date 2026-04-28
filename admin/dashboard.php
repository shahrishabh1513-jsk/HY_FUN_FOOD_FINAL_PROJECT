<?php
session_start();

// Simple admin login (you can change password)
$admin_username = 'admin';
$admin_password = 'admin123';

// Check if logged in
if (!isset($_SESSION['admin_logged_in'])) {
    // Handle login
    if (isset($_POST['login'])) {
        if ($_POST['username'] === $admin_username && $_POST['password'] === $admin_password) {
            $_SESSION['admin_logged_in'] = true;
            header('Location: dashboard.php');
            exit;
        } else {
            $error = "Invalid username or password!";
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Login - HyFun Foods</title>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            
            body {
                font-family: 'Poppins', sans-serif;
                background: linear-gradient(135deg, #6EC1E4 0%, #78B04B 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                position: relative;
                overflow: hidden;
            }
            
            body::before {
                content: '';
                position: absolute;
                width: 200%;
                height: 200%;
                background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
                background-size: 50px 50px;
                animation: moveBg 20s linear infinite;
                opacity: 0.3;
            }
            
            @keyframes moveBg {
                0% { transform: translate(0, 0); }
                100% { transform: translate(50px, 50px); }
            }
            
            .floating-shapes {
                position: absolute;
                width: 100%;
                height: 100%;
                overflow: hidden;
                z-index: 0;
            }
            
            .shape {
                position: absolute;
                background: rgba(255,255,255,0.1);
                border-radius: 50%;
                animation: float 15s infinite;
            }
            
            .shape-1 { width: 300px; height: 300px; top: -100px; right: -100px; animation-delay: 0s; }
            .shape-2 { width: 200px; height: 200px; bottom: -50px; left: -50px; animation-delay: 2s; }
            .shape-3 { width: 150px; height: 150px; top: 50%; left: 20%; animation-delay: 4s; }
            .shape-4 { width: 100px; height: 100px; bottom: 20%; right: 15%; animation-delay: 6s; }
            
            @keyframes float {
                0%, 100% { transform: translateY(0) rotate(0deg); }
                50% { transform: translateY(-30px) rotate(10deg); }
            }
            
            .login-container {
                background: rgba(255, 255, 255, 0.98);
                padding: 50px 40px;
                border-radius: 30px;
                box-shadow: 0 30px 60px rgba(0,0,0,0.3);
                width: 450px;
                position: relative;
                z-index: 1;
                animation: slideUp 0.6s ease;
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255,255,255,0.2);
            }
            
            @keyframes slideUp {
                from { opacity: 0; transform: translateY(50px); }
                to { opacity: 1; transform: translateY(0); }
            }
            
            .login-logo {
                text-align: center;
                margin-bottom: 30px;
            }
            
            .login-logo img {
                width: 100px;
                height: 100px;
                object-fit: contain;
                animation: pulse 2s infinite;
            }
            
            @keyframes pulse {
                0%, 100% { transform: scale(1); }
                50% { transform: scale(1.05); }
            }
            
            .login-logo h2 {
                font-size: 1.8rem;
                color: #2D3748;
                margin-top: 15px;
            }
            
            .login-logo h2 span {
                background: linear-gradient(135deg, #78B04B, #6EC1E4);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            
            .input-group {
                position: relative;
                margin-bottom: 25px;
            }
            
            .input-group i {
                position: absolute;
                left: 15px;
                top: 50%;
                transform: translateY(-50%);
                color: #78B04B;
                font-size: 1.2rem;
            }
            
            .login-container input {
                width: 100%;
                padding: 16px 16px 16px 50px;
                border: 2px solid #e0e0e0;
                border-radius: 15px;
                font-size: 1rem;
                transition: all 0.3s ease;
                font-family: 'Poppins', sans-serif;
            }
            
            .login-container input:focus {
                outline: none;
                border-color: #78B04B;
                box-shadow: 0 0 0 4px rgba(120, 176, 75, 0.1);
            }
            
            .login-container button {
                width: 100%;
                padding: 16px;
                background: linear-gradient(135deg, #78B04B, #6EC1E4);
                color: white;
                border: none;
                border-radius: 15px;
                font-size: 1.1rem;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
            }
            
            .login-container button::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
                transition: left 0.5s;
            }
            
            .login-container button:hover {
                transform: translateY(-3px);
                box-shadow: 0 10px 25px rgba(120, 176, 75, 0.4);
            }
            
            .login-container button:hover::before {
                left: 100%;
            }
            
            .error {
                background: linear-gradient(135deg, #ff4757, #ff6b81);
                color: white;
                padding: 12px;
                border-radius: 12px;
                margin-bottom: 20px;
                text-align: center;
                animation: shake 0.5s ease;
            }
            
            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                25% { transform: translateX(-10px); }
                75% { transform: translateX(10px); }
            }
            
            .login-footer {
                text-align: center;
                margin-top: 25px;
                color: #999;
                font-size: 0.8rem;
            }
            
            @media (max-width: 576px) {
                .login-container {
                    width: 90%;
                    padding: 35px 25px;
                }
            }
        </style>
    </head>
    <body>
        <div class="floating-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
            <div class="shape shape-4"></div>
        </div>
        <div class="login-container">
            <div class="login-logo">
                <img src="../assets/image/hyfun_logo.png" alt="HyFun Foods Logo">
            </div>
            <h2 style="text-align: center; margin-bottom: 25px; font-size: 1.5rem;"><i class="fas fa-lock"></i> Admin Login</h2>
            <?php if(isset($error)) echo '<div class="error"><i class="fas fa-exclamation-triangle"></i> ' . $error . '</div>'; ?>
            <form method="POST">
                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" name="login">
                    <i class="fas fa-arrow-right-to-bracket"></i> Login to Dashboard
                </button>
            </form>
            <div class="login-footer">
                <p><i class="fas fa-shield-alt"></i> Secure Admin Access</p>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit;
}

require_once '../includes/functions.php';
$conn = getConnection();

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: dashboard.php');
    exit;
}

// Handle order status update
if (isset($_POST['update_order'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];
    $stmt = $conn->prepare("UPDATE orders SET order_status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $order_id);
    $stmt->execute();
    header('Location: dashboard.php?tab=orders');
    exit;
}

// Handle enquiry status update
if (isset($_POST['update_enquiry'])) {
    $enquiry_id = $_POST['enquiry_id'];
    $status = $_POST['status'];
    $stmt = $conn->prepare("UPDATE enquiries SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $enquiry_id);
    $stmt->execute();
    header('Location: dashboard.php?tab=enquiries');
    exit;
}

// Handle review approval
if (isset($_POST['approve_review'])) {
    $review_id = $_POST['review_id'];
    $stmt = $conn->prepare("UPDATE reviews SET is_approved = 1 WHERE id = ?");
    $stmt->bind_param("i", $review_id);
    $stmt->execute();
    header('Location: dashboard.php?tab=reviews');
    exit;
}

// Get statistics
$stats = [];
$result = $conn->query("SELECT COUNT(*) as total FROM orders");
$stats['total_orders'] = $result->fetch_assoc()['total'] ?? 0;

$result = $conn->query("SELECT SUM(total_amount) as total FROM orders WHERE order_status = 'delivered'");
$stats['total_revenue'] = $result->fetch_assoc()['total'] ?? 0;

$result = $conn->query("SELECT COUNT(*) as total FROM enquiries WHERE status = 'new'");
$stats['new_enquiries'] = $result->fetch_assoc()['total'] ?? 0;

$result = $conn->query("SELECT COUNT(*) as total FROM export_enquiries WHERE status = 'new'");
$stats['new_export_enquiries'] = $result->fetch_assoc()['total'] ?? 0;

$result = $conn->query("SELECT COUNT(*) as total FROM newsletter_subscribers");
$stats['subscribers'] = $result->fetch_assoc()['total'] ?? 0;

$result = $conn->query("SELECT AVG(rating) as avg FROM reviews WHERE is_approved = 1");
$stats['avg_rating'] = round($result->fetch_assoc()['avg'] ?? 0, 1);

// Get recent orders
$recentOrders = $conn->query("SELECT * FROM orders ORDER BY created_at DESC LIMIT 20");

// Get recent enquiries
$recentEnquiries = $conn->query("SELECT * FROM enquiries ORDER BY created_at DESC LIMIT 20");

// Get export enquiries
$exportEnquiries = $conn->query("SELECT * FROM export_enquiries ORDER BY created_at DESC LIMIT 20");

// Get reviews
$reviews = $conn->query("SELECT * FROM reviews ORDER BY created_at DESC LIMIT 20");

// Get subscribers
$subscribers = $conn->query("SELECT * FROM newsletter_subscribers ORDER BY subscribed_at DESC LIMIT 20");

$active_tab = $_GET['tab'] ?? 'dashboard';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - HyFun Foods</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #6EC1E4 0%, #78B04B 100%);
            min-height: 100vh;
        }
        
        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 280px;
            height: 100%;
            background: linear-gradient(180deg, #1a1a2e 0%, #16213e 100%);
            color: white;
            padding: 25px 0;
            z-index: 100;
            transition: all 0.3s ease;
            box-shadow: 5px 0 30px rgba(0,0,0,0.2);
        }
        
        .sidebar h2 {
            text-align: center;
            padding: 20px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }
        
        .sidebar h2 img {
            width: 70px;
            height: 70px;
            object-fit: cover;
        }
        
        .sidebar h2 i {
            color: #78B04B;
            font-size: 1.8rem;
        }
        
        .sidebar h2 span {
            font-size: 1.3rem;
            font-weight: 600;
        }
        
        .sidebar a {
            display: flex;
            align-items: center;
            padding: 14px 25px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            transition: all 0.3s ease;
            gap: 15px;
            margin: 5px 15px;
            border-radius: 12px;
            position: relative;
            overflow: hidden;
        }
        
        .sidebar a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 0;
            height: 100%;
            background: linear-gradient(90deg, #78B04B, #bed8e3);
            transition: width 0.3s ease;
            z-index: -1;
            opacity: 0.2;
        }
        
        .sidebar a:hover::before,
        .sidebar a.active::before {
            width: 100%;
        }
        
        .sidebar a:hover,
        .sidebar a.active {
            color: white;
            transform: translateX(5px);
        }
        
        .sidebar a i {
            width: 24px;
            font-size: 1.2rem;
        }
        
        .logout-sidebar {
            margin-top: 50px;
            background: rgba(255,71,87,0.2);
            border: 1px solid rgba(255,71,87,0.3);
        }
        
        .logout-sidebar:hover {
            background: rgba(255,71,87,0.4);
            color: #ff4757;
        }
        
        /* Main Content */
        .main-content {
            margin-left: 280px;
            padding: 25px 30px;
            min-height: 100vh;
        }
        
        /* Header */
        .header {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            padding: 20px 30px;
            border-radius: 20px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            animation: slideDown 0.5s ease;
            border: 1px solid rgba(255,255,255,0.2);
        }
        
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .header h1 {
            font-size: 1.8rem;
            background: linear-gradient(135deg, #78B04B, #6EC1E4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .header h1 i {
            background: none;
            -webkit-text-fill-color: #78B04B;
        }
        
        .admin-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .admin-avatar {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #78B04B, #6EC1E4);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }
        
        .admin-name {
            font-weight: 600;
            color: #2D3748;
        }
        
        .logout-btn-header {
            background: linear-gradient(135deg, #ff4757, #ff6b81);
            color: white;
            padding: 10px 20px;
            border-radius: 30px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
        }
        
        .logout-btn-header:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(255,71,87,0.3);
        }
        
        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 25px;
            margin-bottom: 35px;
            animation: fadeInUp 0.6s ease;
        }
        
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .stat-card {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            padding: 25px;
            border-radius: 20px;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid rgba(255,255,255,0.2);
            position: relative;
            overflow: hidden;
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #78B04B, #6EC1E4);
        }
        
        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }
        
        .stat-card h3 {
            font-size: 2.5rem;
            background: linear-gradient(135deg, #78B04B, #6EC1E4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 10px;
        }
        
        .stat-card p {
            color: #666;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        .stat-card p i {
            color: #78B04B;
        }
        
        /* Section Styles */
        .section {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            animation: fadeInUp 0.6s ease;
            border: 1px solid rgba(255,255,255,0.2);
        }
        
        .section h2 {
            margin-bottom: 20px;
            color: #2D3748;
            border-left: 4px solid #78B04B;
            padding-left: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        /* Table Styles */
        .table-wrapper {
            overflow-x: auto;
            border-radius: 15px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th, td {
            padding: 14px 12px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        
        th {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            font-weight: 600;
            color: #2D3748;
        }
        
        tr {
            transition: all 0.3s ease;
        }
        
        tr:hover {
            background: rgba(120, 176, 75, 0.05);
        }
        
        /* Status Badges */
        .status {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-block;
            animation: fadeIn 0.3s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.8); }
            to { opacity: 1; transform: scale(1); }
        }
        
        .status-pending { background: #ffc107; color: #000; }
        .status-confirmed { background: #17a2b8; color: white; }
        .status-preparing { background: #6c757d; color: white; }
        .status-out_for_delivery { background: #fd7e14; color: white; }
        .status-delivered { background: #28a745; color: white; }
        .status-cancelled { background: #dc3545; color: white; }
        .status-new { background: #17a2b8; color: white; }
        .status-read { background: #6c757d; color: white; }
        .status-replied { background: #28a745; color: white; }
        
        /* Buttons */
        .btn-sm {
            padding: 6px 14px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 0.75rem;
            margin: 2px;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        
        .btn-sm:hover {
            transform: translateY(-2px);
        }
        
        .btn-primary { background: linear-gradient(135deg, #78B04B, #6EC1E4); color: white; }
        .btn-warning { background: #ffc107; color: #000; }
        .btn-danger { background: #dc3545; color: white; }
        .btn-info { background: #17a2b8; color: white; }
        
        select.status-select {
            padding: 6px 12px;
            border-radius: 10px;
            border: 1px solid #ddd;
            background: white;
            cursor: pointer;
            font-size: 0.8rem;
        }
        
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.7);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(5px);
        }
        
        .modal-content {
            background: white;
            padding: 30px;
            border-radius: 24px;
            max-width: 650px;
            width: 90%;
            max-height: 85vh;
            overflow-y: auto;
            animation: modalSlideIn 0.3s ease;
            box-shadow: 0 30px 60px rgba(0,0,0,0.3);
        }
        
        @keyframes modalSlideIn {
            from { opacity: 0; transform: scale(0.9) translateY(30px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }
        
        .modal-content h3 {
            margin-bottom: 20px;
            color: #2D3748;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .modal-content h3 i {
            color: #78B04B;
        }
        
        .close-modal {
            float: right;
            font-size: 28px;
            cursor: pointer;
            color: #999;
            transition: all 0.3s ease;
            line-height: 1;
        }
        
        .close-modal:hover {
            color: #ff4757;
            transform: rotate(90deg);
        }
        
        .order-detail-item {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
        }
        
        .order-detail-item:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            font-weight: 600;
            color: #2D3748;
        }
        
        .detail-value {
            color: #666;
        }
        
        /* Rating Stars */
        .rating-stars {
            color: #ffc107;
            letter-spacing: 2px;
        }
        
        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #78B04B, #6EC1E4);
            border-radius: 10px;
        }
        
        /* Loading Spinner */
        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 2px solid rgba(120,176,75,0.3);
            border-radius: 50%;
            border-top-color: #78B04B;
            animation: spin 0.8s linear infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                width: 80px;
            }
            .sidebar span {
                display: none;
            }
            .sidebar a {
                justify-content: center;
                padding: 14px;
            }
            .sidebar h2 span {
                display: none;
            }
            .main-content {
                margin-left: 80px;
            }
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 768px) {
            .main-content {
                padding: 15px;
            }
            .header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
            .stats-grid {
                grid-template-columns: 1fr;
            }
            .admin-info {
                flex-wrap: wrap;
                justify-content: center;
            }
        }
        
        @media (max-width: 576px) {
            .sidebar {
                width: 60px;
            }
            .main-content {
                margin-left: 60px;
            }
            th, td {
                padding: 10px 8px;
                font-size: 0.8rem;
            }
            .btn-sm {
                padding: 4px 10px;
                font-size: 0.7rem;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>
            
            <img src="../assets/image/hyfun_logo.png" alt="Logo">
        </h2>
        <a href="?tab=dashboard" class="<?php echo $active_tab == 'dashboard' ? 'active' : ''; ?>">
            <i class="fas fa-tachometer-alt"></i> <span>Dashboard</span>
        </a>
        <a href="?tab=orders" class="<?php echo $active_tab == 'orders' ? 'active' : ''; ?>">
            <i class="fas fa-shopping-cart"></i> <span>Orders</span>
        </a>
        <a href="?tab=enquiries" class="<?php echo $active_tab == 'enquiries' ? 'active' : ''; ?>">
            <i class="fas fa-envelope"></i> <span>Enquiries</span>
        </a>
        <a href="?tab=export" class="<?php echo $active_tab == 'export' ? 'active' : ''; ?>">
            <i class="fas fa-globe"></i> <span>Export Enquiries</span>
        </a>
        <a href="?tab=reviews" class="<?php echo $active_tab == 'reviews' ? 'active' : ''; ?>">
            <i class="fas fa-star"></i> <span>Reviews</span>
        </a>
        <a href="?tab=subscribers" class="<?php echo $active_tab == 'subscribers' ? 'active' : ''; ?>">
            <i class="fas fa-users"></i> <span>Subscribers</span>
        </a>
    </div>

    <div class="main-content">
        <div class="header">
            <h1>
                <i class="fas fa-store"></i>
                HyFun Foods Admin Panel
            </h1>
            <div class="admin-info">
                <div class="admin-avatar">
                    <i class="fas fa-user-shield"></i>
                </div>
                <div class="admin-name">
                    <strong>Welcome, Admin</strong>
                </div>
                <a href="?logout=1" class="logout-btn-header">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>

        <?php if($active_tab == 'dashboard'): ?>
        <div class="stats-grid">
            <div class="stat-card">
                <h3><?php echo $stats['total_orders']; ?></h3>
                <p><i class="fas fa-shopping-cart"></i> Total Orders</p>
            </div>
            <div class="stat-card">
                <h3>₹<?php echo number_format($stats['total_revenue']); ?></h3>
                <p><i class="fas fa-rupee-sign"></i> Total Revenue</p>
            </div>
            <div class="stat-card">
                <h3><?php echo $stats['new_enquiries'] + $stats['new_export_enquiries']; ?></h3>
                <p><i class="fas fa-envelope"></i> New Enquiries</p>
            </div>
            <div class="stat-card">
                <h3><?php echo $stats['subscribers']; ?></h3>
                <p><i class="fas fa-users"></i> Subscribers</p>
            </div>
            <div class="stat-card">
                <h3><?php echo $stats['avg_rating']; ?> ★</h3>
                <p><i class="fas fa-star"></i> Avg Rating</p>
            </div>
        </div>
        <?php endif; ?>

        <?php if($active_tab == 'orders'): ?>
        <div class="section">
            <h2><i class="fas fa-shopping-cart"></i> All Orders</h2>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr><th>Order #</th><th>Customer</th><th>Phone</th><th>Total</th><th>Payment</th><th>Status</th><th>Date</th><th>Action</th></tr>
                    </thead>
                    <tbody>
                        <?php while($order = $recentOrders->fetch_assoc()): ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($order['order_number']); ?></strong></td>
                            <td><?php echo htmlspecialchars($order['customer_name']); ?></td>
                            <td><?php echo htmlspecialchars($order['customer_phone']); ?></td>
                            <td>₹<?php echo number_format($order['total_amount'], 2); ?></td>
                            <td><?php echo strtoupper($order['payment_method']); ?></td>
                            <td>
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                    <input type="hidden" name="update_order" value="1">
                                    <select name="status" class="status-select" onchange="this.form.submit()">
                                        <option value="pending" <?php echo $order['order_status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                        <option value="confirmed" <?php echo $order['order_status'] == 'confirmed' ? 'selected' : ''; ?>>Confirmed</option>
                                        <option value="preparing" <?php echo $order['order_status'] == 'preparing' ? 'selected' : ''; ?>>Preparing</option>
                                        <option value="out_for_delivery" <?php echo $order['order_status'] == 'out_for_delivery' ? 'selected' : ''; ?>>Out for Delivery</option>
                                        <option value="delivered" <?php echo $order['order_status'] == 'delivered' ? 'selected' : ''; ?>>Delivered</option>
                                        <option value="cancelled" <?php echo $order['order_status'] == 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                                    </select>
                                </form>
                            </td>
                            <td><?php echo date('d M Y', strtotime($order['created_at'])); ?></td>
                            <td>
                                <button class="btn-sm btn-primary view-order" data-id="<?php echo $order['id']; ?>" data-number="<?php echo htmlspecialchars($order['order_number']); ?>">
                                    <i class="fas fa-eye"></i> View
                                </button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endif; ?>

        <?php if($active_tab == 'enquiries'): ?>
        <div class="section">
            <h2><i class="fas fa-envelope"></i> Contact Form Enquiries</h2>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr><th>ID</th><th>Name</th><th>Email</th><th>Purpose</th><th>Message</th><th>Status</th><th>Date</th><th>Action</th></tr>
                    </thead>
                    <tbody>
                        <?php while($enquiry = $recentEnquiries->fetch_assoc()): ?>
                        <tr>
                            <td>#<?php echo $enquiry['id']; ?></td>
                            <td><?php echo htmlspecialchars($enquiry['full_name']); ?></td>
                            <td><?php echo htmlspecialchars($enquiry['email']); ?></td>
                            <td><?php echo str_replace('-', ' ', ucfirst($enquiry['purpose'])); ?></td>
                            <td><?php echo substr(htmlspecialchars($enquiry['message']), 0, 50) . '...'; ?></td>
                            <td>
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="enquiry_id" value="<?php echo $enquiry['id']; ?>">
                                    <input type="hidden" name="update_enquiry" value="1">
                                    <select name="status" class="status-select" onchange="this.form.submit()">
                                        <option value="new" <?php echo $enquiry['status'] == 'new' ? 'selected' : ''; ?>>New</option>
                                        <option value="read" <?php echo $enquiry['status'] == 'read' ? 'selected' : ''; ?>>Read</option>
                                        <option value="replied" <?php echo $enquiry['status'] == 'replied' ? 'selected' : ''; ?>>Replied</option>
                                    </select>
                                </form>
                            </td>
                            <td><?php echo date('d M Y', strtotime($enquiry['created_at'])); ?></td>
                            <td>
                                <button class="btn-sm btn-primary view-enquiry" 
                                    data-name="<?php echo htmlspecialchars($enquiry['full_name']); ?>" 
                                    data-email="<?php echo htmlspecialchars($enquiry['email']); ?>" 
                                    data-phone="<?php echo htmlspecialchars($enquiry['phone']); ?>" 
                                    data-message="<?php echo htmlspecialchars($enquiry['message']); ?>">
                                    <i class="fas fa-eye"></i> View
                                </button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endif; ?>

        <?php if($active_tab == 'export'): ?>
        <div class="section">
            <h2><i class="fas fa-globe"></i> Export Enquiries</h2>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Company</th>
                            <th>Contact Person</th>
                            <th>Email</th>
                            <th>Country</th>
                            <th>Products Interest</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($export = $exportEnquiries->fetch_assoc()): ?>
                        <tr>
                            <td>#<?php echo $export['id']; ?></td>
                            <td><strong><?php echo htmlspecialchars($export['company_name']); ?></strong></td>
                            <td><?php echo htmlspecialchars($export['contact_person']); ?></td>
                            <td><?php echo htmlspecialchars($export['email']); ?></td>
                            <td><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($export['country']); ?></td>
                            <td><?php echo substr(htmlspecialchars($export['products_interest']), 0, 40) . '...'; ?></td>
                            <td>
                                <span class="status status-new">
                                    <i class="fas fa-bell"></i> <?php echo ucfirst($export['status']); ?>
                                </span>
                            </td>
                            <td><?php echo date('d M Y', strtotime($export['created_at'])); ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endif; ?>

        <?php if($active_tab == 'reviews'): ?>
        <div class="section">
            <h2><i class="fas fa-star"></i> Customer Reviews</h2>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Rating</th>
                            <th>Title</th>
                            <th>Review</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($review = $reviews->fetch_assoc()): ?>
                        <tr>
                            <td>
                                <i class="fas fa-user-circle"></i> 
                                <?php echo htmlspecialchars($review['user_name'] ?? 'Anonymous'); ?>
                            </td>
                            <td class="rating-stars">
                                <?php 
                                $fullStars = $review['rating'];
                                $emptyStars = 5 - $fullStars;
                                echo str_repeat('★', $fullStars) . str_repeat('☆', $emptyStars);
                                ?>
                            </td>
                            <td><?php echo htmlspecialchars($review['title']); ?></td>
                            <td><?php echo substr(htmlspecialchars($review['review_text']), 0, 50) . '...'; ?></td>
                            <td>
                                <?php if($review['is_approved']): ?>
                                    <span class="status status-delivered">
                                        <i class="fas fa-check-circle"></i> Approved
                                    </span>
                                <?php else: ?>
                                    <span class="status status-pending">
                                        <i class="fas fa-clock"></i> Pending
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo date('d M Y', strtotime($review['created_at'])); ?></td>
                            <td>
                                <?php if(!$review['is_approved']): ?>
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="review_id" value="<?php echo $review['id']; ?>">
                                    <button type="submit" name="approve_review" class="btn-sm btn-primary">
                                        <i class="fas fa-check"></i> Approve
                                    </button>
                                </form>
                                <?php else: ?>
                                    <button class="btn-sm btn-info" disabled style="opacity:0.6;">
                                        <i class="fas fa-check-double"></i> Approved
                                    </button>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                <td>
            </div>
        </div>
        <?php endif; ?>

        <?php if($active_tab == 'subscribers'): ?>
        <div class="section">
            <h2><i class="fas fa-users"></i> Newsletter Subscribers</h2>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Subscribed Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($sub = $subscribers->fetch_assoc()): ?>
                        <tr>
                            <td>#<?php echo $sub['id']; ?></td>
                            <td>
                                <i class="fas fa-envelope"></i> 
                                <a href="mailto:<?php echo htmlspecialchars($sub['email']); ?>" style="color: #78B04B; text-decoration: none;">
                                    <?php echo htmlspecialchars($sub['email']); ?>
                                </a>
                            </td>
                            <td>
                                <i class="fas fa-calendar-alt"></i> 
                                <?php echo date('d M Y, h:i A', strtotime($sub['subscribed_at'])); ?>
                            </td>
                            <td>
                                <span class="status status-delivered">
                                    <i class="fas fa-check-circle"></i> Active
                                </span>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- Order Details Modal -->
    <div id="orderModal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h3><i class="fas fa-shopping-cart"></i> Order Details - <span id="modalOrderNumber"></span></h3>
            <div id="modalOrderContent">
                <div style="text-align: center; padding: 30px;">
                    <div class="loading-spinner"></div>
                    <p style="margin-top: 15px;">Loading order details...</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Enquiry Details Modal -->
    <div id="enquiryModal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h3><i class="fas fa-headset"></i> Enquiry Details</h3>
            <div id="modalEnquiryContent">
                <div style="text-align: center; padding: 30px;">
                    <div class="loading-spinner"></div>
                    <p style="margin-top: 15px;">Loading enquiry details...</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Order Modal
        const orderModal = document.getElementById('orderModal');
        const enquiryModal = document.getElementById('enquiryModal');
        
        // View Order Details
        document.querySelectorAll('.view-order').forEach(btn => {
            btn.addEventListener('click', async function() {
                const orderNumber = this.dataset.number;
                document.getElementById('modalOrderNumber').textContent = orderNumber;
                
                document.getElementById('modalOrderContent').innerHTML = `
                    <div style="text-align: center; padding: 30px;">
                        <div class="loading-spinner"></div>
                        <p style="margin-top: 15px;">Loading order details...</p>
                    </div>
                `;
                orderModal.style.display = 'flex';
                
                try {
                    const response = await fetch(`../api/order_api.php`, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ action: 'get_order', orderNumber: orderNumber })
                    });
                    const data = await response.json();
                    
                    if (data.success && data.order) {
                        let itemsHtml = '<div style="margin-top: 20px;"><h4 style="margin-bottom: 15px;"><i class="fas fa-boxes"></i> Order Items:</h4><table style="width:100%; border-collapse: collapse;">';
                        itemsHtml += '<thead><tr style="background: #f8f9fa;"><th style="padding: 10px; text-align: left;">Product</th><th style="padding: 10px; text-align: center;">Qty</th><th style="padding: 10px; text-align: right;">Price</th><th style="padding: 10px; text-align: right;">Total</th></tr></thead><tbody>';
                        
                        if (data.items && data.items.length > 0) {
                            data.items.forEach(item => {
                                itemsHtml += `<tr>
                                    <td style="padding: 10px; border-bottom: 1px solid #eee;">${item.product_name}</td>
                                    <td style="padding: 10px; text-align: center; border-bottom: 1px solid #eee;">${item.quantity}</td>
                                    <td style="padding: 10px; text-align: right; border-bottom: 1px solid #eee;">₹${parseFloat(item.price).toFixed(2)}</td>
                                    <td style="padding: 10px; text-align: right; border-bottom: 1px solid #eee;">₹${parseFloat(item.total_price).toFixed(2)}</td>
                                </tr>`;
                            });
                        } else {
                            itemsHtml += `<tr><td colspan="4" style="padding: 20px; text-align: center;">No items found</td></tr>`;
                        }
                        itemsHtml += '</tbody></table></div>';
                        
                        document.getElementById('modalOrderContent').innerHTML = `
                            <div class="order-detail-item">
                                <span class="detail-label"><i class="fas fa-user"></i> Customer:</span>
                                <span class="detail-value">${data.order.customer_name || 'N/A'}</span>
                            </div>
                            <div class="order-detail-item">
                                <span class="detail-label"><i class="fas fa-envelope"></i> Email:</span>
                                <span class="detail-value">${data.order.customer_email || 'N/A'}</span>
                            </div>
                            <div class="order-detail-item">
                                <span class="detail-label"><i class="fas fa-phone"></i> Phone:</span>
                                <span class="detail-value">${data.order.customer_phone || 'N/A'}</span>
                            </div>
                            <div class="order-detail-item">
                                <span class="detail-label"><i class="fas fa-map-marker-alt"></i> Address:</span>
                                <span class="detail-value">${data.order.delivery_address || 'N/A'}, ${data.order.city || 'N/A'} - ${data.order.pincode || 'N/A'}</span>
                            </div>
                            <div class="order-detail-item">
                                <span class="detail-label"><i class="fas fa-credit-card"></i> Payment Method:</span>
                                <span class="detail-value">${(data.order.payment_method || 'N/A').toUpperCase()}</span>
                            </div>
                            <div class="order-detail-item">
                                <span class="detail-label"><i class="fas fa-chart-line"></i> Order Status:</span>
                                <span class="detail-value"><span class="status status-${data.order.order_status}">${data.order.order_status}</span></span>
                            </div>
                            <div style="margin-top: 15px; padding-top: 15px; border-top: 2px dashed #eee;">
                                <div class="order-detail-item">
                                    <span class="detail-label"><i class="fas fa-receipt"></i> Subtotal:</span>
                                    <span class="detail-value">₹${parseFloat(data.order.subtotal).toFixed(2)}</span>
                                </div>
                                <div class="order-detail-item">
                                    <span class="detail-label"><i class="fas fa-bike"></i> Delivery Fee:</span>
                                    <span class="detail-value">₹${parseFloat(data.order.delivery_fee).toFixed(2)}</span>
                                </div>
                                <div class="order-detail-item">
                                    <span class="detail-label"><i class="fas fa-percent"></i> Tax (5%):</span>
                                    <span class="detail-value">₹${parseFloat(data.order.tax_amount).toFixed(2)}</span>
                                </div>
                                <div class="order-detail-item" style="border-top: 2px solid #78B04B; margin-top: 5px; padding-top: 15px;">
                                    <span class="detail-label" style="font-size: 1.1rem;"><strong>Total Amount:</strong></span>
                                    <span class="detail-value" style="font-size: 1.2rem; color: #78B04B; font-weight: bold;">₹${parseFloat(data.order.total_amount).toFixed(2)}</span>
                                </div>
                            </div>
                            ${itemsHtml}
                        `;
                    } else {
                        document.getElementById('modalOrderContent').innerHTML = `
                            <div style="text-align: center; padding: 30px;">
                                <i class="fas fa-exclamation-triangle" style="font-size: 3rem; color: #ffc107;"></i>
                                <p style="margin-top: 15px;">Unable to load order details.</p>
                                <p style="font-size: 0.85rem; color: #999;">Order ID: ${orderNumber}</p>
                            </div>
                        `;
                    }
                } catch (error) {
                    console.error('Error:', error);
                    document.getElementById('modalOrderContent').innerHTML = `
                        <div style="text-align: center; padding: 30px;">
                            <i class="fas fa-exclamation-circle" style="font-size: 3rem; color: #dc3545;"></i>
                            <p style="margin-top: 15px;">Error loading order details: ${error.message}</p>
                        </div>
                    `;
                }
            });
        });
        
        // View Enquiry Details
        document.querySelectorAll('.view-enquiry').forEach(btn => {
            btn.addEventListener('click', function() {
                const name = this.dataset.name || 'N/A';
                const email = this.dataset.email || 'N/A';
                const phone = this.dataset.phone || 'N/A';
                const message = this.dataset.message || 'No message provided';
                
                document.getElementById('modalEnquiryContent').innerHTML = `
                    <div class="order-detail-item">
                        <span class="detail-label"><i class="fas fa-user"></i> Name:</span>
                        <span class="detail-value">${name}</span>
                    </div>
                    <div class="order-detail-item">
                        <span class="detail-label"><i class="fas fa-envelope"></i> Email:</span>
                        <span class="detail-value"><a href="mailto:${email}" style="color: #78B04B;">${email}</a></span>
                    </div>
                    <div class="order-detail-item">
                        <span class="detail-label"><i class="fas fa-phone"></i> Phone:</span>
                        <span class="detail-value">${phone}</span>
                    </div>
                    <div class="order-detail-item">
                        <span class="detail-label"><i class="fas fa-comment"></i> Message:</span>
                    </div>
                    <div class="order-detail-item" style="background: #f8f9fa; padding: 15px; border-radius: 12px; margin-top: 10px; display: block;">
                        <p style="white-space: pre-wrap; line-height: 1.6;">${message.replace(/\n/g, '<br>')}</p>
                    </div>
                    <div style="margin-top: 20px; text-align: center;">
                        <a href="mailto:${email}?subject=Response to your enquiry" class="btn-sm btn-primary" style="display: inline-flex; align-items: center; gap: 8px; text-decoration: none;">
                            <i class="fas fa-reply"></i> Reply via Email
                        </a>
                    </div>
                `;
                enquiryModal.style.display = 'flex';
            });
        });
        
        // Close modals
        document.querySelectorAll('.close-modal').forEach(close => {
            close.addEventListener('click', function() {
                orderModal.style.display = 'none';
                enquiryModal.style.display = 'none';
            });
        });
        
        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target === orderModal) orderModal.style.display = 'none';
            if (event.target === enquiryModal) enquiryModal.style.display = 'none';
        }
        
        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                orderModal.style.display = 'none';
                enquiryModal.style.display = 'none';
            }
        });
        
        // Add animation to stat cards on load
        document.addEventListener('DOMContentLoaded', function() {
            const statCards = document.querySelectorAll('.stat-card');
            statCards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });
        });
    </script>
</body>
</html>
<?php $conn->close(); ?>