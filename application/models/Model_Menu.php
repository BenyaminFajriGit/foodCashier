<?php
defined ('BASEPATH') OR exit ('No direct script access allowed');
class Model_Menu extends CI_Model
{
    private $_table = "menu";

    public $id_menu;
    public $nama;
    public $harga;
    public $kategori;
    public $stok;
    
    public function getAllMenu()
    {
        return $this->db->get($this->_table)->result();
    }
    public function getById ($id_menu)
    {
        return $this->db->get_where($this->_table,["id_menu" => $id_menu])->row();
    }
    public function addMenu ()
    {
        $post =$this->input->post();
        $this->nama= $post["nama"];
        $this->harga= $post["harga"];
        $this->kategori= $post["kategori"];
        $this->stok= $post['stok'];
        return $this->db->insert($this->_table,$this);
    }
    public function updateMenu()
    {
        
        $post = $this->input->post();
        $this->id_menu = $post["id_menu"];
        $this->nama= $post["nama"];
        $this->harga= $post["harga"];
        $this->kategori= $post["kategori"];
        $this->stok= $post['stok'];
        $this->db->update($this->_table,$this,array('id_menu'=>$this->id_menu));
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE; 
    }
    public function delete($id_menu)
    {
        $this->db->delete($this->_table,array("id_menu"=>$id_menu));
        return  ($this->db->affected_rows() > 0) ? TRUE : FALSE; 
    }
   
    
    public function search ($search){
        return  $this->db->like("nama",$search)->or_like("kategori",$search)->get($this->_table)->result();
    }
}
?>