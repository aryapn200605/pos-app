<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('UserModel'));
    }

    public function index()
    {
        if ($this->session->user_id) {
            redirect('App');
        } else {
            $this->load->view('page_login/page_login_index');
        }
    }

    public function signIn()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if (empty($username) || empty($password)) {
            echo json_encode([
                'result'  => false,
                'message' => 'Username and password are required.'
            ]);
            return;
        }

        $findUser = $this->UserModel->findUser($username);

        if (!$findUser['result']) {
            echo json_encode([
                'result'  => false,
                'message' => $findUser['message']
            ]);
            return;
        }

        $userData = $findUser['data'][0]; // Ambil data user pertama
        if (!password_verify($password, $userData->password)) {
            echo json_encode([
                'result'  => false,
                'message' => 'Wrong password.'
            ]);
            return;
        }

        $this->session->set_userdata([
            'user_id' => $userData->id,
            'name'    => $userData->name
        ]);

        echo json_encode([
            'result'  => true,
            'message' => 'User logged in successfully.'
        ]);
    }

    // public function signUp()
    // {
    //     $name = $this->input->post['name'];
    //     $username = $this->input->post['username'];
    //     $password = $this->input->post['password'];

    //     $data = $this->UserModel->createUser($name, $username, $password);

    //     return $data;
    // }

    public function logout()
    {
        is_authenticated();
        $this->session->sess_destroy();

        redirect('Auth');
    }
}
