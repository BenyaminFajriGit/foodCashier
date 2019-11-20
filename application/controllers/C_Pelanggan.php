<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Content-type:application/json;charset=utf-8');
class C_Pelanggan extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('Model_Pelanggan');
    }

    /**
     * Show Memeber by Username or All Members
     * 
     * @param   username
     * @return  Array (JSON)
     */

    public function getPelanggan(String $username = null)
    {
        if(!is_null($username))
        {
            $result = $this->Model_Pelanggan->getByUsername($username);
            if($result){
                $data['status']=true;
                $data['result']=$result;
                
            }
            else{
                $data['status']=false;
            }
        }else{
            $result = $this->Model_Pelanggan->getAllPelanggan();
            if( $result){
                $data['status']=true;
                $data['result']=$result;
                
            }
            else{
                $data['status']=false;
            }
        }

        echo json_encode($data);
    }

    /**
     * Dispatch Action for ADD, UPDATE & DELETE Data
     * 
     * @param   method
     * @param   username
     * 
     * @return  Array (JSON)
     */
    public function actions(String $method, String $username = null)
    {
        $data = $this->input->post();
        $data['username'] = $username;
        
        $result['status'] = $this->Model_Pelanggan->dispatch($data, $method);
        echo json_encode($result['status']);
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