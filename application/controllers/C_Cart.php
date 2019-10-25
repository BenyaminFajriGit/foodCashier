<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Cart extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if($this->isSessionSet()){
            $this->load->model('Model_Product');
        }else{
            $this->session->set_flashdata('error',"Please Login First!");
            redirect('C_User/login/');
        }

    }
    public function index(){
            $data['items']=$this->cart->contents()  ;
            $this->load->view('Form_Cart',$data);
}


    public function addItem(){
        
        $id_product=$this->input->post('id_product');
        if ($this->checkAddRules()) {
            $product= $this->Model_Product->getByID($id_product);
            if($this->isEnoughStock()){
               
                
                $qty=$this->input->post('quantity');
                    $data = array(
                        'id'=> $product->id_product,
                        'qty' => $this->input->post('quantity'),
                        'price' => $product->price,
                        'name' => $product->name,
                        'weight' => $product->weight*$this->input->post('quantity'),
                        'options' => array('note' => $this->input->post('note'))
            );
                $this->cart->insert($data);
                $this->session->set_flashdata('success',"product successfully added to cart!");
                redirect('C_Product/listForCostumer/');
            }else{
                $this->session->set_flashdata('error',"this item available stock only $product->stock ");
                redirect("C_Product/detailProduct/".$id_product);
            }
        }else{
            $this->session->set_flashdata('error',"Please follow rules for filling input!". validation_errors());
                redirect("C_Product/detailProduct/".$id_product);
        }
       

    }
    public function checkAddRules(){
        $data=[
            [
                "field" => 'quantity',
                "label" => 'Quantity',
                "rules" => 'required|numeric'
            ],
            [
                "field" => 'note',
                "label" => 'Note',
                'rules' => 'required'
            ],
            [
                "field" => 'id_product',
                "label" => 'ID Product',
                "rules" => 'required'
            ],
        ];
        $validation = $this->form_validation;
        $validation->set_rules($data);
        return $validation->run();
    }

    public function isEnoughStock(){
        $id_product=$this->input->post('id_product');
        $qty=$this->input->post('quantity');
        $product= $this->Model_Product->getByID($id_product);
        $count=0;
        if($this->cart->total_items()>0){
			foreach($this->cart->contents() as $item){
				if($item['id']==$id_product){
                    $count+=$item['qty'];
				}
            }
        }
        if(($count+$qty)>$product->stock){
            return false;
        }
        return true;
    }


    private function isSessionSet(){
        if($this->session->userdata('username')){
            return true;
        }
        return false;
    }

	public function delete_cart_item($rowid){
        $data = array(
            'rowid' => "$rowid",
            'qty'   => 0
    );    
    $this->cart->update($data);
    redirect('C_Cart/');
    }
    
	public function destroyCart(){
		$this->cart->destroy();
		redirect('C_Product/listForCostumer');
	}

    //not edited below
  
  
}
  

   
        
    


