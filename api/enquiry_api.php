<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../includes/functions.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (isset($input['action'])) {
        switch ($input['action']) {
            case 'save_enquiry':
                if (isset($input['enquiryData'])) {
                    $result = saveEnquiry($input['enquiryData']);
                    echo json_encode($result);
                } else {
                    echo json_encode(['success' => false, 'error' => 'Missing enquiry data']);
                }
                break;
                
            case 'save_export_enquiry':
                if (isset($input['exportData'])) {
                    $result = saveExportEnquiry($input['exportData']);
                    echo json_encode($result);
                } else {
                    echo json_encode(['success' => false, 'error' => 'Missing export enquiry data']);
                }
                break;
                
            case 'save_review':
                if (isset($input['reviewData'])) {
                    $result = saveReview($input['reviewData']);
                    echo json_encode($result);
                } else {
                    echo json_encode(['success' => false, 'error' => 'Missing review data']);
                }
                break;
                
            case 'subscribe_newsletter':
                if (isset($input['email'])) {
                    $result = subscribeNewsletter($input['email']);
                    echo json_encode($result);
                } else {
                    echo json_encode(['success' => false, 'error' => 'Missing email']);
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