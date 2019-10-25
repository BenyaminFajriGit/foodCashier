<?php
defined ('BASEPATH') OR exit ('No direct script access allowed');
class Model_User extends CI_Model
{
    private $_table = "user";

    public $username;
    public $password;
    public $type;
    public $fullname;
    public $phone;

    
    public function checkCredential(){
        $post = $this->input->post();
        $this->username = $post['username'];
        $this->password = $post['password'];
        $hasil=$this->db->query("SELECT * FROM `user` WHERE BINARY username= '$this->username' and BINARY password ='$this->password' ")->result();
        
      
            return $hasil[0];
      
        
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    public function getById ($id)
    {
        return $this->db->get_where($this->_table,["username" => $id])->row();
    }
    public function addUser ()
    {
        $post = $this->input->post();
        $this->username= $post["username"];
        if($this->notAvailableUsername($this->username)){
            return false;
        }
        $this->password= $post["password"];
        $this->type='member';
        $this->fullname=$post['fullname'];
        $this->phone= $post['phone'];
        return $this->db->insert($this->_table,$this);
    }
    private function notAvailableUsername($username){
        return $this->db->get_where($this->_table,array('username'=>$username))->row();
    }
    public function update()
    {
        
        $post = $this->input->post();
        $this->username= $post["username"];
        $this->password= $post["password"];
        $this->type='member';
        $this->fullname=$post['fullname'];
        $this->phone= $post['phone'];    
        $this->db->update($this->_table,$this,array('id_user'=>$post["id_user"]));
    }
    public function delete($id)
    {
        return $this->db->delete($this->_table,array("id_user"=>$id));
    }
}
