<?php
// db_class.php — Simple PDO wrapper that your models can extend/use.
require_once __DIR__ . '/db_cred.php';

class Db {
    /** @var PDO */
    protected $db;

    public function __construct() {
        $dsn = sprintf(
            'mysql:host=%s;port=%d;dbname=%s;charset=%s',
            DB_HOST, DB_PORT, DB_NAME, DB_CHARSET
        );

        $opts = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // throw on errors
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // assoc arrays
            PDO::ATTR_EMULATE_PREPARES   => false,                  // native prepares
            PDO::ATTR_PERSISTENT         => false,                  // dev-safe
        ];

        try {
            $this->db = new PDO($dsn, DB_USER, DB_PASS, $opts);
        } catch (PDOException $e) {
            // In production, log $e->getMessage()
            exit('Database connection failed.');
        }
    }

    // Optional transaction helpers
    public function begin(): void   { $this->db->beginTransaction(); }
    public function commit(): void  { $this->db->commit(); }
    public function rollback(): void{
        if ($this->db->inTransaction()) { $this->db->rollBack(); }
    }

    // If you ever need raw PDO
    public function pdo(): PDO { return $this->db; }
}
