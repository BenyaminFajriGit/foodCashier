<?php
defined ('BASEPATH') OR exit ('No direct script access allowed');
class Model_Product extends CI_Model
{
    private $_table = "product";

    public $id_product;
    public $name;
    public $category;
    public $price;
    public $stock;
    public $weight;
    public $photo="default.jpg";
    public $description;

    
    public function getAllProducts()
    {
        return $this->db->get($this->_table)->result();
    }
    public function getById ($id)
    {
        return $this->db->get_where($this->_table,["id_product" => $id])->row();
    }
    public function addProduct ()
    {
        $post =$this->input->post();
        $this->id_product = uniqid();
        $this->name= $post["name"];
        $this->category= $post["category"];
        $this->price= $post["price"];
        $this->stock= $post['stock'];
        $this->weight= $post['weight'];
        $this->photo= $this->_uploadImage();
        $this->description= $post['description'];
        $this->db->insert($this->_table,$this);
    }
    public function setProduct()
    {
        
        $post = $this->input->post();
        $this->id_product = $post["id"];
        $this->name= $post["name"];
        $this->category= $post["category"];
        $this->price= $post["price"];
        $this->stock= $post['stock'];
        $this->weight= $post['weight'];
        if(!empty($_FILES['photo']['name'])){
            $this->photo= $this->_uploadImage();
        }else{
            $this->photo=$post['old_image'];
        }
        

        $this->description= $post['description'];
        $this->db->update($this->_table,$this,array('id_product'=>$post["id"]));
    }
    public function delete($id)
    {
        $this->_deleteImage($id);
        return $this->db->delete($this->_table,array("id_product"=>$id));
    }
    private function _uploadImage(){
        $config['upload_path']='./upload/product/';
        $config['allowed_types']= 'gif|jpg|png|jpeg';
        $config['file_name']=$this->id_product;
        $config['overwrite']=true;
        $config['max_size']=1024;
        //$config['max_width']=1024;
        //$config['max_height']=768;
        $this->load->library('upload',$config);
        if($this->upload->do_upload('photo')){
            return $this->upload->data('file_name');
        }
        var_dump($this->upload->display_errors());
        return "default.jpg";
    }

    private function _deleteImage($id){
        $product= $this->getById($id);
        if($product->photo!="default.jpg"){
            $filename= explode(".",$product->photo)[0];
            return array_map('unlink',glob(FCPATH."upload/product/$filename.*"));
        }
    }

    public function checkExpired($invoices){
        foreach($invoices as $invoice){
            $product=$this->db->select('product.*,orders.qty')->from('product')->join('orders', 'product.id_product=orders.id_product')->join('invoice', 'orders.id_invoice=invoice.id_invoice')->where(array('invoice.id_invoice'=>$invoice->id_invoice))->get()->result();
            foreach($product as $item){
                $this->db->update($this->_table,array('stock'=>(int)$item->qty+(int)$item->stock),array('id_product'=>$item->id_product));
            }
            
        }
        return true;
    }
    
    public function search ($search){
        return  $this->db->like("name",$search)->or_like("category",$search)->or_like("description",$search)->get($this->_table)->result();
    }
}
?>