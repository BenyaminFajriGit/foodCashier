<?php
defined('BASEPATH') or exit('No direct script access allowed');
header('Content-type:application/json;charset=utf-8');
class C_Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
            $this->load->model('Model_Menu');
    }

    public function getAllMenu()
    {
        $result = $this->Model_Menu->getAllMenu();
        if( $result){
            $data['status']=true;
            $data['result']=$result;
            
        }
        else{
            $data['status']=false;
        }
        echo json_encode($data);
    }

 

    public function addMenu()
    {
       
        $data['status']=  $this->Model_Menu->addMenu();
        echo json_encode($data);
    }



    public function updateMenu()
    {
        $data['status']=  $this->Model_Menu->updateMenu();       
        echo json_encode($data);
    }


    public function deleteMenu($id_menu)
    {
        
        $data['status']=$this->Model_Menu->delete($id_menu);
        echo json_encode($data);
        
    }

    //not below the new one edited


    public function getByID($id_menu)
    {
        $result = $this->Model_Menu->getByID($id_menu);
        if( $result){
            $data['status']=true;
            $data['result']=$result;
            
        }
        else{
            $data['status']=false;
        }
        echo json_encode($data);
    }
    public function search($search='')
    {
        $result = $this->Model_Menu->search($search);
        if( $result){
            $data['status']=true;
            $data['result']=$result;
            
        }
        else{
            $data['status']=false;
        }
        echo json_encode($data);
        
    }

   
}
