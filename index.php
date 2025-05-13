<?php
require_once 'src/db.php';
require_once 'src/UserController.php';
require_once 'src/TaskController.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

header('Content-Type: application/json');

if (preg_match('#^/user/(\d+)$#', $uri, $matches)) {
    $userId = (int)$matches[1];

    if ($method === 'GET') {
        getUser($userId);
    }
} elseif (preg_match('#^/user/(\d+)/tasks$#', $uri, $matches)) {
    $userId = (int)$matches[1];

    if ($method === 'GET') {
        getTasksByUser($userId);
    } elseif ($method === 'POST') {
        createTaskForUser($userId);
    }
} elseif (preg_match('#^/task/(\d+)$#', $uri, $matches)) {
    $taskId = (int)$matches[1];

    if ($method === 'GET') {
        getTask($taskId);
    } elseif ($method === 'DELETE') {
        deleteTask($taskId);
    }
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Route not found']);
}
