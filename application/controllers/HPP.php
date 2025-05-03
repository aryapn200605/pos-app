<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HPP extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('HPPModel'));
    }
    
    public function index()
    {
        is_authenticated();
        $this->load->view('page_hpp/page_hpp_index', ['title' => 'HPP']);
    }
}