<?php
require_once __DIR__ . '/../config/config.php';

class BaseDao {
    protected $connection;
    protected $table_name;

    public function __construct($table_name) {
        $this->table_name = $table_name;
        try {
            $this->connection = new PDO(
                "mysql:host=" . Config::DB_HOST() . ";dbname=" . Config::DB_NAME() . ";port=" . Config::DB_PORT(),
                Config::DB_USER(),
                Config::DB_PASSWORD(),
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch (PDOException $e) {
            throw $e;
        }
    }

    protected function query($query, $params = []) {
        $stmt = $this->connection->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    protected function query_unique($query, $params = []) {
        $results = $this->query($query, $params);
        return reset($results);
    }

    public function getAll() {
        return $this->query("SELECT * FROM " . $this->table_name);
    }

    public function getById($id) {
        return $this->query_unique("SELECT * FROM " . $this->table_name . " WHERE id = :id", ['id' => $id]);
    }

    public function insert($data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_map(fn($col) => ":$col", array_keys($data)));

        $stmt = $this->connection->prepare("INSERT INTO $this->table_name ($columns) VALUES ($placeholders)");
        $stmt->execute($data);
        $data['id'] = $this->connection->lastInsertId();
        return $data;
    }

    public function update($id, $data) {
        $set_clause = implode(", ", array_map(fn($col) => "$col = :$col", array_keys($data)));
        $data['id'] = $id;

        $stmt = $this->connection->prepare("UPDATE $this->table_name SET $set_clause WHERE id = :id");
        $stmt->execute($data);
        return $data;
    }

    public function delete($id) {
        $stmt = $this->connection->prepare("DELETE FROM $this->table_name WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}
