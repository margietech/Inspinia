<?php
class Profile_model extends CI_Model{
    var $tabel = 'profile_master';
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function getDataById($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get($this->tabel);
        return $query->result_array();
    }
    public function updateData($id,$data){
        $this->db->where('id',$id);
        $this->db->update($this->tabel, $data);
        return $this->db->affected_rows();
    }

}
?>