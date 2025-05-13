<?php

require_once __DIR__ . '/../Models/User.php';


class UserController {

    static function getUser($id) {
        $user = new User($id);
        $userContent = $user->getById();

        if ($userContent) {
            echo json_encode($userContent);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'User not found']);
        }
    }
}



