<?php
function getUser($id) {
    global $db;
    $stmt = $db->prepare('SELECT * FROM users WHERE id = ?');
    $stmt->execute([$id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($user ?: ['error' => 'User not found']);
}
