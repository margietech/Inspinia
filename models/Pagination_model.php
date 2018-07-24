<?php
class Pagination_model extends CI_Model{
    public function __construct()
    {
       parent::__construct();
       $this->load->database();

    }
    public function recordCount($table)
    {
        return $this->db->count_all($table,false);
        //return $this->db->insert_id();
        // $this->db->select_max($id);
        // $query = $this->db->get($table); 
        // return $query->result_array();
    }
    public function getData($limit,$start,$table)
    {
        $this->db->limit($limit,$start);
        if($table == 'user_master'){
            $this->db->where('status!=', 'Cancel');
        }   
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            
            return $data;
        }
        return false;
    }
    public function getDataById($limit,$start,$table,$id)
    {
        $this->db->limit($limit,$start);
        if($table == 'leave_master'){
            $this->db->where('user_id', $id);
            $this->db->where('leave_status!=','Cancel');
        }
        elseif($table == 'employee_report_master'){
            $this->db->where('empId', $id);
            $this->db->where('status!=','Cancel');
        }
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;

    }
    public function getDataByJoin($limit,$start,$table)
    {
        if($table=="leave_master"){
            $this->db->limit($limit,$start);
            $this->db->select('*');
            $this->db->from('leave_master');
            $this->db->join('user_master', 'leave_master.user_id = user_master.id');
            $this->db->where('leave_master.leave_status!=', 'Cancel');
        }
        elseif($table=="employee_report_master"){
            $this->db->limit($limit,$start);
            $this->db->select('*');
            $this->db->from('employee_report_master');
            $this->db->join('user_master', 'employee_report_master.empId = user_master.id');
            $this->db->where('employee_report_master.status!=', 'Cancel');
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
    
}
?>