<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Content-type:application/json;charset=utf-8');
class C_Cart extends CI_Controller {
    public function __construct(){
        parent::__construct();
            $this->load->model('Model_Menu');
         
    }

    public function getAllItem(){
            $data['result']=$this->cart->contents();
            //if 0 item return array []
            echo json_encode($data);
            
}


    public function addItem(){
        //post kuantitas, id_menu menu,catatan
        $id_menu=$this->input->post('id_menu');
        $menu= $this->Model_Menu->getByID($id_menu);
        
        if ($this->checkAddRules()) {
            if(!$menu){
                $data['status']=false;
                $data['error_message']="id_menu menu not found";
                echo json_encode($data);
                return;
            }
            if($this->isEnoughStock()){                
                    $item = array(
                        'id'=> $menu->id_menu,
                        'qty' => $this->input->post('kuantitas'),
                        'price' => $menu->harga,
                        'name' => $menu->nama,
                        'options' => array('note' => $this->input->post('catatan'))
            );
                $this->cart->insert($item);
                $data['status']=true;
		$data['content']=$this->cart->contents();
            }else{
                $data['status']=false;
                $data['error_message']="this item available stok only $menu->stok";
            }
        }else{
            $data['status']=false;
            $data['error_message']="Please follow rules for filling input!". validation_errors();
        }
        echo json_encode($data);
       

    }
    public function checkAddRules(){
        $data=[
            [
                "field" => 'kuantitas',
                "label" => 'Kuantitas',
                "rules" => 'required|numeric'
            ],
            [
                "field" => 'catatan',
                "label" => 'Catatan',
                'rules' => 'required'
            ],
            [
                "field" => 'id_menu',
                "label" => 'Id Menu',
                "rules" => 'required|numeric'
            ],
        ];
        $validation = $this->form_validation;
        $validation->set_rules($data);
        return $validation->run();
    }

    public function isEnoughStock(){
        $id_menu=$this->input->post('id_menu');
        $qty=$this->input->post('kuantitas');
        $menu= $this->Model_Menu->getByID($id_menu);
        $count=0;
        if($this->cart->total_items()>0){
			foreach($this->cart->contents() as $item){
				if($item['id']==$id_menu){
                    $count+=$item['qty'];
				}
            }
        }
        if(($count+$qty)>$menu->stok){
            return false;
        }
        return true;
    }


 

	public function delete_cart_item($rowid){
        $item = array(
            'rowid' => "$rowid",
            'qty'   => 0
    );    
    $result=$this->cart->update($item);
    $data['status']=$result;
    echo json_encode($data);
    
    }
    
	public function destroyCart(){
        $this->cart->destroy();
        $data['status']=true;
        echo json_encode($data);
	}

    //not edited below
  
  
}
  

   
        
    


