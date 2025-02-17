<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PaymentMethod extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('PaymentMethodModel'));
    }

    public function getAllPaymentMethod()
    {
        $data = $this->PaymentMethodModel->findAll();

        if ($data) {
            echo json_encode(array('result' => true, 'message' => 'Data find successfully', 'data' => $data));
        } else {
            echo json_encode(array('result' => false, 'message' => 'Error while retrive data'));
        }
    }

    public function addPaymentMethod()
    {
        $name = $this->input->post('name');

        $add = $this->PaymentMethodModel->insertData($name);
        
        if ($add) {
            echo json_encode(array('result' => true, 'message' => 'Payment Method Created Successfully'));
        } else {
            echo json_encode(array('result' => false, 'message' => 'Error while Created Payment Method'));
        }
    }

    public function editPaymentMethod()
    {
        $name = $this->input->post('name');
        $id = $this->input->post('id');

        $edit = $this->PaymentMethodModel->updateData($id, $name);
        
        if ($edit) {
            echo json_encode(array('result' => true, 'message' => 'Payment Method Created Successfully'));
        } else {
            echo json_encode(array('result' => false, 'message' => 'Error while Created Payment Method'));
        }
    }
}