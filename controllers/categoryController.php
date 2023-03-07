<?php

namespace controllers;

use models\CategoryModel;

require_once __DIR__ . '/../models/categoryModel.php';

class CategoryController
{

    public function index()
    {
        $categories = CategoryModel::getAll();

        echo json_encode($categories);
    }

    public function show($id)
    {
        $category = CategoryModel::showById($id);

        if (!$category) {
            header('HTTP/1.0 404 Not Found');
            echo json_encode(['error' => 'Category not found.']);
            return;
        }

        echo json_encode($category);
    }

    public function store()
    {
        $data = $_POST;

        $category = new CategoryModel();
        $category->setName($data['name']);
        $category->setDescription($data['description']);
        $category->setCreated(date('Y-m-d H:i:s'));
        $category->setModified(date('Y-m-d H:i:s'));

        $category->create();

        echo json_encode($category);
    }

    public function update($id)
    {
        $data = $_POST;
        $category = CategoryModel::getById($id);
        $category->setName($data['name']);
        $category->setDescription($data['description']);
        $category->setModified(date('Y-m-d H:i:s'));
        $category->update();

        if (!$category) {
            header('HTTP/1.0 404 Not Found');
            echo json_encode(['error' => 'Category not found.']);
            return;
        }

        echo json_encode(['message' => 'Category updated successfully.']);
    }

    public function destroy($id)
    {
        $category = CategoryModel::getById($id);

        if (!$category) {
            header('HTTP/1.0 404 Not Found');
            echo json_encode(['error' => 'Category not found.']);
            return;
        }

        $category->delete();

        echo json_encode(['message' => 'Category deleted successfully.']);
    }
}
