<?php
header('Content-Type: application/json');

require_once __DIR__ . '/src/Controllers/UserController.php';
require_once __DIR__ . '/src/Controllers/TaskController.php';

$uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
$method = $_SERVER['REQUEST_METHOD'];

try {
    switch ($uri[0] ?? '') {

        case 'user':
            if (!isset($uri[1]) || !is_numeric($uri[1])) {
                http_response_code(400);
                echo json_encode(['error' => 'Invalid or missing user ID']);
                break;
            }

            $userId = (int)$uri[1];

            switch ($uri[2] ?? '') {
                case '':
                    if ($method === 'GET') {
                        UserController::getUser($userId);
                    } else {
                        http_response_code(405);
                        echo json_encode(['error' => 'Method not allowed']);
                    }
                    break;

                case 'tasks':
                    if ($method === 'GET') {
                        TaskController::getTasksByUser($userId);
                    } elseif ($method === 'POST') {
                        TaskController::createTaskForUser($userId);
                    } else {
                        http_response_code(405);
                        echo json_encode(['error' => 'Method not allowed']);
                    }
                    break;

                default:
                    http_response_code(404);
                    echo json_encode(['error' => 'Invalid user route']);
            }
            break;

        case 'task':
            if (!isset($uri[1]) || !is_numeric($uri[1])) {
                http_response_code(400);
                echo json_encode(['error' => 'Invalid or missing task ID']);
                break;
            }

            $taskId = (int)$uri[1];

            if ($method === 'GET') {
                TaskController::getTask($taskId);
            } elseif ($method === 'DELETE') {
                TaskController::deleteTask($taskId);
            } else {
                http_response_code(405);
                echo json_encode(['error' => 'Method not allowed']);
            }
            break;

        default:
            http_response_code(404);
            echo json_encode(['error' => 'Route not found']);
    }

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
