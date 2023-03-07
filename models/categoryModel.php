<?php

use Database;

class CategoryModel
{

    private $id;
    private $name;
    private $description;
    private $created;
    private $modified;

    public function __construct($data = [])
    {
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

    public function getModified()
    {
        return $this->modified;
    }

    public function save()
    {
        if ($this->id) {
            return $this->update();
        } else {
            return $this->create();
        }
    }

    private function create()
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare('INSERT INTO categories (name, description, created, modified) VALUES (:name, :description, :created, :modified)');
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':created', $this->created);
        $stmt->bindParam(':modified', $this->modified);
        $stmt->execute();
        $this->id = $db->lastInsertId();
        return $this;
    }

    private function update()
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare('UPDATE categories SET name = :name, description = :description, modified = :modified WHERE id = :id');
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':modified', $this->modified);
        $stmt->execute();
        return $this;
    }

    public function delete()
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare('DELETE FROM categories WHERE id = :id');
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
    }

    public static function getById($id)
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare('SELECT * FROM categories WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? new CategoryModel($result) : null;
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
        return $categories;
    }
}
