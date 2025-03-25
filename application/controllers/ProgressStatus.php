<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProgressStatus extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('ProgressStatusModel'));
    }

    public function getAllProgressStatus()
    {
        $data = $this->ProgressStatusModel->findAll();

        if ($data) {
            echo json_encode(array('result' => true, 'message' => 'Data find successfully', 'data' => $data));
        } else {
            echo json_encode(array('result' => false, 'message' => 'Error while retrive data'));
        }
    }

    public function addProgressStatus()
    {
        $name = $this->input->post('name');

        $add = $this->ProgressStatusModel->insertData($name);
        
        if ($add) {
            echo json_encode(array('result' => true, 'message' => 'Payment Method Created Successfully'));
        } else {
            echo json_encode(array('result' => false, 'message' => 'Error while Created Payment Method'));
        }
    }

    public function editProgressStatus()
    {
        $name = $this->input->post('name');
        $id = $this->input->post('id');

        $edit = $this->ProgressStatusModel->updateData($id, $name);
        
        if ($edit) {
            echo json_encode(array('result' => true, 'message' => 'Payment Method Created Successfully'));
        } else {
            echo json_encode(array('result' => false, 'message' => 'Error while Created Payment Method'));
        }
    }

    public function changeStatus()
    {
        $param = $this->input->post();

        $result = $this->ProgressStatusModel->changeStatus($param['tb_id'], $param['status']);

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Success']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed']);
        }
    }
}