<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Pelanggan extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('Model_Pelanggan');
    }


    public function getAllPelanggan()
    {
        $result = $this->Model_Pelanggan->getAllPelanggan();
        if( $result){
            $data['status']=true;
            $data['result']=$result;
            
        }
        else{
            $data['status']=false;
        }
        echo json_encode($data);
    }

 

    public function addPelanggan()
    {
       
        $data['status']=  $this->Model_Pelanggan->addPelanggan();
        echo json_encode($data);
    }



    public function updatePelanggan()
    {
        $data['status']=  $this->Model_Pelanggan->updatePelanggan();       
        echo json_encode($data);
    }

    


    public function deletePelanggan($username)
    {
        
        $data['status']=$this->Model_Pelanggan->deletePelanggan($username);
        echo json_encode($data);
        
    }

    //not below the new one edited


    public function getByUsername($username)
    {
        $result = $this->Model_Pelanggan->getByUsername($username);
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
        $result = $this->Model_Pelanggan->search($search);
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