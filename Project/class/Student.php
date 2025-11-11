<?php
require_once "./config/Database.php";

class Student {
    private $conn;
    private $table = "student";

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM $this->table");
        $stmt->execute();
        return $stmt;
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM student WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function insert($name, $major) {
        $stmt = $this->conn->prepare("INSERT INTO $this->table (name, major) VALUES (?,?)");
        return $stmt->execute([$name, $major]);
    }

    public function update($id, $name, $major) {
        $stmt = $this->conn->prepare("UPDATE $this->table SET name=?, major=? WHERE id=?");
        return $stmt->execute([$name, $major, $id]);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM $this->table WHERE id=?");
        return $stmt->execute([$id]);
    }
}
?>
