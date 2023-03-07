<?php

use TaxModel;

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
        return json_encode($taxes);
    }

    public function show($id)
    {
        $tax = $this->taxModel->getTaxById($id);
        return json_encode($tax);
    }

    public function store($name, $percentage)
    {
        $tax = $this->taxModel->createTax($name, $percentage);
        return json_encode($tax);
    }

    public function update($id, $name, $percentage)
    {
        $tax = $this->taxModel->updateTax($id, $name, $percentage);
        return json_encode($tax);
    }

    public function delete($id)
    {
        $result = $this->taxModel->deleteTax($id);
        return json_encode($result);
    }
}
