<?php
defined ('BASEPATH') OR exit ('No direct script access allowed');
class Model_Pelanggan extends CI_Model
{
    private $_table = "pelanggan";

    public $username_pelanggan;
    public $nama;
    public $no_hp;
    public $jml_point;

    /**
     * Get All Pelanggan
     * 
     * @return Array
     */
    public function getAllPelanggan()
    {
        return $this->db->get($this->_table)->result();
    }

    /**
     * Get Pelanggan by Username
     * @param   username_pelanggan
     * 
     * @return  Array
     */
    public function getByUsername (String $username_pelanggan)
    {
        return $this->db->get_where($this->_table,["username_pelanggan" => $username_pelanggan])->row();
    }

    /**
     * Dispatch for ADD, UPDATE & DELETE Data Pelanggan
     * @param   data
     * @param   action
     * 
     * @return  Array
     */
    public function dispatch(Array $data, String $action)
    {
        switch ($action)
        {
            case 'add_pelanggan':
                if($this->notAvailableUsername($data['username_pelanggan'])){
                    return false;
                }
                $new_data['username_pelanggan'] = $data['username_pelanggan'];
                $new_data['nama'] = $data['nama'];
                $new_data['no_hp'] = $data['no_hp'];
                $new_data['jml_point'] = 0;

                return $this->db->insert($this->_table, $new_data);
                break;

            case 'update_pelanggan':
                $new_data['nama']= $data["nama"];
                $new_data['no_hp']= $data["no_hp"];
                $username = $data['username'];
                
                $this->db->set('nama', $new_data['nama'])->set('no_hp', $new_data['no_hp'])->where('username_pelanggan', $username)->update($this->_table);
                return ($this->db->affected_rows() > 0) ? TRUE : FALSE;

            case 'delete_pelanggan':
                $this->db->delete($this->_table,["username_pelanggan"=>$data['username']]);
                return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
        }
    }

    private function notAvailableUsername($username_pelanggan){
        return $this->db->get_where($this->_table,array('username_pelanggan'=>$username_pelanggan))->row();
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

    public function search ($search){
        return  $this->db->like("nama",$search)->or_like("no_hp",$search)->or_like("username_pelanggan",$search)->get($this->_table)->result();
    }
}
