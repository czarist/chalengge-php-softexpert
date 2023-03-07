<?php

namespace models;

use config\Database;
use PDO;

class TaxModel
{
    private $conn;
    private $id;

    public function __construct()
    {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAllTaxes()
    {

        $query = "SELECT * FROM tax";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getTaxById($id)
    {
        $query = "SELECT * FROM tax WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id['id']);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createTax($name, $rate)
    {
        $now = date('Y-m-d H:i:s');
        $query = "INSERT INTO tax (name, rate, created, modified) VALUES (:name, :rate, :created, :modified)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':rate', $rate);
        $stmt->bindParam(':created', $now);
        $stmt->bindParam(':modified', $now);
        $stmt->execute();
        $this->id = $this->conn->lastInsertId();

        return true;
    }

    public function updateTax($id, $name, $percentage)
    {
        $now = date('Y-m-d H:i:s');
        $query = "UPDATE tax SET name = :name, rate = :rate, modified = :modified WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':rate', $percentage);
        $stmt->bindParam(':modified', $now);
        $stmt->bindParam(':id', $id['id']);
        $stmt->execute();

        return true;
    }

    public function deleteTax($id)
    {
        $query = "DELETE FROM tax WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id['id']);
        $stmt->execute();

        return true;
    }
}
