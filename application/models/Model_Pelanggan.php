<?php
defined ('BASEPATH') OR exit ('No direct script access allowed');
class Model_Pelanggan extends CI_Model
{
    private $_table = "pelanggan";

    public $username_pelanggan;
    public $nama;
    public $no_hp;
    public $jml_point;

    

    public function getAllPelanggan()
    {
        return $this->db->get($this->_table)->result();
    }
    public function getByUsername ($username_pelanggan)
    {
        return $this->db->get_where($this->_table,["username_pelanggan" => $username_pelanggan])->row();
    }
    public function addPelanggan ()
    {
        $post = $this->input->post();
        $this->username_pelanggan= $post["username_pelanggan"];
        if($this->notAvailableUsername($this->username_pelanggan)){
            return false;
        }
        $this->nama=$post['nama'];
        $this->no_hp= $post['no_hp'];
        $this->jml_point= 0;
        return $this->db->insert($this->_table,$this);
    }
    private function notAvailableUsername($username_pelanggan){
        return $this->db->get_where($this->_table,array('username_pelanggan'=>$username_pelanggan))->row();
    }
    public function updatePelanggan()
    {
        
        $post = $this->input->post();
        $this->username_pelanggan= $post["username_pelanggan"];
        $this->nama=$post['nama'];
        $this->no_hp= $post['no_hp'];    
        $this->db->set('nama', $this->nama)->set('no_hp', $this->no_hp)->where('username_pelanggan', $this->username_pelanggan)->update($this->_table);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE; 
    }

    public function updatePoin($username_pelanggan,$total)
    {
        $this->username_pelanggan= $username_pelanggan;
        $this->jml_point= intdiv($total, 300000)*10000;    
        $totalPoint= $this->db->get_where($this->_table,array('username_pelanggan'=>$username_pelanggan))->row()->jml_point;
        $this->db->set('jml_point',  $this->jml_point+$totalPoint)->where('username_pelanggan', $this->username_pelanggan)->update($this->_table);
        if ($this->db->affected_rows() > 0) 
        {
            return  $this->jml_point;
        }
        else return 0;

    }
    public function updateUsePoin($username_pelanggan,$total)
    {
        $this->username_pelanggan= $username_pelanggan;   
        $totalPoint= $this->db->get_where($this->_table,array('username_pelanggan'=>$username_pelanggan))->row()->jml_point;
        $potongan=0;
        if($totalPoint>=$total){
            $potongan=$total;
            $sisaPoin= $totalPoint-$potongan;
            $this->db->set('jml_point',$sisaPoin )->where('username_pelanggan', $this->username_pelanggan)->update($this->_table);
        }else{
            $potongan= $totalPoint;
            $this->db->set('jml_point',0 )->where('username_pelanggan', $this->username_pelanggan)->update($this->_table);
        }
        if ($this->db->affected_rows() > 0) 
        {
            return  $potongan;
        }
        return $potongan;

    }
    public function deletePelanggan($username_pelanggan)
    {
        $this->db->delete($this->_table,array("username_pelanggan"=>$username_pelanggan));
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE; 
    }

    public function search ($search){
        return  $this->db->like("nama",$search)->or_like("no_hp",$search)->or_like("username_pelanggan",$search)->get($this->_table)->result();
    }
}
