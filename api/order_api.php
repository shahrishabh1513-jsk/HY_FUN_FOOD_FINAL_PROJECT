<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../includes/functions.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    // Create log file for debugging
    $log = date('Y-m-d H:i:s') . " - Order API received: " . print_r($input, true) . "\n";
    file_put_contents(__DIR__ . '/../api_log.txt', $log, FILE_APPEND);
    
    if (isset($input['action'])) {
        switch ($input['action']) {
            case 'save_order':
                if (isset($input['orderData']) && isset($input['cartItems'])) {
                    $result = saveOrder($input['orderData'], $input['cartItems']);
                    
                    file_put_contents(__DIR__ . '/../api_log.txt', "Save order result: " . print_r($result, true) . "\n", FILE_APPEND);
                    
                    if ($result['success']) {
                        echo json_encode([
                            'success' => true,
                            'orderNumber' => $result['orderNumber'],
                            'orderId' => $result['orderId']
                        ]);
                    } else {
                        echo json_encode(['success' => false, 'error' => $result['error']]);
                    }
                } else {
                    echo json_encode(['success' => false, 'error' => 'Missing order data']);
                }
                break;
                
            default:
                echo json_encode(['success' => false, 'error' => 'Invalid action']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Missing action']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Method not allowed']);
}
?>