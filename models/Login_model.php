<?php
class Login_model extends CI_model{
    var $tabel = 'user_master';
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function loginData($username,$password)
    {
        $data = array(
            'username' =>$username,
            'password'=>$password,
            'status'=>'Active'
        );
        $this->db->where($data);
        $query = $this->db->get($this->tabel);
        if($query->num_rows()==1){
            return TRUE;
        }
    }
    public function readUserData($username,$password)
    {
        $data = array(
            'username' =>$username,
            'password'=>$password,
            'status'=>'active'
        );
        $this->db->where($data);
        $query = $this->db->get($this->tabel);
        if($query->num_rows()==1){
            return $query->result();
        }
    }
}
?>