<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array());
    }

    public function index()
    {
        is_authenticated();
        if ($this->session->user_id) {
            $this->load->view('page_app/page_app_index');
        } else {
            redirect('Auth');
        }
    }

    public function home()
    {
        is_authenticated();
        $this->load->view('page_home/page_home_index', ['title' => 'Home']);
    }

    public function return0() {
        echo 0;
    }
}