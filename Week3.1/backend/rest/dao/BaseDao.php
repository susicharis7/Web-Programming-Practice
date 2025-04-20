<?php
require_once __DIR__ . '/../config.php';

class BaseDao {
    public function __construct($table) {
        $this->table = $table;
        $this->connection = Database::connect();
    }

    // (R)ead
    public function getAll() {
        $stmt = $this->connection->prepare("SELECT * FROM ". $this->table);
        $stmt->execute(); // it sends to a SERVER and Executes it
        return $stmt->fetchAll(); // returns all values as associate array (PDO::FETCH_ASSOC from config.php)
    }

    // (R)ead also
    public function get_by_id($id) {
        $stmt = $this->connection->prepare("SELECT * FROM " . $this->table . " WHERE id = :id");
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        return $stmt->fetch();
    }

    // (C)reate 
    public function insert($data) {
        $columns = implode(", ", array_keys($data)); // spaja sve elemente iz array u jedan string, sa seperatorom
        $placeholders = ":".implode(", :", array_keys($data));
        $sql = "INSERT INTO " . $this->table . " ($columns) VALUES ($placeholders)";
        $stmt = this->connection->prepare($sql);
        return $stmt->execute($data);
        }
}