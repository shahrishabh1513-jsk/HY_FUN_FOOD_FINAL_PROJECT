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
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <style>
            * { margin: 0; padding: 0; box-sizing: border-box; }
            body { font-family: 'Poppins', sans-serif; background: linear-gradient(135deg, #78B04B, #6EC1E4); min-height: 100vh; display: flex; align-items: center; justify-content: center; }
            .login-container { background: white; padding: 40px; border-radius: 20px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); width: 400px; }
            .login-container h2 { text-align: center; color: #2D3748; margin-bottom: 30px; }
            .login-container input { width: 100%; padding: 15px; margin-bottom: 20px; border: 2px solid #e0e0e0; border-radius: 10px; font-size: 16px; }
            .login-container button { width: 100%; padding: 15px; background: linear-gradient(135deg, #78B04B, #6EC1E4); color: white; border: none; border-radius: 10px; font-size: 16px; font-weight: 600; cursor: pointer; }
            .error { background: #ff4757; color: white; padding: 10px; border-radius: 10px; margin-bottom: 20px; text-align: center; }
        </style>
    </head>
    <body>
        <div class="login-container">
            <h2><i class="fas fa-lock"></i> Admin Login</h2>
            <?php if(isset($error)) echo '<div class="error">' . $error . '</div>'; ?>
            <form method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="login">Login to Dashboard</button>
            </form>
        </div>
    </body>
    </html>
    <?php
    exit;
}

require_once '../includes/functions.php';
$conn = getConnection();

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
    $stmt = $conn->prepare("UPDATE reviews SET is_approved = TRUE WHERE id = ?");
    $stmt->bind_param("i", $review_id);
    $stmt->execute();
    header('Location: dashboard.php?tab=reviews');
    exit;
}

// Get statistics
$stats = [];
$result = $conn->query("SELECT COUNT(*) as total FROM orders");
$stats['total_orders'] = $result->fetch_assoc()['total'];

$result = $conn->query("SELECT SUM(total_amount) as total FROM orders WHERE order_status = 'delivered'");
$stats['total_revenue'] = $result->fetch_assoc()['total'] ?? 0;

$result = $conn->query("SELECT COUNT(*) as total FROM enquiries WHERE status = 'new'");
$stats['new_enquiries'] = $result->fetch_assoc()['total'];

$result = $conn->query("SELECT COUNT(*) as total FROM export_enquiries WHERE status = 'new'");
$stats['new_export_enquiries'] = $result->fetch_assoc()['total'];

$result = $conn->query("SELECT COUNT(*) as total FROM newsletter_subscribers");
$stats['subscribers'] = $result->fetch_assoc()['total'];

$result = $conn->query("SELECT AVG(rating) as avg FROM reviews WHERE is_approved = TRUE");
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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background: #f5f7fb; }
        .sidebar { position: fixed; left: 0; top: 0; width: 260px; height: 100%; background: #2D3748; color: white; padding: 20px 0; }
        .sidebar h2 { text-align: center; padding: 20px; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 20px; }
        .sidebar h2 i { color: #78B04B; margin-right: 10px; }
        .sidebar a { display: flex; align-items: center; padding: 15px 25px; color: rgba(255,255,255,0.8); text-decoration: none; transition: all 0.3s; gap: 12px; }
        .sidebar a:hover, .sidebar a.active { background: rgba(120,176,75,0.2); color: #78B04B; border-left: 3px solid #78B04B; }
        .sidebar a i { width: 24px; }
        .main-content { margin-left: 260px; padding: 20px; }
        .header { background: white; padding: 20px 30px; border-radius: 12px; margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .header h1 { font-size: 1.8rem; color: #2D3748; }
        .logout-btn { background: #ff4757; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; }
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: white; padding: 25px; border-radius: 16px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); text-align: center; transition: transform 0.3s; }
        .stat-card:hover { transform: translateY(-5px); }
        .stat-card h3 { font-size: 2.2rem; color: #78B04B; margin-bottom: 10px; }
        .stat-card p { color: #666; font-weight: 500; }
        .section { background: white; border-radius: 16px; padding: 25px; margin-bottom: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .section h2 { margin-bottom: 20px; color: #2D3748; border-left: 4px solid #78B04B; padding-left: 15px; }
        table { width: 100%; border-collapse: collapse; overflow-x: auto; display: block; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #f8f9fa; font-weight: 600; color: #2D3748; }
        .status { padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 500; display: inline-block; }
        .status-pending { background: #ffc107; color: #000; }
        .status-confirmed { background: #17a2b8; color: white; }
        .status-preparing { background: #6c757d; color: white; }
        .status-out_for_delivery { background: #fd7e14; color: white; }
        .status-delivered { background: #28a745; color: white; }
        .status-cancelled { background: #dc3545; color: white; }
        .status-new { background: #17a2b8; color: white; }
        .status-read { background: #6c757d; color: white; }
        .btn-sm { padding: 5px 12px; border: none; border-radius: 6px; cursor: pointer; font-size: 0.8rem; margin: 2px; }
        .btn-primary { background: #78B04B; color: white; }
        .btn-warning { background: #ffc107; color: #000; }
        .btn-danger { background: #dc3545; color: white; }
        .btn-info { background: #17a2b8; color: white; }
        select.status-select { padding: 5px 10px; border-radius: 6px; border: 1px solid #ddd; }
        .view-details { color: #78B04B; cursor: pointer; text-decoration: underline; }
        .modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center; }
        .modal-content { background: white; padding: 30px; border-radius: 16px; max-width: 600px; width: 90%; max-height: 80vh; overflow-y: auto; }
        .modal-content h3 { margin-bottom: 20px; color: #2D3748; }
        .close-modal { float: right; font-size: 24px; cursor: pointer; color: #999; }
        .order-detail-item { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #eee; }
        @media (max-width: 768px) { .sidebar { width: 70px; } .sidebar span { display: none; } .main-content { margin-left: 70px; } .stats-grid { grid-template-columns: repeat(2, 1fr); } }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2><i class="fas fa-chart-line"></i> <span>HyFun Admin</span></h2>
        <a href="?tab=dashboard" class="<?php echo $active_tab == 'dashboard' ? 'active' : ''; ?>"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a>
        <a href="?tab=orders" class="<?php echo $active_tab == 'orders' ? 'active' : ''; ?>"><i class="fas fa-shopping-cart"></i> <span>Orders</span></a>
        <a href="?tab=enquiries" class="<?php echo $active_tab == 'enquiries' ? 'active' : ''; ?>"><i class="fas fa-envelope"></i> <span>Enquiries</span></a>
        <a href="?tab=export" class="<?php echo $active_tab == 'export' ? 'active' : ''; ?>"><i class="fas fa-globe"></i> <span>Export Enquiries</span></a>
        <a href="?tab=reviews" class="<?php echo $active_tab == 'reviews' ? 'active' : ''; ?>"><i class="fas fa-star"></i> <span>Reviews</span></a>
        <a href="?tab=subscribers" class="<?php echo $active_tab == 'subscribers' ? 'active' : ''; ?>"><i class="fas fa-users"></i> <span>Subscribers</span></a>
        <a href="?logout=1" class="logout-btn" style="margin-top: 50px; background: #ff4757;"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a>
    </div>

    <div class="main-content">
        <div class="header">
            <h1><i class="fas fa-store"></i> HyFun Foods Admin Panel</h1>
            <span>Welcome, Admin</span>
        </div>

        <?php if($active_tab == 'dashboard'): ?>
        <div class="stats-grid">
            <div class="stat-card"><h3><?php echo $stats['total_orders']; ?></h3><p><i class="fas fa-shopping-cart"></i> Total Orders</p></div>
            <div class="stat-card"><h3>₹<?php echo number_format($stats['total_revenue']); ?></h3><p><i class="fas fa-rupee-sign"></i> Total Revenue</p></div>
            <div class="stat-card"><h3><?php echo $stats['new_enquiries'] + $stats['new_export_enquiries']; ?></h3><p><i class="fas fa-envelope"></i> New Enquiries</p></div>
            <div class="stat-card"><h3><?php echo $stats['subscribers']; ?></h3><p><i class="fas fa-users"></i> Subscribers</p></div>
            <div class="stat-card"><h3><?php echo $stats['avg_rating']; ?> ★</h3><p><i class="fas fa-star"></i> Avg Rating</p></div>
        </div>
        <?php endif; ?>

        <?php if($active_tab == 'orders'): ?>
        <div class="section">
            <h2><i class="fas fa-shopping-cart"></i> All Orders</h2>
            <div style="overflow-x: auto;">
                <table>
                    <thead>
                        <tr><th>Order #</th><th>Customer</th><th>Phone</th><th>Total</th><th>Payment</th><th>Status</th><th>Date</th><th>Action</th></tr>
                    </thead>
                    <tbody>
                        <?php while($order = $recentOrders->fetch_assoc()): ?>
                        <tr>
                            <td><strong><?php echo $order['order_number']; ?></strong></td>
                            <td><?php echo $order['customer_name']; ?></td>
                            <td><?php echo $order['customer_phone']; ?></td>
                            <td>₹<?php echo number_format($order['total_amount'], 2); ?></td>
                            <td><?php echo strtoupper($order['payment_method']); ?></td>
                            <td>
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                    <select name="status" class="status-select" onchange="this.form.submit()">
                                        <option value="pending" <?php echo $order['order_status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                        <option value="confirmed" <?php echo $order['order_status'] == 'confirmed' ? 'selected' : ''; ?>>Confirmed</option>
                                        <option value="preparing" <?php echo $order['order_status'] == 'preparing' ? 'selected' : ''; ?>>Preparing</option>
                                        <option value="out_for_delivery" <?php echo $order['order_status'] == 'out_for_delivery' ? 'selected' : ''; ?>>Out for Delivery</option>
                                        <option value="delivered" <?php echo $order['order_status'] == 'delivered' ? 'selected' : ''; ?>>Delivered</option>
                                        <option value="cancelled" <?php echo $order['order_status'] == 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                                    </select>
                                    <input type="hidden" name="update_order" value="1">
                                </form>
                            </td>
                            <td><?php echo date('d M Y', strtotime($order['created_at'])); ?></td>
                            <td><button class="btn-sm btn-primary view-order" data-id="<?php echo $order['id']; ?>" data-number="<?php echo $order['order_number']; ?>">View Details</button></td>
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
            <div style="overflow-x: auto;">
                <table>
                    <thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Purpose</th><th>Message</th><th>Status</th><th>Date</th><th>Action</th></tr></thead>
                    <tbody>
                        <?php while($enquiry = $recentEnquiries->fetch_assoc()): ?>
                        <tr>
                            <td>#<?php echo $enquiry['id']; ?></td>
                            <td><?php echo $enquiry['full_name']; ?></td>
                            <td><?php echo $enquiry['email']; ?></td>
                            <td><?php echo str_replace('-', ' ', ucfirst($enquiry['purpose'])); ?></td>
                            <td><?php echo substr($enquiry['message'], 0, 50) . '...'; ?></td>
                            <td>
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="enquiry_id" value="<?php echo $enquiry['id']; ?>">
                                    <select name="status" onchange="this.form.submit()">
                                        <option value="new" <?php echo $enquiry['status'] == 'new' ? 'selected' : ''; ?>>New</option>
                                        <option value="read" <?php echo $enquiry['status'] == 'read' ? 'selected' : ''; ?>>Read</option>
                                        <option value="replied" <?php echo $enquiry['status'] == 'replied' ? 'selected' : ''; ?>>Replied</option>
                                    </select>
                                    <input type="hidden" name="update_enquiry" value="1">
                                </form>
                            </td>
                            <td><?php echo date('d M Y', strtotime($enquiry['created_at'])); ?></td>
                            <td><button class="btn-sm btn-primary view-enquiry" data-id="<?php echo $enquiry['id']; ?>" data-name="<?php echo $enquiry['full_name']; ?>" data-email="<?php echo $enquiry['email']; ?>" data-phone="<?php echo $enquiry['phone']; ?>" data-message="<?php echo htmlspecialchars($enquiry['message']); ?>">View</button></td>
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
            <div style="overflow-x: auto;">
                <table>
                    <thead><tr><th>ID</th><th>Company</th><th>Contact Person</th><th>Email</th><th>Country</th><th>Status</th><th>Date</th></tr></thead>
                    <tbody>
                        <?php while($export = $exportEnquiries->fetch_assoc()): ?>
                        <tr>
                            <td>#<?php echo $export['id']; ?></td>
                            <td><?php echo $export['company_name']; ?></td>
                            <td><?php echo $export['contact_person']; ?></td>
                            <td><?php echo $export['email']; ?></td>
                            <td><?php echo $export['country']; ?></td>
                            <td><span class="status status-new"><?php echo ucfirst($export['status']); ?></span></td>
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
            <div style="overflow-x: auto;">
                <table>
                    <thead><tr><th>User</th><th>Rating</th><th>Title</th><th>Review</th><th>Status</th><th>Date</th><th>Action</th></tr></thead>
                    <tbody>
                        <?php while($review = $reviews->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $review['user_name'] ?? 'Anonymous'; ?></td>
                            <td><span style="color: #ffc107;"><?php echo str_repeat('★', $review['rating']) . str_repeat('☆', 5 - $review['rating']); ?></span></td>
                            <td><?php echo $review['title']; ?></td>
                            <td><?php echo substr($review['review_text'], 0, 50) . '...'; ?></td>
                            <td><?php echo $review['is_approved'] ? '<span class="status status-delivered">Approved</span>' : '<span class="status status-pending">Pending</span>'; ?></td>
                            <td><?php echo date('d M Y', strtotime($review['created_at'])); ?></td>
                            <td><?php if(!$review['is_approved']): ?><form method="POST"><input type="hidden" name="review_id" value="<?php echo $review['id']; ?>"><button type="submit" name="approve_review" class="btn-sm btn-primary">Approve</button></form><?php endif; ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endif; ?>

        <?php if($active_tab == 'subscribers'): ?>
        <div class="section">
            <h2><i class="fas fa-users"></i> Newsletter Subscribers</h2>
            <div style="overflow-x: auto;">
                <table>
                    <thead><tr><th>ID</th><th>Email</th><th>Subscribed Date</th><th>Status</th></tr></thead>
                    <tbody>
                        <?php while($sub = $subscribers->fetch_assoc()): ?>
                        <tr>
                            <td>#<?php echo $sub['id']; ?></td>
                            <td><?php echo $sub['email']; ?></td>
                            <td><?php echo date('d M Y', strtotime($sub['subscribed_at'])); ?></td>
                            <td><span class="status status-delivered">Active</span></td>
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
            <h3>Order Details - <span id="modalOrderNumber"></span></h3>
            <div id="modalOrderContent"></div>
        </div>
    </div>

    <!-- Enquiry Details Modal -->
    <div id="enquiryModal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h3>Enquiry Details</h3>
            <div id="modalEnquiryContent"></div>
        </div>
    </div>

    <script>
        // Order Modal
        const orderModal = document.getElementById('orderModal');
        const enquiryModal = document.getElementById('enquiryModal');
        
        document.querySelectorAll('.view-order').forEach(btn => {
            btn.addEventListener('click', async function() {
                const orderId = this.dataset.id;
                const orderNumber = this.dataset.number;
                document.getElementById('modalOrderNumber').textContent = orderNumber;
                
                try {
                    const response = await fetch(`../api/order_api.php`, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ action: 'get_order', orderNumber: orderNumber })
                    });
                    const data = await response.json();
                    
                    if (data.success) {
                        let itemsHtml = '<div style="margin-top: 20px;"><h4>Order Items:</h4><table style="width:100%"><tr><th>Product</th><th>Qty</th><th>Price</th><th>Total</th></tr>';
                        data.items.forEach(item => {
                            itemsHtml += `<tr><td>${item.product_name}</td><td>${item.quantity}</td><td>₹${item.price}</td><td>₹${item.total_price}</td></tr>`;
                        });
                        itemsHtml += '</table></div>';
                        
                        document.getElementById('modalOrderContent').innerHTML = `
                            <div class="order-detail-item"><strong>Customer:</strong> ${data.order.customer_name}</div>
                            <div class="order-detail-item"><strong>Email:</strong> ${data.order.customer_email}</div>
                            <div class="order-detail-item"><strong>Phone:</strong> ${data.order.customer_phone}</div>
                            <div class="order-detail-item"><strong>Address:</strong> ${data.order.delivery_address}, ${data.order.city} - ${data.order.pincode}</div>
                            <div class="order-detail-item"><strong>Payment Method:</strong> ${data.order.payment_method.toUpperCase()}</div>
                            <div class="order-detail-item"><strong>Subtotal:</strong> ₹${data.order.subtotal}</div>
                            <div class="order-detail-item"><strong>Delivery Fee:</strong> ₹${data.order.delivery_fee}</div>
                            <div class="order-detail-item"><strong>Tax:</strong> ₹${data.order.tax_amount}</div>
                            <div class="order-detail-item"><strong>Total:</strong> <strong>₹${data.order.total_amount}</strong></div>
                            ${itemsHtml}
                        `;
                        orderModal.style.display = 'flex';
                    }
                } catch (error) {
                    alert('Error loading order details');
                }
            });
        });
        
        document.querySelectorAll('.view-enquiry').forEach(btn => {
            btn.addEventListener('click', function() {
                document.getElementById('modalEnquiryContent').innerHTML = `
                    <div class="order-detail-item"><strong>Name:</strong> ${this.dataset.name}</div>
                    <div class="order-detail-item"><strong>Email:</strong> ${this.dataset.email}</div>
                    <div class="order-detail-item"><strong>Phone:</strong> ${this.dataset.phone}</div>
                    <div class="order-detail-item"><strong>Message:</strong></div>
                    <div class="order-detail-item" style="background:#f5f5f5; padding:15px; border-radius:8px;">${this.dataset.message}</div>
                `;
                enquiryModal.style.display = 'flex';
            });
        });
        
        document.querySelectorAll('.close-modal').forEach(close => {
            close.addEventListener('click', function() {
                orderModal.style.display = 'none';
                enquiryModal.style.display = 'none';
            });
        });
        
        window.onclick = function(event) {
            if (event.target === orderModal) orderModal.style.display = 'none';
            if (event.target === enquiryModal) enquiryModal.style.display = 'none';
        }
    </script>
</body>
</html>
<?php $conn->close(); ?>