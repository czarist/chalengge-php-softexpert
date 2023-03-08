<?php

namespace controllers;

use models\salesModel;

require_once __DIR__ . '/../models/salesModel.php';

class salesController
{

    private $salesModel;

    public function __construct()
    {
        $this->salesModel = new salesModel();
    }

    public function index()
    {
        $sales = $this->salesModel->getSales();

        if (!$sales) {
            header('HTTP/1.0 404 Not Found');
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Sales not found.']);
            return;
        }

        header('HTTP/1.1 200 OK');
        header('Content-Type: application/json');
        echo json_encode($sales);

        return true;
    }

    public function show($id)
    {
        $sale = $this->salesModel->getSaleById($id);

        if ($sale === false) {
            header('HTTP/1.1 404 Not Found');
            header('Content-Type: application/json');
            echo json_encode(['error' => 'sale not found']);
            return;
        }

        header('HTTP/1.1 200 OK');
        header('Content-Type: application/json');
        echo json_encode($sale);

        return true;
    }

    public function store()
    {
        $data = $_POST;
        $result = $this->salesModel->createSales(
            $data['buyer_name'],
            $data['buyer_cpf'],
            $data['items_list'],
            $data['total_value']
        );

        if (!$result) {
            header('HTTP/1.1 400 Bad Request');
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Failed to create sale']);

            return;
        }

        header('HTTP/1.1 201 Created');
        header('Content-Type: application/json');
        echo json_encode(['success' => 'sale created']);

        return true;
    }

    public function destroy($id)
    {
        $result = $this->salesModel->deletesale($id);

        if (!$result) {
            header('HTTP/1.1 400 Bad Request');
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Failed to delete sale']);
            return;
        }

        header('HTTP/1.1 200 OK');
        header('Content-Type: application/json');
        echo json_encode(['success' => 'sale deleted']);

        return true;
    }
}
