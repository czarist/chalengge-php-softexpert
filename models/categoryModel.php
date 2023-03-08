<?php

namespace models;

use config\Database;
use PDO;

class CategoryModel
{

    private $id;
    private $name;
    private $description;
    private $created;
    private $modified;

    private $conn;

    public function __construct($data = [])
    {
        $this->conn = Database::getInstance()->getConnection();

        if (!empty($data)) {
            $this->id = isset($data['id']) ? intval($data['id']) : null;
            $this->name = $data['name'];
            $this->description = $data['description'];
            $this->created = isset($data['created']) ? $data['created'] : date('Y-m-d H:i:s');
            $this->modified = isset($data['modified']) ? $data['modified'] : date('Y-m-d H:i:s');
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function setCreated($created)
    {
        $this->created = $created;
    }

    public function getModified()
    {
        return $this->modified;
    }

    public function setModified($modified)
    {
        $this->modified = $modified;
    }

    public function save()
    {
        if ($this->id) {
            return $this->update();
        } else {
            return $this->create();
        }
    }

    public function create()
    {
        $stmt = $this->conn->prepare('INSERT INTO categories (name, description, created, modified) VALUES (:name, :description, :created, :modified)');
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':created', $this->created);
        $stmt->bindParam(':modified', $this->modified);
        $stmt->execute();
        $this->id = $this->conn->lastInsertId();
    }

    public function update()
    {
        $stmt = $this->conn->prepare('UPDATE categories SET name = :name, description = :description, created = :created, modified = :modified WHERE id = :id');
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':created', $this->created);
        $stmt->bindParam(':modified', $this->modified);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
    }

    public function delete()
    {
        $stmt = $this->conn->prepare('DELETE FROM categories WHERE id = :id');
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
    }

    public static function getById($id)
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare('SELECT * FROM categories WHERE id = :id');
        $stmt->bindParam(':id', $id["id"]);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? new CategoryModel($result) : false;
    }

    public static function showById($id)
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare('SELECT * FROM categories WHERE id = :id');
        $stmt->bindParam(':id', $id["id"]);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result : false;
    }

    public static function getAll()
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare('SELECT * FROM categories');
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $categories = [];
        foreach ($results as $result) {
            $categories[] = new CategoryModel($result);
        }

        $categoryModels = array_map(function ($category) {
            return get_object_vars($category);
        }, $categories);

        return $categoryModels;
    }
}
