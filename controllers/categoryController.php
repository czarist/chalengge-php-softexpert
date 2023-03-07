<?php

use CategoryModel;

class CategoryController
{

    public function index()
    {
        $categories = CategoryModel::getAll();
        return json_encode($categories);
    }

    public function show($id)
    {
        $category = CategoryModel::getById($id);
        return json_encode($category);
    }

    public function create()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $category = new CategoryModel($data);
        $category->save();
        return json_encode($category);
    }

    public function update($id)
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $category = CategoryModel::getById($id);
        $category->setName($data['name']);
        $category->setDescription($data['description']);
        $category->save();
        return json_encode($category);
    }

    public function delete($id)
    {
        $category = CategoryModel::getById($id);
        $category->delete();
        return json_encode(['message' => 'Category deleted successfully.']);
    }
}
