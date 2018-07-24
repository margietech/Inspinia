<?php
class User_model extends CI_Model{
    var $tabel = 'user_master';
    public function __construct()
    {
       parent::__construct();
       $this->load->database();

    }
    public function insertData($data)
    {
        $this->db->insert($this->tabel,$data);
    }
    public function getData()
    {   
        $this->db->where('status!=','Cancel');
        $query = $this->db->get($this->tabel);
        return $query->result_array();
    }
    public function deleteData($id){
        $this->db->where('id',$id);
        $data = array('status'=>'Cancel');
        //print_r($data) ;
        echo $this->db->update($this->tabel, $data);
        return $this->db->affected_rows();

    }
    public function getById($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get($this->tabel);
        return $query->row();
    }
    public function updateData($id,$data){
        $this->db->where('id',$id);
        $this->db->update($this->tabel, $data);
        return $this->db->affected_rows();
    }
    public function updateWhereEmail($email,$data)
    {
        $this->db->where('email',$email);
        $query = $this->db->update($this->tabel, $data);
        if($query ==1){
            return TRUE;
        }
        
    }
    public function updateByStatus($id,$status)
    {
        $this->db->where('id',$id);
        $data = array('status'=> $status);
        $query = $this->db->update($this->tabel, $data);

    }
}
?>