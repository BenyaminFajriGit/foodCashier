<?php
defined('BASEPATH') or exit('No direct script access allowed');

class C_Transact extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
            $this->load->model('Model_Order');
            $this->load->model('Model_Menu');
            $this->load->model('Model_Invoice');
            $this->load->model('Model_Pelanggan');
        
    }
    public function getAllInvoice()
    {
        
        $result = $this->Model_Invoice->getAllInvoices();
        if( $result){
            $data['status']=true;
            $data['result']=$result;
            
        }
        else{
            $data['status']=false;
            
        }
        echo json_encode($data);
    }



    public function getInvoiceByID($id_invoice)
    {
        $result = $this->Model_Invoice->getInvoiceByID($id_invoice);
        if( $result){
            $data['status']=true;
            $data['result']=$result;
        }
        else{
            $data['status']=false;
        }
        echo json_encode($data);
    }


    public function showDetailInvoice($id_invoice)
    {
        $data['invoice'] = $this->Model_Invoice->getInvoiceByID($id_invoice);
        $data['orders'] = $this->Model_Order->getOrderByInvoice($data['invoice']->id_invoice);
        echo json_encode($data);
        
    }

   
    //below
    public function checkout()
    {   
            $this->checkEmptyCart();
            $this->checkStock();
            //perlu nilai post username pelanggan dan staff
            $invoice = $this->Model_Invoice->create_invoice();
            $this->Model_Order->process($invoice->id_invoice);
            $invoice=$this->Model_Invoice->getInvoiceByID($invoice->id_invoice);
            $data['use_poin']=0;
            $data['get_poin']=0;
            if($invoice->username_pelanggan!=null){
                $data['use_poin']= $this->Model_Pelanggan->updateUsePoin($invoice->username_pelanggan,$invoice->total);
                $data['get_poin']=  $this->Model_Pelanggan->updatePoin($invoice->username_pelanggan,$invoice->total);
                
                $this->Model_Invoice->setPotongan($invoice->id_invoice,$data['use_poin']);
            }
            $data['status']=true;
            $this->cart->destroy();
            echo json_encode($data);
    }

    private function checkEmptyCart()
    {
        if ($this->cart->total_items() <= 0) {
            $data['status']=false;
            $data['message']="Keranjang masih kosong";
            echo json_encode($data);
            exit();
        }
    }
    private function checkStock()
    {
        foreach ($this->cart->contents() as $item) {
            $id = $item['id'];
            $menu = $this->Model_Menu->getById($id);
            if ($menu->stok < $item['qty']) {
                $data['status']=false;
                $data['message']="Stok $menu->nama tidak mencukupi! hanya tersisa $menu->stok";
                echo json_encode($data);
                exit();
            }
        }
    }



    
}
