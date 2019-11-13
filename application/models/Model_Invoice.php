<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Model_Invoice extends CI_Model
{
    private $_table = "invoice";

    public $id_invoice;
    public $username_pelanggan;
    public $username_staff;
    public $tanggal;
    public $potongan;


    public function __construct()
    {
        parent::__construct();
    }


    public function create_invoice()
    {
        $this->username_pelanggan = $this->input->post('username_pelanggan');
        $this->username_staff = $this->input->post('username_staff');
        $this->tanggal = date('Y-m-d H:i:s');
        $this->potongan = 0;
        $this->db->insert($this->_table, $this);
        $this->id_invoice = $this->db->insert_id();
        return $this;
    }
    public function getAllInvoices()
    {
        $hasil = $this->db->select('invoice.*,SUM(orders.kuantitas*menu.harga) AS total, (SUM(orders.kuantitas*menu.harga)-potongan) as setelah_potongan')->from('invoice')->join('orders', 'orders.id_invoice=invoice.id_invoice')->join('menu', 'orders.id_menu=menu.id_menu')->group_by('orders.id_invoice')->get();

        if ($hasil->num_rows() > 0) {
            return $hasil->result();
        }
        return false;
    }
    public function getInvoiceByID($id_invoice)
    {
        $hasil = $this->db->select('invoice.*,SUM(orders.kuantitas*menu.harga) AS total,(SUM(orders.kuantitas*menu.harga)-potongan) as setelah_potongan')->from('invoice')->where('invoice.id_invoice=',$id_invoice)->join('orders', 'orders.id_invoice=invoice.id_invoice')->join('menu', 'orders.id_menu=menu.id_menu')->group_by('orders.id_invoice')->get();

        if ($hasil->num_rows() == 1) {
            return $hasil->row();
        }
        return false;
    }

    public function setPotongan($id_invoice,$potongan)
    {
         $this->db->update($this->_table, array('potongan'=> $potongan), array('id_invoice' => $id_invoice));
         return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
        
    }
   
    
}
