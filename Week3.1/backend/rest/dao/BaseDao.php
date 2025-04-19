<?php
require_once __DIR__ . '/../config.php';

class BaseDao {
    protected $table;
    protected $connection;

    // CONSTRUCTOR
    public function __construct($table) {
        $this->table = $table;
        $this->connection = Database::connect(); // from config.php - we use it in `require_once`
    }

    // Get All
    public function getAll() {
        $stmt = $this->connection->prepare("SELECT * FROM ".$this->table);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Get By Id
    public function getById($id) {
        $stmt = $this->connection->prepare("SELECT * FROM".$this->table."WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Insert
    public function insert($data) {
        $columns = implode(", ",array_keys($data));
        
    }
}


?>