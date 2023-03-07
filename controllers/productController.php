<?php

use productModel;
class productController
{

    private $productModel;

    public function __construct()
    {
        $this->productModel = new productModel();
    }

    public function getAllProducts()
    {
        $products = $this->productModel->getProducts();
        header('Content-Type: application/json');
        echo json_encode($products);
    }

    public function getProductById($id)
    {
        $product = $this->productModel->getProductById($id);
        if ($product) {
            header('Content-Type: application/json');
            echo json_encode($product);
        } else {
            header('HTTP/1.1 404 Not Found');
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Product not found']);
        }
    }

    public function createProduct()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $result = $this->productModel->createProduct($data['name'], $data['description'], $data['price'], $data['category_id'], $data['tax_id']);
        if ($result) {
            header('HTTP/1.1 201 Created');
            header('Content-Type: application/json');
            echo json_encode(['success' => 'Product created']);
        } else {
            header('HTTP/1.1 400 Bad Request');
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Failed to create product']);
        }
    }

    public function updateProduct($id)
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $result = $this->productModel->updateProduct($id, $data['name'], $data['description'], $data['price'], $data['category_id'], $data['tax_id']);
        if ($result) {
            header('HTTP/1.1 200 OK');
            header('Content-Type: application/json');
            echo json_encode(['success' => 'Product updated']);
        } else {
            header('HTTP/1.1 400 Bad Request');
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Failed to update product']);
        }
    }

    public function deleteProduct($id)
    {
        $result = $this->productModel->deleteProduct($id);
        if ($result) {
            header('HTTP/1.1 200 OK');
            header('Content-Type: application/json');
            echo json_encode(['success' => 'Product deleted']);
        } else {
            header('HTTP/1.1 400 Bad Request');
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Failed to delete product']);
        }
    }
}
