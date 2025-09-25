<?php
require_once __DIR__ . '/../Classes/customer_class.php';


header('Content-Type: application/json; charset=utf-8');

ini_set('display_errors','1'); error_reporting(E_ALL);

try {

    require_once __DIR__ . '/../Controllers/customer_controller.php';

    $raw = file_get_contents('php://input');
    $data = json_decode($raw, true);

    if (!is_array($data)) {
        http_response_code(400);
        echo json_encode(['status'=>'error','message'=>'Invalid JSON payload']); exit;
    }

    $res = register_customer_ctr($data);

    $code = ($res['status'] ?? '') === 'success' ? 200 : 422;
    http_response_code($code);
    echo json_encode($res);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode([
        'status'=>'error',
        'message'=>'Server error: ' . $e->getMessage()
    ]);
}
