<?php
// database.php - Database connection class

class Database
{
    private $host = DB_HOST;
    private $db_name = DB_NAME;
    private $username = DB_USER;
    private $password = DB_PASS;
    public $conn;

    // Get database connection
    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $exception) {
            error_log("Connection error: " . $exception->getMessage());
            throw new Exception("Database connection failed. Please try again later.");
        }

        return $this->conn;
    }

    // Execute query with parameters
    public function executeQuery($query, $params = [])
    {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            error_log("Query error: " . $e->getMessage() . " Query: " . $query);
            throw new Exception("Database query failed.");
        }
    }

    // Begin transaction
    public function beginTransaction()
    {
        return $this->conn->beginTransaction();
    }

    // Commit transaction
    public function commit()
    {
        return $this->conn->commit();
    }

    // Rollback transaction
    public function rollBack()
    {
        return $this->conn->rollBack();
    }

    // Get last insert ID
    public function lastInsertId()
    {
        return $this->conn->lastInsertId();
    }
}
?>