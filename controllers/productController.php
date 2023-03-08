<?php

namespace controllers;

use models\productModel;

require_once __DIR__ . '/../models/productModel.php';

class productController
{

    private $productModel;

    public function __construct()
    {
        $this->productModel = new productModel();
    }

    public function index()
    {
        $products = $this->productModel->getProducts();

        if (!$products) {
            header('HTTP/1.0 404 Not Found');
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Products not found.']);
            return;
        }

        header('HTTP/1.1 200 OK');
        header('Content-Type: application/json');
        echo json_encode($products);

        return true;
    }

    public function show($id)
    {
        $product = $this->productModel->getProductById($id);

        if ($product === false) {
            header('HTTP/1.1 404 Not Found');
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Product not found']);
            return;
        }

        header('HTTP/1.1 200 OK');
        header('Content-Type: application/json');
        echo json_encode($product);

        return true;
    }

    public function store()
    {
        $data = $_POST;
        $result = $this->productModel->createProduct($data['name'], $data['description'], $data['price'], $data['category_id'], $data['tax_id']);

        if (!$result) {
            header('HTTP/1.1 400 Bad Request');
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Failed to create product']);

            return;
        }

        header('HTTP/1.1 201 Created');
        header('Content-Type: application/json');
        echo json_encode(['success' => 'Product created']);

        return true;
    }

    public function update($id)
    {
        $data = $_POST;
        $result = $this->productModel->updateProduct($id, $data['name'], $data['description'], $data['price'], $data['category_id'], $data['tax_id']);

        if (!$result) {
            header('HTTP/1.1 400 Bad Request');
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Failed to update product']);

            return;
        }

        header('HTTP/1.1 200 OK');
        header('Content-Type: application/json');
        echo json_encode(['success' => 'Product updated']);

        return true;
    }

    public function destroy($id)
    {
        $result = $this->productModel->deleteProduct($id);

        if (!$result) {
            header('HTTP/1.1 400 Bad Request');
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Failed to delete product']);
            return;
        }

        header('HTTP/1.1 200 OK');
        header('Content-Type: application/json');
        echo json_encode(['success' => 'Product deleted']);

        return true;
    }
}
