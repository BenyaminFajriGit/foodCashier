<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_User extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('Model_User');
    }


    private function checkSession(){
        if($this->session->userdata('username')){
            $this->session->set_flashdata('error','Please logout first!');
            redirect('C_Product/listForCostumer/');
        }
    }
    public function index(){
       $this->checkSession();
        $this->load->view('Form_Registration');
    }
    
    public function registration(){
        $this->checkSession();
        
        if($this->checkRegistrationRules()){
            $user=$this->Model_User;
            if($user->addUser()){
                $this->session->set_flashdata('success','Registration Success!');
                redirect('C_User/login/');
            }
            else{
                $this->session->set_flashdata('error','username is used by another person!');
                redirect('C_User/');
            }
            
        }
        else{
            $this->session->set_flashdata('error','Please follow the rules'. validation_errors());
            redirect('C_User/');
        }

        
        
        
        
        
    }

    private function checkRegistrationRules(){
        $rules = [
            [
                "field" => 'username',
                "label" => 'Username',
                "rules" => 'required'
            ],
            [
                "field" => 'password',
                "label" => 'Password',
                'rules' => 'required'
            ],
            [
                "field" => 'fullname',
                "label" => 'Fullname',
                "rules" => 'required'
            ],
            [
                "field" => 'phone',
                "label" => 'Phone',
                'rules' => 'required|numeric'
            ]

        ];
        $validation = $this->form_validation;
        $validation->set_rules($rules);
        $valid=$validation->run();
        return $valid;
        
    }

    
  public function login(){
    $this->checkSession();
    
    $this->load->view('Form_Login');
  }

  private function checkLoginRules(){
    $rules = [
        [
            "field" => 'username',
            "label" => 'Username',
            "rules" => 'required'
        ],
        [
            "field" => 'password',
            "label" => 'Password',
            'rules' => 'required'
        ]

    ];
    $validation = $this->form_validation;
    $validation->set_rules($rules);
    return $validation->run();
    
}
public function loginProcess(){
    if($this->checkLoginRules()){
        $user=$this->Model_User;
        $valid_user=$user->checkCredential();
        if($valid_user){
            $this->session->set_userdata('username',$valid_user->username);
            $this->session->set_flashdata('success','Login is Successfull!');
                $this->session->set_userdata('type',$valid_user->type);
                $this->session->set_userdata('fullname',$valid_user->fullname);
                $this->session->set_userdata('phone',$valid_user->phone);
                switch($valid_user->type){
                    case 'admin':
                            redirect('C_Product/');break;
                    case 'member':
                            redirect('C_Product/listForCostumer');break;
                    default: break;
                }
        }
        else{
            $this->session->set_flashdata('error','Wrong password or username!');
            redirect('C_User/login/');  
        }
        
    }
    else{
        $this->session->set_flashdata('error','Please follow the rules'.validation_errors());
        redirect('C_User/login/');  
    }

}
    
    public function logout(){
        $this->session->sess_destroy();
        redirect(site_url('C_User/login'));
    }
}