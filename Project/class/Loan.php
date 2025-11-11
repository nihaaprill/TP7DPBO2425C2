<?php
require_once "./config/Database.php";

class Loan {
    private $conn;
    private $table = "loan";

    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getAll() {
        $query = "SELECT loan.id, item.name AS item, student.name AS student, loan.loan_date
                  FROM loan
                  INNER JOIN item ON loan.id_item = item.id
                  INNER JOIN student ON loan.id_student = student.id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM loan WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($id_item, $id_student, $loan_date) {
        $stmt = $this->conn->prepare("INSERT INTO $this->table (id_item, id_student, loan_date) VALUES (?,?,?)");
        return $stmt->execute([$id_item, $id_student, $loan_date]);
    }

    public function update($id, $id_item, $id_student, $loan_date) {
    $stmt = $this->conn->prepare(
        "UPDATE loan SET id_item=?, id_student=?, loan_date=? WHERE id=?"
    );
    return $stmt->execute([$id_item, $id_student, $loan_date, $id]);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM $this->table WHERE id=?");
        return $stmt->execute([$id]);
    }
}
?>
