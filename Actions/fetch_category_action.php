<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);


require_once __DIR__ . '/../settings/core.php';
require_once __DIR__ . '/../Controllers/category_controller.php';
header('Content-Type: application/json; charset=utf-8');
echo json_encode(fetch_categories_ctr());
