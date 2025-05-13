<?php

require_once __DIR__ . '/../Database.php';

class User {

    private int $id;
    private string $name;
    private string $email;

    public function __construct(int $id, string $name = '', string $email = '') {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getById(): ?array {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
         $stmt->execute([$this->id]);
         $result = $stmt->fetch(PDO::FETCH_ASSOC);
         return $result === false ? null : $result;
    }
}