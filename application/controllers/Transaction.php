<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('TransactionModel'));
    }

    public function index()
    {
        is_authenticated();

        $this->load->view('page_transaction/page_transaction_index', ['title' => 'Transaction', 'data' => '']);
    }

    public function getTransaction()
    {
        $datas = $this->TransactionModel->getTransactionData();

        echo json_encode($datas);
    }

    public function getDetail()
    {
        $id  = $this->input->get('tb_id');

        $datas = $this->TransactionModel->getTransactionData($id);

        $this->load->view('page_transaction/page_transaction_detail', ['title' => 'Transaction Detail', 'datas' => $datas['data'][0]]);
    }

    public function showPdf()
    {
        $id = $this->input->get('tb_id');

        $datas = $this->TransactionModel->getTransactionData($id);

        $this->load->view('page_transaction/page_transaction_pdf', ['title' => 'Transaction Detail', 'datas' => $datas['data'][0]]);
    }

    public function deleteTransaction()
    {
        $result = $this->TransactionModel->deleteTransaction();

        echo json_encode($result);
    }
}