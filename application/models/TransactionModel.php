<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TransactionModel extends CI_Model
{
    public function createTransaction($datas)
    {
        $this->db->trans_start();

        $order_id = 'MGK-' . date('Ymd') . '-' . str_pad($this->countOrderToday() + 1, 2, "0", STR_PAD_LEFT);

        $batchData = array(
            'order_id'          => $order_id,
            'customer_name'     => $datas['customer_name'],
            'customer_phone'    => $datas['customer_phone'],
            'deadline'          => $datas['deadline'],
            'note'              => $datas['note'],
            'status'            => 1,
            'is_deleted'        => 0,
            'created_at'        => date('Y-m-d H:i:s'),
            'created_by'        => $this->session->user_id
        );

        $this->db->insert('transaction_batch', $batchData);
        $batchId = $this->db->insert_id();

        foreach ($datas['products'] as &$data) {
            unset($data['id']);
            $data['batch_id'] = $batchId;
        }

        $this->db->insert_batch('transaction', $datas['products']);

        $invoiceData = array(
            'paid_amount'       => $datas['deposits'],
            'payment_method'    => $datas['payment_method'],
            'status'            => $datas['grand_total'] == $datas['deposits'] ? 1 : 0,
            'created_at'        => date('Y-m-d H:i:s'),
            'created_by'        => $this->session->user_id
        );

        if (!$this->createInvoice($batchId, $invoiceData)) {
            $this->db->trans_rollback();
            return false;
        }

        $this->db->trans_complete();

        if ($this->db->trans_status()) {
            return $batchId;
        } else {
            return false;
        }

    }

    public function createInvoice($batchId, $datas)
    {
        $invoice = 'TRX-' . date('Ymd') . '-' . str_pad($this->countInvoiceToday() + 1, 2, "0", STR_PAD_LEFT);

        $datas['invoice'] = $invoice;
        $datas['batch_id'] = $batchId;

        if ($this->db->insert('invoice', $datas)) {
            return true;
        } else {
            return false;
        }
    }

    public function countInvoiceToday()
    {
        $this->db->like('created_at', date('Y-m-d'));
        $this->db->from('invoice');

        return $this->db->count_all_results();
    }

    public function countOrderToday()
    {
        $this->db->like('created_at', date('Y-m-d'));
        $this->db->from('transaction_batch');

        return $this->db->count_all_results();
    }

    public function getTransactionData($id = null)
    {
        $param = $this->input->get();

        $result = array(
            'recordsTotal'      => 0,
            'recordsFiltered'   => 0,
            'data'              => []
        );

        // Get Count All Data
        $recordTotal = $this->db->query("SELECT COUNT(id) AS total FROM transaction_batch WHERE is_deleted = 0")->row();
        $result['recordsTotal'] = intval($recordTotal->total);

        // Get All Data
        $this->db->start_cache();
        $this->db->reset_query();
        $this->db->select('tb.id AS tb_id');
        $this->db->from('transaction_batch tb');
        $this->db->join('transaction t', 'tb.id = t.batch_id', 'left');
        $this->db->join('invoice i', 'tb.id = i.batch_id', 'left');
        $this->db->join('progress_status ps', 'tb.status = ps.id', 'left');
        $this->db->join('payment_method pym', 'i.payment_method = pym.id', 'left');
        $this->db->join('users u', 'tb.created_by = u.id', 'left');
        $this->db->join('users u_i', 'i.created_by = u_i.id', 'left');
        $this->db->where('tb.is_deleted', 0);

        // Filtering
        if (!empty($id)) {
            $this->db->where('tb.id', $id);
        }

        if (!empty($param['customer_name'])) {
            $this->db->like('tb.customer_name', $param['customer_name']);
        }

        if (!empty($param['order_id'])) {
            $this->db->like('tb.order_id', $param['order_id']);
        }

        if (!empty($param['phone_number'])) {
            $this->db->like('tb.customer_phone', $param['phone_number']);
        }

        if (!empty($param['transaction_date'])) {
            $this->db->like('tb.created_at', $param['transaction_date']);
        }

        if (!empty($param['deadline'])) {
            $this->db->like('tb.deadline', $param['deadline']);
        }

        if (!empty($param['progress_status'])) {
            $this->db->like('tb.status', $param['progress_status']);
        }

        if (!empty($param['item'])) {
            $this->db->group_start();
            $this->db->like('t.product_name', $param['item']);
            $this->db->group_end();
        }

        if (!empty($param['payment_method'])) {
            $this->db->group_start();
            $this->db->where_in('i.payment_method', [$param['payment_method']]);
            $this->db->group_end();
        }

        if (!empty($param['payment_status'])) {
            $this->db->group_start();

            if ($param['payment_status'] == '1') {
                $this->db->where('(SELECT SUM(t.total_price) FROM transaction t WHERE t.batch_id = tb.id) <= (SELECT SUM(i.paid_amount) FROM invoice i WHERE i.batch_id = tb.id)', NULL, FALSE);
            } elseif ($param['payment_status'] == '2') {
                $this->db->where('(SELECT SUM(t.total_price) FROM transaction t WHERE t.batch_id = tb.id) > (SELECT SUM(i.paid_amount) FROM invoice i WHERE i.batch_id = tb.id)', NULL, FALSE);
            }

            $this->db->group_end();
        }

        $this->db->stop_cache();

        // Count Data Filtered
        $recordsFiltered = $this->db->group_by('tb.id')->count_all_results();
        $result['recordsFiltered'] = $recordsFiltered;

        $this->db->reset_query();
        $this->db->select('
            tb.order_id,
            tb.customer_name, 
            tb.customer_phone, 
            tb.note, tb.deadline, 
            tb.created_at, 
            tb.created_by, 
            t.id AS t_id, 
            t.product_name, 
            t.total_price, 
            t.unit_price, 
            t.quantity, 
            i.id AS i_id, 
            i.invoice, 
            i.paid_amount, 
            pym.name AS payment_method,
            i.created_at AS created_at_i, 
            u_i.name AS created_by_i, 
            ps.name AS status, 
            u.name AS cashier
        ');

        // Ordering
        if (isset($param['order'])) {
            foreach ($param['order'] as $row) {
                $column = $param['columns'][intval($row['column'])]['data'];
                $dir = $row['dir'];
                $this->db->order_by($column, $dir);
            }
        }

        // Limiting for Pagination
        if (isset($param['start']) && isset($param['length'])) {
            $this->db->limit($param['length'], $param['start']);
        }

        $data = $this->db->get()->result();
        $result['data'] = $this->formatData($data);

        return $result;
    }

    public function deleteTransaction()
    {
        $id = $this->input->get('id');

        $this->db->where('id', $id);
        $result = $this->db->update('transaction_batch', array('is_deleted' => 1));

        if ($result) {
            return ['success' => true, 'message' => 'Data deleted successfuly'];
        } else {
            return ['success' => false, 'message' => 'Error while processing data'];
        }
    }

    private function formatData($array = [])
    {
        $nestedResult = [];
        $tb_id = 0;

        foreach ($array as $row) {
            if ($row->tb_id != $tb_id) {
                $tb_id = $row->tb_id;

                $nestedResult[] = [
                    'tb_id'             => $row->tb_id,
                    'order_id'          => $row->order_id,
                    'customer_name'     => $row->customer_name,
                    'customer_phone'    => $row->customer_phone,
                    'cashier'           => $row->cashier,
                    'note'              => $row->note,
                    'deadline'          => (new DateTime($row->deadline))->format("d-m-Y"),
                    'status'            => $row->status,
                    'created_at'        => (new DateTime($row->created_at))->format("d-m-Y"),
                    'created_by'        => $row->created_by,
                    'transaction'       => [],
                    'invoice'           => [],
                    'grand_price'       => 0,
                    'total_paid'        => 0
                ];
            }

            $index = count($nestedResult) - 1;

            $transactionExists = false;
            foreach ($nestedResult[$index]['transaction'] as $transaction) {
                if ($transaction['t_id'] == $row->t_id) {
                    $transactionExists = true;
                    break;
                }
            }

            if (!$transactionExists) {
                $nestedResult[$index]['grand_price'] += $row->total_price;

                $nestedResult[$index]['transaction'][] = [
                    't_id'          => $row->t_id,
                    'product_name'  => $row->product_name,
                    'total_price'   => $row->total_price,
                    'unit_price'    => $row->unit_price,
                    'quantity'      => $row->quantity,
                ];
            }

            $invoiceExists = false;
            foreach ($nestedResult[$index]['invoice'] as $invoice) {
                if ($invoice['i_id'] == $row->i_id) {
                    $invoiceExists = true;
                    break;
                }
            }

            if (!$invoiceExists) {
                $nestedResult[$index]['total_paid'] += $row->paid_amount;

                $nestedResult[$index]['invoice'][] = [
                    'i_id'              => $row->i_id,
                    'invoice'           => $row->invoice,
                    'paid_amount'       => $row->paid_amount,
                    'payment_method'    => $row->payment_method,
                    'created_at'        => $row->created_at_i,
                    'created_by'        => $row->created_by_i,
                ];
            }
        }

        return $nestedResult;
    }
}
