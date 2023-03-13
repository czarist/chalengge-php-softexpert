<?php

namespace models;

use config\Database;
use models\TaxModel;

use PDO;

class productModel
{

    private $db;
    private $taxModel;

    private function add_percentage($value, $percentage)
    {
        $percentage_value = $value * ($percentage / 100);
        $total_value = $value + $percentage_value;
        return $total_value;
    }


    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
        $this->taxModel = new TaxModel();
    }

    public function getProducts()
    {
        $stmt = $this->db->prepare("SELECT * FROM products");
        $taxes = $this->taxModel->getAllTaxes();

        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        for ($i = 0; $i < count($products); $i++) {
            $products[$i]["price_with_no_taxes"] = $products[$i]["price"];
        }

        foreach ($taxes as $tax) {
            for ($i = 0; $i < count($products); $i++) {
                if ($products[$i]['tax_id'] == $tax['id']) {
                    $taxed_value = $this->add_percentage($products[$i]['price'], $tax['rate']);
                    $products[$i]['price'] = $taxed_value;
                    $products[$i]['price'] = number_format($products[$i]['price'], 2, '.', '');
                    $products[$i]['price_with_no_taxes'] = number_format($products[$i]['price_with_no_taxes'], 2, '.', '');
                };
            }
        }

        return $products;
    }

    public function getProductById($id)
    {
        $query = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id['id']);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result : false;
    }

    public function createProduct($name, $description, $price, $category_id, $tax_id, string $img)
    {
        $now = date('Y-m-d H:i:s');
        $stmt = $this->db->prepare("INSERT INTO products (name, description, price, category_id, tax_id, img, created, modified) VALUES (:name, :description, :price, :category_id, :tax_id, :img, :created, :modified)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':tax_id', $tax_id);
        $stmt->bindParam(':img', $img);
        $stmt->bindParam(':created', $now);
        $stmt->bindParam(':modified', $now);
        $stmt->execute();
        return true;
    }

    public function updateProduct($id, $name, $description, $price, $category_id, $tax_id, $img)
    {
        $now = date('Y-m-d H:i:s');
        $stmt = $this->db->prepare("UPDATE products SET name = :name, description = :description, price = :price, category_id = :category_id, img = :img, modified = :modified, tax_id = :tax_id WHERE id = :id");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':tax_id', $tax_id);
        $stmt->bindParam(':img', $img);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':modified', $now);
        $stmt->execute();
        return true;
    }

    public function deleteProduct($id)
    {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = ?");
        $stmt->execute([$id['id']]);
        return true;
    }
}
