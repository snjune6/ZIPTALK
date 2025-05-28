<?php
namespace src\config;

class database
{
    private $conn;

    public function __construct()
    {
        $this->conn = new \mysqli('localhost', 'snjune6', 'aaddr1043!!', 'snjune6');
        if ($this->conn->connect_error) {
            throw new \Exception('Database connection failed: ' . $this->conn->connect_error);
        }
        $this->conn->set_charset('utf8mb4');
    }

    public function executeSingle($sql, $params = [], $types = '')
    {
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) throw new \Exception('Prepare failed: ' . $this->conn->error);

        if (!empty($params)) {
            $values = array_values($params);
            $stmt->bind_param($types, ...$values);
        }

        if (!$stmt->execute()) {
            $stmt->close();
            throw new \Exception('Execute failed: ' . $stmt->error);
        }

        $result = $stmt->get_result();
        if ($result === false) {
            $stmt->close();
            return null;
        }

        $row = $result->fetch_assoc();
        $result->free();
        $stmt->close();
        return $row ?: null;
    }

    public function executeMultiple($sql, $params = [], $types = '')
    {
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) throw new \Exception('Prepare failed: ' . $this->conn->error);

        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }

        if (!$stmt->execute()) {
            $stmt->close();
            throw new \Exception('Execute failed: ' . $stmt->error);
        }

        $result = $stmt->get_result();
        if ($result === false) {
            $stmt->close();
            return [];
        }

        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        $result->free();
        $stmt->close();
        return $rows;
    }

    public function close()
    {
        if ($this->conn) {
            $this->conn->close();
            $this->conn = null;
        }
    }

    public function __destruct()
    {
        $this->close();
    }
}
?>
