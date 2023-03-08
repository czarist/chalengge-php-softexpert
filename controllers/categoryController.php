<?php

namespace controllers;

use models\CategoryModel;

class CategoryController
{

    public function index()
    {
        $categories = CategoryModel::getAll();

        if (!$categories) {
            header('HTTP/1.0 404 Not Found');
            header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
            echo json_encode(['error' => 'Categories not found.']);
            return;
        }

        header('HTTP/1.1 200 OK');
        header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
        echo json_encode($categories);

        return true;
    }

    public function show($id)
    {
        $category = CategoryModel::showById($id);

        if (!$category) {
            header('HTTP/1.0 404 Not Found');
            header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
            echo json_encode(['error' => 'Category not found.']);
            return;
        }

        header('HTTP/1.1 200 OK');
        header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
        echo json_encode($category);

        return true;
    }

    public function store()
    {
        $data = $_POST;
        $now = date('Y-m-d H:i:s');
        $category = new CategoryModel();
        $category->setName($data['name']);
        $category->setDescription($data['description']);
        $category->setCreated($now);
        $category->setModified($now);
        $category->create();

        if (!$category) {
            header('HTTP/1.1 400 Bad Request');
            header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
            echo json_encode(['error' => 'Bad Request.']);
            return;
        }

        header('HTTP/1.1 200 OK');
        header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
        echo json_encode(['message' => 'Category created successfully.']);

        return true;
    }

    public function update($id)
    {
        $data = $_POST;
        $now = date('Y-m-d H:i:s');
        $category = CategoryModel::getById($id);
        $category->setName($data['name']);
        $category->setDescription($data['description']);
        $category->setModified($now);
        $category->update();

        if (!$category) {
            header('HTTP/1.0 404 Not Found');
            header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
            echo json_encode(['error' => 'Category not found.']);
            return;
        }

        header('HTTP/1.1 200 OK');
        header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
        echo json_encode(['message' => 'Category updated successfully.']);

        return true;
    }

    public function destroy($id)
    {
        $category = CategoryModel::getById($id);

        if (!$category) {
            header('HTTP/1.0 404 Not Found');
            header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
            echo json_encode(['error' => 'Category not found.']);
            return;
        }

        $category->delete();

        header('HTTP/1.1 200 OK');
        header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
        echo json_encode(['message' => 'Category deleted successfully.']);

        return true;
    }
}
