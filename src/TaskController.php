<?php
function getTasksByUser($userId) {
    global $db;
    $stmt = $db->prepare('SELECT * FROM tasks WHERE user_id = ?');
    $stmt->execute([$userId]);
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
}

function getTask($id) {
    global $db;
    $stmt = $db->prepare('SELECT * FROM tasks WHERE id = ?');
    $stmt->execute([$id]);
    echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
}

function createTaskForUser($userId) {
    global $db;
    $input = json_decode(file_get_contents('php://input'), true);
    $stmt = $db->prepare('INSERT INTO tasks (user_id, title, description, creation_date, status) VALUES (?, ?, ?, datetime("now"), ?)');
    $stmt->execute([$userId, $input['title'], $input['description'], $input['status']]);
    echo json_encode(['message' => 'Task created']);
}

function deleteTask($id) {
    global $db;
    $stmt = $db->prepare('DELETE FROM tasks WHERE id = ?');
    $stmt->execute([$id]);
    echo json_encode(['message' => 'Task deleted']);
}
