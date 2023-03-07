<?php

use Database;

class TaxModel
{
    private $conn;

    public function __construct()
    {
        $db = Database::getInstance();
        $this->conn = $db->getConnection();
    }

    public function getAllTaxes()
    {
        $query = "SELECT * FROM taxes";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTaxById($id)
    {
        $query = "SELECT * FROM taxes WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createTax($name, $percentage)
    {
        $query = "INSERT INTO taxes (name, percentage) VALUES (:name, :percentage)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':percentage', $percentage);
        $stmt->execute();

        return $this->getTaxById($this->conn->lastInsertId());
    }

    public function updateTax($id, $name, $percentage)
    {
        $query = "UPDATE taxes SET name = :name, percentage = :percentage WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':percentage', $percentage);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $this->getTaxById($id);
    }

    public function deleteTax($id)
    {
        $query = "DELETE FROM taxes WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return true;
    }
}
