<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cashier extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('TransactionModel'));
    }
    
    public function index()
    {
        is_authenticated();
        $this->load->view('page_cashier/page_cashier_index', ['title' => 'Cashier']);
    }

    public function addTransaction()
    {
        is_authenticated();
        $request = $this->input->post();

        $createTransaction = $this->TransactionModel->createTransaction($request);

        if ($createTransaction) {
            echo json_encode(['result' => true, 'message' => 'Transaction created successfully', 'data' => $createTransaction]);
        } else {
            echo json_encode(['result' => false, 'message' => 'Error while creating transaction']);
        }
    }
}