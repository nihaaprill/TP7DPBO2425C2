<?php
require_once "./config/Database.php";

class Item {
    private $conn;
    private $table = "item";

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM $this->table ORDER BY id ASC");
        $stmt->execute();
        return $stmt;
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM $this->table WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($name, $type, $stock) {
        $stmt = $this->conn->prepare("INSERT INTO $this->table (name, type, stock) VALUES (?,?,?)");
        return $stmt->execute([$name, $type, $stock]);
    }

    public function update($id, $name, $type, $stock) {
        $stmt = $this->conn->prepare("UPDATE $this->table SET name=?, type=?, stock=? WHERE id=?");
        return $stmt->execute([$name, $type, $stock, $id]);
    }

    public function delete($id) {
    try {
        $stmt = $this->conn->prepare("DELETE FROM $this->table WHERE id=?");
        return $stmt->execute([$id]);
    } catch (PDOException $e) {
        return false; // gagal dihapus
    }
}
}
?>
