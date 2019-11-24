<?php
defined ('BASEPATH') OR exit ('No direct script access allowed');
class Model_Order extends CI_Model
{
    private $_table = "orders";
    private $_table_menu = "menu";

    public $id_order;
    public $id_invoice;
    public $id_menu;
    public $catatan;
    public $kuantitas;
    
    

    public function __construct(){
        parent:: __construct();
        
        
    }
    
        
    
    public function process($id_invoice){
        foreach($this->cart->contents() as $item){
            $this->id_invoice = $id_invoice;
            $this->id_menu = $item['id'];
            $this->catatan = $item['options']['note'];
            $this->kuantitas = $item['qty'];
            $this->db->insert($this->_table,$this);
            $menu=$this->db->get_where($this->_table_menu,["id_menu" => $this->id_menu])->row();
            $stok=$menu->stok-$this->kuantitas;
            $this->db->where(array('id_menu'=>$this->id_menu))->update($this->_table_menu,array('stok'=>$stok));
        }
        return true;
    }
    public function getOrderByInvoice($id_invoice){        
        return $this->db->select("*,(menu.harga * orders.kuantitas) as subtotal")->from($this->_table)->join($this->_table_menu, 'menu.id_menu = orders.id_menu')->where(array('id_invoice'=>$id_invoice))->get()->result();
        
    }
    
    
}
