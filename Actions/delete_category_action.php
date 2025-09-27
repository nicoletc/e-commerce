<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);


require_once __DIR__ . '/../settings/core.php';
require_once __DIR__ . '/../Controllers/category_controller.php';
header('Content-Type: application/json; charset=utf-8');
$data = json_decode(file_get_contents('php://input'), true) ?? [];
echo json_encode(delete_category_ctr($data));
