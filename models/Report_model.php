<?php
class Report_model extends CI_Model{
    var $tabel = 'employee_report_master';
    public function __construct()
    {
       parent::__construct();
       $this->load->database();

    }
    public function insertData($data)
    {
        $this->db->insert($this->tabel,$data);
    }
    public function getDataByReportId($report_id)
    {
        //for view detail
        $this->db->select('*');
        $this->db->from('employee_report_master');
        $this->db->join('task_master', 'employee_report_master.reportId = task_master.reportId');
        //$this->db->where('task_master.reportId', $report_id);
        $this->db->where('employee_report_master.reportId', $report_id);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function insertTaskData($taskdata)
    {   
        $this->db->insert('task_master',$taskdata);
    }
    public function updateData($reportdata,$report_id)
    {
        $this->db->where('reportId',$report_id);
        $this->db->update($this->tabel, $reportdata);
        return $this->db->affected_rows();

    }
    public function updateTaskData($taskdata,$task_id)
    {
        $this->db->where('taskId',$task_id);
        $this->db->update('task_master', $taskdata);
        return $this->db->affected_rows();
    }
    // public function getDataById($report_id,$task_id){
    //     $this->db->select('*');
    //     $this->db->from('employee_report_master');
    //     $this->db->join('task_master', 'employee_report_master.reportId = task_master.reportId');
    //     $this->db->where('task_master.reportId', $report_id);
    //     $this->db->where('task_master.taskId', $task_id);
    //     $query = $this->db->get();
    //     return $query->result_array();
    // }
    public function deleteTaskData($task_id,$report_id){
        $this->db->where('taskId',$task_id);
        $this->db->delete('task_master');
        $this->db->set('totalTask', 'totalTask-1', FALSE);
        $this->db->where('reportId',$report_id);
        $this->db->update($this->tabel);
    }
    public function deleteReport($report_id){
        $this->db->where('reportId',$report_id);
        $data=array('status'=>'Cancel');
        $this->db->update($this->tabel, $data);
    }
}
?>