<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Model_Invoice extends CI_Model
{
    private $_table = "invoice";

    public $id_invoice;
    public $username;
    public $date;
    public $due_date;
    public $status;
    public $fullname;
    public $street_address;
    public $province;
    public $city;
    public $phone_number;
    public $shipping_charge;
    public $proof;

    public function __construct()
    {
        parent::__construct();
    }
    public function checkout_rules(){
        return[
            [
                "field" => 'name',
                "label" => 'Fullname',
                "rules" => 'required'
            ],
            [
                "field" => 'street_address',
                "label" => 'Street Address',
                'rules' => 'required'
            ],
            [
                "field" => 'province_name',
                "label" => 'Province Name',
                "rules" => 'required'
            ],
            [
                "field" => 'city_name',
                "label" => 'City Name',
                'rules' => 'required'
            ],
            [
                "field" => 'phone_number',
                "label" => 'Phone Number',
                "rules" => 'required|numeric'
            ],
            [
                "field" => 'cost',
                "label" => 'Services',
                'rules' => 'required'
            ],
            
        ];
    }


    public function create_invoice()
    {
        $this->username = $this->session->userdata('username');
        $this->date = date('Y-m-d H:i:s');
        $this->due_date = date('Y-m-d H:i:s', mktime(date('H'), date('i'), date('s'), date('m'), date('d') + 1, date('Y')));
        $this->status = 'unpaid';
        $this->fullname = $this->input->post('name');
        $this->street_address = $this->input->post('street_address');
        $this->province = $this->input->post('province_name');
        $this->city = $this->input->post('city_name');
        $this->phone_number = $this->input->post('phone_number');
        $this->shipping_charge = $this->input->post('cost');
        $this->proof = 'default.jpg';
        $this->db->insert($this->_table, $this);
        $this->id_invoice = $this->db->insert_id();
        return $this;
    }
    public function getAllInvoices()
    {
        $hasil= $this->db->select('invoice.*,SUM(orders.qty*product.price)+invoice.shipping_charge AS total')->from('invoice')->join('orders', 'orders.id_invoice=invoice.id_invoice')->join('product', 'orders.id_product=product.id_product')->group_by('orders.id_invoice')->get();

        if ($hasil->num_rows() > 0) {
            return $hasil->result();
        }  return false;
    }
    public function getInvoiceByID($id_invoice)
    {
        return $this->db->get_where($this->_table, array('id_invoice' => $id_invoice))->row();
    }
    public function getInvoiceByIDUser($username)
    {
        return $this->db->select('invoice.*,SUM(orders.qty*product.price)+invoice.shipping_charge AS total')->from('invoice')->join('user', 'user.username=invoice.username')->join('orders', 'orders.id_invoice=invoice.id_invoice')->join('product', 'orders.id_product=product.id_product')->group_by('orders.id_invoice')->where("user.username", $username)->get()->result();
    }
    public function setStatus()
    {
        $post = $this->input->post();
        $username =$this->session->userdata('username');
        return $this->db->update($this->_table, array('status' => 'waiting confirmation'), array('id_invoice' => $post["id_invoice"],'username'=>$username));
    }
    public function setProof()
    {
        $post = $this->input->post();
        $proof = $this->_uploadImage($post['id_invoice']);
        if($this->upload->display_errors()){
            return false;
        }
        $username =$this->session->userdata('username');
        $this->db->update($this->_table, array('proof' => $proof), array('id_invoice' => $post["id_invoice"],'username'=>$username));
        $this->setStatus();
        return true;
    }
    private function _uploadImage($id_invoice)
    {
        $config['upload_path'] = './upload/payment/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['file_name'] = $id_invoice;
        $config['overwrite'] = true;
        $config['max_size'] = 1024;
        //$config['max_width']=1024;
        //$config['max_height']=768;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('proof')) {
            return $this->upload->data('file_name');
        }
       
        return "default.jpg";
    }
    public function setStatusInvoice($id_invoice,$status)
    {
        if ($this->db->update($this->_table, array('status' => $status), array('id_invoice' => $id_invoice))) {
            return $this->db->get_where($this->_table, array('id_invoice' => $id_invoice))->row();
        }
        return false;
    }
    public function checkExpired (){
        $status='expired';
        $invoices=$this->db->where('DATEDIFF(due_date,NOW())<=0')->get($this->_table)->result();
        foreach($invoices as $invoice){
            $this->db->update($this->_table,array('status'=>$status),array('id_invoice'=>$invoice->id_invoice));
        }
        return $invoices;
    }
    
}
