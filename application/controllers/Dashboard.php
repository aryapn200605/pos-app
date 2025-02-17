<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array());
    }

    public function index()
    {
        is_authenticated();
        $this->load->view('page_dashboard/page_dashboard_index', ['title' => 'Dashboard']);
    }
}