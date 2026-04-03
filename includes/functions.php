<?php
require_once __DIR__ . '/../config/database.php';

// Sanitize input
function sanitize($input) {
    return htmlspecialchars(strip_tags(trim($input)));
}

// Generate unique order number
function generateOrderNumber() {
    return 'HYFUN-' . strtoupper(uniqid()) . '-' . rand(1000, 9999);
}

// Save order to database
function saveOrder($orderData, $cartItems) {
    $conn = getConnection();
    
    // Calculate totals
    $subtotal = 0;
    foreach ($cartItems as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }
    $deliveryFee = 40;
    $tax = $subtotal * 0.05;
    $total = $subtotal + $deliveryFee + $tax;
    
    // Insert order
    $orderNumber = generateOrderNumber();
    $stmt = $conn->prepare("INSERT INTO orders (order_number, customer_name, customer_email, customer_phone, delivery_address, landmark, city, pincode, delivery_time, payment_method, subtotal, delivery_fee, tax_amount, total_amount, order_status, payment_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending', 'pending')");
    
    $stmt->bind_param("ssssssssssdddd", 
        $orderNumber,
        $orderData['fullName'],
        $orderData['email'],
        $orderData['phoneNumber'],
        $orderData['address'],
        $orderData['landmark'],
        $orderData['city'],
        $orderData['pincode'],
        $orderData['deliveryTime'],
        $orderData['paymentMethod'],
        $subtotal,
        $deliveryFee,
        $tax,
        $total
    );
    
    if ($stmt->execute()) {
        $orderId = $stmt->insert_id;
        
        // Insert order items
        $itemStmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, product_name, product_image, quantity, price, total_price, weight) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        
        foreach ($cartItems as $item) {
            $totalPrice = $item['price'] * $item['quantity'];
            $itemStmt->bind_param("iissidds", 
                $orderId,
                $item['id'],
                $item['name'],
                $item['image'],
                $item['quantity'],
                $item['price'],
                $totalPrice,
                $item['weight']
            );
            $itemStmt->execute();
        }
        
        $itemStmt->close();
        $stmt->close();
        $conn->close();
        
        return ['success' => true, 'orderNumber' => $orderNumber, 'orderId' => $orderId];
    }
    
    $stmt->close();
    $conn->close();
    return ['success' => false, 'error' => 'Failed to save order'];
}

// Save enquiry
function saveEnquiry($enquiryData) {
    $conn = getConnection();
    
    $stmt = $conn->prepare("INSERT INTO enquiries (purpose, subject, message, full_name, company, email, phone, country, product_category, urgency, subscribed) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $subscribed = isset($enquiryData['newsletter']) && $enquiryData['newsletter'] == 'on' ? 1 : 0;
    
    $stmt->bind_param("ssssssssssi",
        $enquiryData['purpose'],
        $enquiryData['subject'],
        $enquiryData['message'],
        $enquiryData['fullName'],
        $enquiryData['company'],
        $enquiryData['email'],
        $enquiryData['phone'],
        $enquiryData['country'],
        $enquiryData['productCategory'],
        $enquiryData['urgency'],
        $subscribed
    );
    
    if ($stmt->execute()) {
        $id = $stmt->insert_id;
        $stmt->close();
        $conn->close();
        return ['success' => true, 'id' => $id];
    }
    
    $stmt->close();
    $conn->close();
    return ['success' => false, 'error' => 'Failed to save enquiry'];
}

// Save export enquiry
function saveExportEnquiry($data) {
    $conn = getConnection();
    
    $stmt = $conn->prepare("INSERT INTO export_enquiries (company_name, contact_person, email, phone, country, products_interest, message, business_type, estimated_volume) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->bind_param("sssssssss",
        $data['companyName'],
        $data['contactPerson'],
        $data['email'],
        $data['phone'],
        $data['country'],
        $data['products'],
        $data['message'],
        $data['businessType'],
        $data['estimatedVolume']
    );
    
    if ($stmt->execute()) {
        $id = $stmt->insert_id;
        $stmt->close();
        $conn->close();
        return ['success' => true, 'id' => $id];
    }
    
    $stmt->close();
    $conn->close();
    return ['success' => false, 'error' => 'Failed to save export enquiry'];
}

// Save review
function saveReview($reviewData) {
    $conn = getConnection();
    
    $tags = isset($reviewData['tags']) ? implode(',', $reviewData['tags']) : '';
    
    $stmt = $conn->prepare("INSERT INTO reviews (order_id, user_name, rating, title, review_text, tags) VALUES (?, ?, ?, ?, ?, ?)");
    
    $stmt->bind_param("ssisss",
        $reviewData['orderId'],
        $reviewData['userName'],
        $reviewData['rating'],
        $reviewData['title'],
        $reviewData['reviewText'],
        $tags
    );
    
    if ($stmt->execute()) {
        $id = $stmt->insert_id;
        $stmt->close();
        $conn->close();
        return ['success' => true, 'id' => $id];
    }
    
    $stmt->close();
    $conn->close();
    return ['success' => false, 'error' => 'Failed to save review'];
}

// Subscribe to newsletter
function subscribeNewsletter($email) {
    $conn = getConnection();
    
    $stmt = $conn->prepare("INSERT INTO newsletter_subscribers (email) VALUES (?) ON DUPLICATE KEY UPDATE is_active = TRUE");
    $stmt->bind_param("s", $email);
    
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        return ['success' => true];
    }
    
    $stmt->close();
    $conn->close();
    return ['success' => false, 'error' => 'Failed to subscribe'];
}

// Get order by number
function getOrderByNumber($orderNumber) {
    $conn = getConnection();
    
    $stmt = $conn->prepare("SELECT * FROM orders WHERE order_number = ?");
    $stmt->bind_param("s", $orderNumber);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $order = $result->fetch_assoc();
        
        // Get order items
        $itemStmt = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
        $itemStmt->bind_param("i", $order['id']);
        $itemStmt->execute();
        $items = $itemStmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $itemStmt->close();
        
        $stmt->close();
        $conn->close();
        
        return ['order' => $order, 'items' => $items];
    }
    
    $stmt->close();
    $conn->close();
    return null;
}

// Get products
function getProducts($category = null) {
    $conn = getConnection();
    
    if ($category && $category != 'all') {
        $stmt = $conn->prepare("SELECT * FROM products WHERE category = ? ORDER BY popular DESC, id ASC");
        $stmt->bind_param("s", $category);
    } else {
        $stmt = $conn->prepare("SELECT * FROM products ORDER BY popular DESC, id ASC");
    }
    
    $stmt->execute();
    $result = $stmt->get_result();
    $products = $result->fetch_all(MYSQLI_ASSOC);
    
    $stmt->close();
    $conn->close();
    
    return $products;
}

// Send email notification
function sendOrderConfirmationEmail($orderNumber, $customerEmail, $customerName) {
    $subject = "Order Confirmation - HyFun Foods #{$orderNumber}";
    $message = "Dear {$customerName},\n\n";
    $message .= "Thank you for your order! Your order #{$orderNumber} has been confirmed.\n\n";
    $message .= "We will notify you once your order is out for delivery.\n\n";
    $message .= "Thank you for choosing HyFun Foods!\n";
    $message .= "Team HyFun Foods";
    
    $headers = "From: noreply@hyfunfoods.com\r\n";
    $headers .= "Reply-To: support@hyfunfoods.com\r\n";
    
    return mail($customerEmail, $subject, $message, $headers);
}
?>