<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('UserModel'));
    }

    public function getAllCashier()
    {
        $data = $this->UserModel->getCashierUsers();

        if ($data) {
            echo json_encode(array('result' => true, 'message' => 'Data find successfully', 'data' => $data));
        } else {
            echo json_encode(array('result' => false, 'message' => 'Error while retrive data'));
        }
    }

    // public function addUsers()
    // {
    //     $name = $this->input->post('name');

    //     $add = $this->UserModel->insertData($name);
        
    //     if ($add) {
    //         echo json_encode(array('result' => true, 'message' => 'Payment Method Created Successfully'));
    //     } else {
    //         echo json_encode(array('result' => false, 'message' => 'Error while Created Payment Method'));
    //     }
    // }

    // public function editUsers()
    // {
    //     $name = $this->input->post('name');
    //     $id = $this->input->post('id');

    //     $edit = $this->UserModel->updateData($id, $name);
        
    //     if ($edit) {
    //         echo json_encode(array('result' => true, 'message' => 'Payment Method Created Successfully'));
    //     } else {
    //         echo json_encode(array('result' => false, 'message' => 'Error while Created Payment Method'));
    //     }
    // }
}