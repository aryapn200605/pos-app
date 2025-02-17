<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserModel extends CI_Model
{
    public function findUser($username)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('username', $username);
    
        $user = $this->db->get();
    
        // Periksa apakah user ditemukan
        if ($user->num_rows() === 0) {
            return [
                'result'  => false,
                'message' => 'User not found.'
            ];
        }
    
        return [
            'result'  => true,
            'message' => 'User found successfully.',
            'data'    => $user->result()
        ];
    }

    public function getCashierUsers()
    {
        $datas = $this->db->select('*')
                ->from('users')
                ->where('level', 3)
                ->get()->result();

        return $datas;
    }
    
    // public function createUser($name, $username, $password)
    // {
    //     $this->db->where('username', $username);
    //     $user = $this->db->get('users');
    
    //     if ($user->num_rows() > 0) {
    //         return array(
    //             'result'    => false,
    //             'message'   => 'Username already exists'
    //         );
    //     }
    
    //     $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    
    //     $this->db->set('id', 'UUID()', FALSE);
    //     $this->db->set('name', $name);
    //     $this->db->set('username', $username);
    //     $this->db->set('password', $hashedPassword);
    //     $result = $this->db->insert('users');
    
    //     if ($result) {
    //         return array(
    //             'result'    => true,
    //             'message'   => 'User created successfully',
    //             'data'      => $data
    //         );
    //     } else {
    //         return array(
    //             'result'    => false,
    //             'message'   => 'Failed to create user'
    //         );
    //     }
    // }
    
}
