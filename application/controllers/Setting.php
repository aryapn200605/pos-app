<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('PaymentMethodModel'));
    }

    public function index()
    {
        is_authenticated();
        $this->load->view('page_setting/page_setting_index', ['title' => 'Setting']);
    }
}