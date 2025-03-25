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

        $this->load->view('page_transaction/page_transaction_print', ['title' => 'Transaction Detail', 'datas' => $datas['data'][0]]);
    }
    
    public function print()
    {
        $id = $this->input->get('tb_id');
        
        $datas = $this->TransactionModel->getTransactionData($id);
        
        $this->load->view('page_transaction/page_transaction_print', ['title' => 'Transaction Detail', 'datas' => $datas['data'][0]]);
    }

    public function deleteTransaction()
    {
        $result = $this->TransactionModel->deleteTransaction();

        echo json_encode($result);
    }

    public function addPayment()
    {
        $param = $this->input->post();

        $invoiceData = array(
            'paid_amount'       => $param['amount'],
            'payment_method'    => $param['payment_method'],
            'status'            => 0,
            'created_at'        => date('Y-m-d H:i:s'),
            'created_by'        => $this->session->user_id
        );

        $result = $this->TransactionModel->createInvoice($param['tb_id'], $invoiceData);

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Success']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed']);
        }
    }
}