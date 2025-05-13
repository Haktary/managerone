<?php

require_once __DIR__ . '/../Database.php';


class Task {

    private int $id;
    private User $user;
    private string $title;
    private string $description;
    private string $status;
    private string $creationDate;

    public function __construct(User $user, string $title = '', string $description = '', string $status = '', int $id = 0, string $creationDate = '') {
        $this->id = $id;
        $this->user = $user;
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
        $this->creationDate = $creationDate ?: date('Y-m-d H:i:s');
    }

    public function getId(): int {
        return $this->id;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function getCreationDate(): string {
        return $this->creationDate;
    }

    public function getUser(): User {
        return $this->user;
    }

    public function get(): ?array {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM tasks WHERE id = ?");
        $stmt->execute([$this->id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByUser(): ?array {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM tasks WHERE user_id = ?");
        $stmt->execute([$this->user->getId()]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(): bool {
        $db = Database::getInstance();
        $stmt = $db->prepare('INSERT INTO tasks (user_id, title, description, creation_date, status) VALUES (?, ?, ?, ?, ?)');
        return $stmt->execute([$this->user->getId(), $this->title, $this->description, $this->creationDate, $this->status]);
    }

    public function delete(): bool {
        $db = Database::getInstance();
        $stmt = $db->prepare("DELETE FROM tasks WHERE id = ?");
        $stmt->execute([$this->id]);
        return $stmt->rowCount() > 0;
    }
}

