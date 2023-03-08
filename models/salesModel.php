<?php

namespace models;

use config\Database;
use PDO;

class salesModel
{

    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getSales()
    {
        $stmt = $this->db->prepare("SELECT * FROM sales");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSaleById($id)
    {
        $query = "SELECT * FROM sales WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id['id']);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result : false;
    }

    public function createSales($buyer_name, $buyer_cpf, $items_list, $total_value)
    {
        $now = date('Y-m-d H:i:s');
        $stmt = $this->db->prepare("INSERT INTO sales (buyer_name, buyer_cpf, items_list, total_value, purchase_date) VALUES (:buyer_name, :buyer_cpf, :items_list, :total_value, :purchase_date)");
        $stmt->bindParam(':buyer_name', $buyer_name);
        $stmt->bindParam(':buyer_cpf', $buyer_cpf);
        $stmt->bindParam(':items_list', $items_list);
        $stmt->bindParam(':total_value', $total_value);
        $stmt->bindParam(':purchase_date', $now);
        $stmt->execute();
        return true;
    }

    public function deleteSale($id)
    {
        $stmt = $this->db->prepare("DELETE FROM sales WHERE id = ?");
        $stmt->execute([$id['id']]);
        return true;
    }
}
