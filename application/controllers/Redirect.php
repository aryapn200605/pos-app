<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Redirect extends CI_Controller {

    public function index()
    {
        redirect('Auth', 'refresh');
    }
}
