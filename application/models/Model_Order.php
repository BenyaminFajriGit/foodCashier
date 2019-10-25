<?php
defined ('BASEPATH') OR exit ('No direct script access allowed');
class Model_Order extends CI_Model
{
    private $_table = "orders";
    private $_table_product = "product";

    public $id_order;
    public $id_invoice;
    public $id_product;
    public $note;
    public $qty;
    
    

    public function __construct(){
        parent:: __construct();
        
        
    }
    
        
    
    public function process($invoice){
        foreach($this->cart->contents() as $item){
            $this->id_invoice = $invoice->id_invoice;
            $this->id_product = $item['id'];
            $this->note = $item['options']['note'];
            $this->qty = $item['qty'];
            $this->db->insert($this->_table,$this);
            $product=$this->db->get_where($this->_table_product,["id_product" => $this->id_product])->row();
            $stock=$product->stock-$this->qty;
            $this->db->where(array('id_product'=>$this->id_product))->update($this->_table_product,array('stock'=>$stock));
        }
        return true;
    }
    public function getOrderByInvoice($id_invoice){        
        return $this->db->select('*')->from($this->_table)->join($this->_table_product, 'product.id_product = orders.id_product')->where(array('id_invoice'=>$id_invoice))->get()->result();
        
    }
    
    
}
