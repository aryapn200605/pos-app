<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        ob_start();

        $key = $this->input->get('key');
        if ($key != '200605APN@id') {
            echo json_encode(['result' => false, 'message' => 'Unauthorized User']);
            exit; // Gunakan exit untuk menghentikan eksekusi
        }

        $this->load->dbforge();
    }

    public function resetTable()
    {
        $errors = [];

        // Tabel `users`
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'unique' => TRUE,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'printer' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'level' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => TRUE,
            ]
        ]);
        $this->dbforge->add_key('id', TRUE);

        if ($this->dbforge->create_table('users', TRUE)) {
            $errors[] = 'Error while creating table: users';
        }

        // Tabel `transaction`
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ],
            'product_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'total_price' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'unit_price' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'quantity' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'batch_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
        ]);
        $this->dbforge->add_key('id', TRUE);

        if ($this->dbforge->create_table('transaction', TRUE)) {
            $errors[] = 'Error while creating table: transaction';
        }

        // Tabel `transaction_batch`
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ],
            'order_id' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'customer_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'customer_phone' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'deadline' => [
                'type' => 'TIMESTAMP',
            ],
            'note' => [
                'type' => 'TEXT',
            ],
            'is_deleted' => [
                'type' => 'TINYINT',
                'constraint' => 1,
            ],
            'status' => [
                'type' => 'TINYINT',
                'constraint' => 2,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => TRUE,
            ],
            'created_by' => [
                'type' => 'CHAR',
                'constraint' => 36,
            ],
        ]);
        $this->dbforge->add_key('id', TRUE);

        if ($this->dbforge->create_table('transaction_batch', TRUE)) {
            $errors[] = 'Error while creating table: transaction_batch';
        }

        // Tabel `invoice`
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ],
            'invoice' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'unique' => TRUE,
            ],
            'batch_id' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'paid_amount' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'payment_method' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'status' => [
                'type' => 'TINYINT',
                'constraint' => 1,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => TRUE,
            ],
            'created_by' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
        ]);
        $this->dbforge->add_key('id', TRUE);

        if ($this->dbforge->create_table('invoice', TRUE)) {
            $errors[] = 'Error while creating table: invoice';
        }

        // Tabel `payment_method`
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'is_deleted' => [
                'type' => 'TINYINT',
                'constraint' => 1,
            ],
        ]);
        $this->dbforge->add_key('id', TRUE);

        if ($this->dbforge->create_table('payment_method', TRUE)) {
            $errors[] = 'Error while creating table: payment_method';
        }

        // Tabel `progress_status`
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'is_deleted' => [
                'type' => 'TINYINT',
                'constraint' => 1,
            ],
        ]);
        $this->dbforge->add_key('id', TRUE);

        if ($this->dbforge->create_table('progress_status', TRUE)) {
            $errors[] = 'Error while creating table: progress_status';
        }

        if (!empty($errors)) {
            echo json_encode(['result' => false, 'errors' => $errors]);
            return;
        }
    
        // Jika sukses semua
        echo json_encode(['result' => true, 'message' => 'All tables have been successfully created']);
    }

    public function seed()
    {
        $users = array(
            array(
                'name'      => 'Super',
                'username'  => 'super',
                'password'  => password_hash('1234', PASSWORD_BCRYPT),
                'level'     => 1,
                'created_at' => date('Y-m-d H:i:s')
            ),
            array(
                'name'      => 'Admin',
                'username'  => 'admin',
                'password'  => password_hash('1234', PASSWORD_BCRYPT),
                'level'     => 2,
                'created_at' => date('Y-m-d H:i:s')
            ),
            array(
                'name'      => 'Cashier',
                'username'  => 'cashier',
                'password'  => password_hash('1234', PASSWORD_BCRYPT),
                'level'     => 3,
                'created_at' => date('Y-m-d H:i:s')
            )
        );

        $payemntMethod = array(
            array(
                'name'      => 'Cash',
                'is_deleted' => 0
            ),
            array(
                'name'      => 'Transfer Bank BCA',
                'is_deleted' => 0
            ),
            array(
                'name'      => 'Transfer Bank Mandiri',
                'is_deleted' => 0
            ),
            array(
                'name'      => 'Transfer Bank BRI',
                'is_deleted' => 1
            )
        );

        $progressStatus = array(
            array(
                'name'      => 'Cancel',
                'is_deleted' => 0
            ),
            array(
                'name'      => 'Progress',
                'is_deleted' => 0
            ),
            array(
                'name'      => 'On Delivery',
                'is_deleted' => 0
            ),
            array(
                'name'      => 'On Packaging',
                'is_deleted' => 0
            ),
            array(
                'name'      => 'On Check',
                'is_deleted' => 0
            ),
            array(
                'name'      => 'Done',
                'is_deleted' => 0
            ),
        );

        if ($this->db->insert_batch('users', $users)) {
            echo json_encode(['result' => true, 'message' => 'Users has successfully created']);
        } else {
            echo json_encode(['result' => false, 'message' => 'Error while creating users']);
        }

        if ($this->db->insert_batch('payment_method', $payemntMethod)) {
            echo json_encode(['result' => true, 'message' => 'Payment Method has successfully created']);
        } else {
            echo json_encode(['result' => false, 'message' => 'Error while creating payment method']);
        }

        if ($this->db->insert_batch('progress_status', $progressStatus)) {
            echo json_encode(['result' => true, 'message' => 'Progress Status has successfully created']);
        } else {
            echo json_encode(['result' => false, 'message' => 'Error while creating progress status']);
        }
    }
}
