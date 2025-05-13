<?php


require_once __DIR__ . '/../Models/Task.php';
require_once __DIR__ . '/../Models/User.php';

class TaskController {

    public static function getTasksByUser($userId) {
        $user = new User($userId);
        $localUser = $user->getById($userId);
        if ($localUser) {
            $task = new Task($user);
            $tasks = $task->getByUser();
            echo json_encode($tasks);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'User not found']);
        }
    }

    public static function createTaskForUser($userId) {
        $input = json_decode(file_get_contents('php://input'), true);

        if (!isset($input['title'], $input['description'], $input['status'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing fields']);
            return;
        }
        $user = new User($userId);
        $userContent = $user->getById();
        if (!$userContent) {
            http_response_code(404);
            echo json_encode(['error' => 'User not found']);
            return;
        }

        $task = new Task($user, $input['title'], $input['description'], $input['status']);
        if ($task->create()) {
            echo json_encode(['message' => 'Task created']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to create task']);
        }
    }

    public static function deleteTask($id) {
        $task = new Task(new User(0), '', '', '', $id);
        if ($task->delete()) {
            echo json_encode(['message' => 'Task deleted']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to delete task']);
        }
    }
}

