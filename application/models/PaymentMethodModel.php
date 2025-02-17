<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PaymentMethodModel extends CI_Model
{
    public function findAll()
    {
        $datas = $this->db->select("*")
            ->from("payment_method")
            ->where('is_deleted', 0)
            ->get()->result();

        // if ($datas) {

        // }
        return $datas;
    }

    public function insertData($name)
    {
        if (!$name) {
            return false;
        }

        return $this->db->insert('payment_method', ['name' => $name, 'is_deleted' => 0]);
    }

    public function updateData($id, $name)
    {
        if (!$name || !$id) {
            return false;
        }
        $this->db->where('id', $id);
        return $this->db->update('payment_method', ['name' => $name]);
    }
}
