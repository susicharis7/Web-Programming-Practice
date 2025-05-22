<?php
require_once __DIR__ . '/../config/Config.php';

class BaseDao {
    protected $connection;
    private $table_name;

    public function __construct($table_name) {
        $this->table_name = $table_name; 

        try {
            $this->connection = new PDO(
                "mysql:host=".Config::DB_HOST().";dbname=".Config::DB_NAME().";port=".Config::DB_PORT(),
                Config::DB_USER(),
                Config::DB_PASSWORD(),
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
                );
        } catch(PDOException $e) {
            throw $e;
        }

    }

    protected function query($query, $params) {
        $stmt = $this->connection->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    protected function query_unique($query, $params) {
        $results = $this->query($query,$params);
        return reset($results);
    }

}

