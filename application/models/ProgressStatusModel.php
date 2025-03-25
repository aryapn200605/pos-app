<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProgressStatusModel extends CI_Model
{
    public function findAll()
    {
        $datas = $this->db->select("*")
            ->from("progress_status")
            ->where('is_deleted', 0)
            ->get()->result();

        return $datas;
    }

    public function insertData($name)
    {
        if (!$name) {
            return false;
        }

        return $this->db->insert('progress_status', ['name' => $name, 'is_deleted' => 0]);
    }

    public function updateData($id, $name)
    {
        if (!$name || !$id) {
            return false;
        }
        $this->db->where('id', $id);
        return $this->db->update('progress_status', ['name' => $name]);
    }

    public function changeStatus($tb_id, $status)
    {
        if (!$tb_id || !$status) {
            return false;
        }

        $this->db->where('id', $tb_id);
        return $this->db->update('transaction_batch', ['status' => $status]);
    }
}
