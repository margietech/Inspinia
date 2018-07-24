<?php
class Leave_model extends CI_Model{
    var $tabel = 'leave_master';
    public function __construct(Type $var = null)
    {
        
        parent::__construct();
        $this->load->database();
    }
    public function getData()
    {
        $this->db->select('*');
        $this->db->from($this->tabel);
        $this->db->join('user_master', 'leave_master.user_id = user_master.id');
        $this->db->where('leave_master.leave_status!=', 'Cancel');

        $query = $this->db->get();
        // $this->db->where('status!=','Cancel');
        // $query = $this->db->get($this->tabel);
        return $query->result_array();
    }
    public function insertData($data)
    {
        $this->db->insert($this->tabel,$data);
    }
    public function deleteData($id){
        $this->db->where('leave_id',$id);
        $this->db->delete($this->tabel);

    }
    public function getDataById($user_id)
    {
        $this->db->where('leave_status!=','Cancel');
        $this->db->where('user_id',$user_id);
        $query = $this->db->get($this->tabel);
        return $query->result_array();
    }
    public function updateStatus($id,$status)
    {
        //echo $id;echo $status;exit;
        $data =array(
            'leave_status' =>$status,
        );
        //print_r($data);echo $id;exit;
        $this->db->where('leave_id',$id);
        $this->db->update($this->tabel,$data);
        return true;
    }
    public function getDataByLeaveId($leave_id){
        $this->db->where('leave_id',$leave_id);
        $query = $this->db->get($this->tabel);
        return $query->result_array();
    }
}
?>