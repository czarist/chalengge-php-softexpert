<?php

namespace models;

use config\Database;
use PDO;

class productModel
{

    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getProducts()
    {
        $stmt = $this->db->prepare("SELECT * FROM products");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id['id']]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createProduct($name, $description, $price, $category_id, $tax_id)
    {
        $now = date('Y-m-d H:i:s');
        $stmt = $this->db->prepare("INSERT INTO products (name, description, price, category_id, tax_id, created, modified) VALUES (:name, :description, :price, :category_id, :tax_id, :created, :modified)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':tax_id', $tax_id);
        $stmt->bindParam(':created', $now);
        $stmt->bindParam(':modified', $now);
        $stmt->execute();
    }

    public function updateProduct($id, $name, $description, $price, $category_id, $tax_id)
    {
        $stmt = $this->db->prepare("UPDATE products SET name = ?, description = ?, price = ?, category_id = ?, tax_id = ? WHERE id = ?");
        return $stmt->execute([$name, $description, $price, $category_id, $tax_id, $id['id']]);
    }

    public function deleteProduct($id)
    {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = ?");
        return $stmt->execute([$id['id']]);
    }
}
