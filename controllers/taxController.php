<?php

namespace controllers;

use models\TaxModel;

require_once __DIR__ . '/../models/taxModel.php';

class TaxController
{
    private $taxModel;

    public function __construct()
    {
        $this->taxModel = new TaxModel();
    }

    public function index()
    {
        $taxes = $this->taxModel->getAllTaxes();

        if (!$taxes) {
            header('HTTP/1.0 404 Not Found');
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Taxes not found.']);

            return;
        }

        header('HTTP/1.1 200 OK');
        header('Content-Type: application/json');
        echo json_encode($taxes);

        return true;
    }

    public function show($id)
    {
        $tax = $this->taxModel->getTaxById($id);

        if (!$tax) {
            header('HTTP/1.0 404 Not Found');
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Tax not found.']);

            return;
        }

        header('HTTP/1.1 200 OK');
        header('Content-Type: application/json');
        echo json_encode($tax);

        return true;
    }

    public function store()
    {
        $data = $_POST;
        $name = $data['name'];
        $rate = $data['rate'];
        $tax = $this->taxModel->createTax($name, $rate);

        if (!$tax) {
            header('HTTP/1.1 400 Bad Request');
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Bad Request.']);

            return;
        }
        header('HTTP/1.1 200 OK');
        header('Content-Type: application/json');
        echo json_encode(['message' => 'Tax created successfully.']);

        return true;
    }

    public function update($id)
    {
        $data = $_POST;
        $name = $data['name'];
        $rate = $data['rate'];

        $tax = $this->taxModel->updateTax($id, $name, $rate);

        if (!$tax) {
            header('HTTP/1.0 404 Not Found');
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Tax not found.']);

            return;
        }

        header('HTTP/1.1 200 OK');
        header('Content-Type: application/json');
        echo json_encode(['message' => 'Tax updated successfully.']);

        return true;
    }

    public function destroy($id)
    {
        $result = $this->taxModel->deleteTax($id);

        if (!$result) {
            header('HTTP/1.0 404 Not Found');
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Tax not found.']);

            return;
        }

        header('HTTP/1.1 200 OK');
        header('Content-Type: application/json');
        echo json_encode(['message' => 'Tax deleted successfully.']);

        return true;
    }
}
