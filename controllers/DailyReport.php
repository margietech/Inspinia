<?php
class DailyReport extends CI_Controller{
    public function __construct()
    {
       parent::__construct();
       $this->load->helper(array('url','form','email','security'));
       $this->load->model('Report_model');
       $this->load->library('form_validation');
       $this->load->library('session');
       
       $this->load->database();

    }
    public function index()
    {    
        $this->load->library('pagination_lib');
        $this->lang->load('page_label_lang','english');
        // Retrieve session values of template
        $set_data = $this->session->all_userdata();
        $emp_id = $this->session->userdata('id');
        // echo $emp_id;exit;
        $reportdata = $this->pagination_lib->fetchRecordById('employee_report_master','dailyReport','index',$emp_id);
        // print_r($reportdata);
        //retrieve tabel data from database
        //$userdata['userdata'] = $this->User_model->getData();
        $this->load->view('template/navbar_side',$set_data);
        $this->load->view('template/header',$set_data);
        $this->load->view('pages/daily_report',$reportdata);
        $this->load->view('template/footer',$set_data);
    }
    public function newReport()
    {
        $startTime = $this->input->post('startTime');
        $endTime = $this->input->post('endTime');
       // print_r($startTime);exit;
        $this->form_validation->set_rules('task[]', 'Task', 'trim|required');
        // $test1 = array_filter($startTime);
        // $test2 = array_filter($endTime);
        if(empty($startTime[0]) || empty($endTime[0])){
            $this->form_validation->set_rules('startTime[]', 'Duration', 'trim|required');
            $this->form_validation->set_rules('endTime[]', 'Duration', 'trim|required');
            
        } 
        
            if ($this->form_validation->run() == TRUE)
            {
                //to insert data in database
                
                $empId = $this->session->userdata('id');
                
                $date = $this->input->post('dateToday');
                $date = date('Y-m-d',strtotime($date));
                
                $reportdata = array(
                    'date' => $date,                    
                    'generalIssue' => $this->input->post('generalissue'),
                    'totalTask' => $this->input->post('totalTask'),                  
                    'empId'=> $empId,
                );
                if(isset($reportdata)){
                    $this->Report_model->insertData($reportdata);   
                 }
                $reportId = $this->db->insert_id();
                
                $totalTask = $this->input->post('totalTask');
                $task = $this->input->post('task');
                $startTime = $this->input->post('startTime');
                $endTime = $this->input->post('endTime');
                $issue =$this->input->post('issue');
                
                if($totalTask){
                    for($i=0;$i<$totalTask;$i++){
                        $taskdata = array(
                            'task' => $task[$i],
                            'startTime'=> $startTime[$i],
                            'endTime'=> $endTime[$i],
                            'issue'=> $issue[$i],
                            'reportId'=>$reportId,
                            'empId'=> $empId,
                        );
                        //  print_r($taskdata);exit;
                        $this->Report_model->insertTaskData($taskdata);
                    }
                }
                
                
             }
            else{
                $error_array = array(
                    'task' => form_error('task[]'),
                    'endTime' => form_error('endTime[]'),
                    'startTime' => form_error('startTime[]'),
                    
                );
                echo json_encode($error_array);  
                return $error_array;
            }
    }
    public function getAllReport()
    {
        $this->load->library('pagination_lib');
        $this->lang->load('page_label_lang','english');
        // Retrieve session values
        $set_data = $this->session->all_userdata();
        $data = $this->pagination_lib->fetchRecordByJoin('employee_report_master','dailyReport','getAllReport');
       
        
        //$data['data'] = $this->Leave_model->getData();
        $this->load->view('template/navbar_side',$set_data);
        $this->load->view('template/header',$set_data);
        $this->load->view('pages/employee_report',$data);
        $this->load->view('template/footer',$set_data);

    }
    public function viewDetail($report_id)
    {
        //echo $leave_id;exit;
        $result = $this->Report_model->getDataByReportId($report_id);
        if($result){
            echo json_encode($result);
        }
        else{
            echo "error";
        }
    }
    public function editTask()
    {
        // exit;
        $date = $this->input->post('date');
        //echo $date;
        $date = date('Y-m-d',strtotime($date));
        
        $report_id = $this->input->post('reportId');
        // echo $report_id;exit;
        $task_id = $this->input->post('taskId');
        // print_r($task_id) ;exit;
        $newTotalTask = $this->input->post('newTotalTask');
        $totalTask = $this->input->post('edittask');
        
        $reportdata = array(
            'date' => $date,                    
            'generalIssue' => $this->input->post('generalissue'),
            'totaltask' =>$newTotalTask+$totalTask,
        );
        
        // print_r($reportdata);
        if(isset($reportdata)){
            $this->Report_model->updateData($reportdata,$report_id);   
         }
        $totalTask = $this->input->post('edittask');
        $task = $this->input->post('task');
        $startTime = $this->input->post('startTime');
        $endTime = $this->input->post('endTime');
        $issue =$this->input->post('issue');
         if($totalTask){
            for($i=0;$i<$totalTask;$i++){
                $edittaskdata = array(
                    'task' => $task[$i],
                    'startTime'=> $startTime[$i],
                    'endTime'=> $endTime[$i],
                    'issue'=> $issue[$i],
                    
                );
                // print_r($edittaskdata);
                if($edittaskdata){
                    $this->Report_model->updateTaskData($edittaskdata,$task_id[$i]);
                }
                // echo $task_id[$i];
            }
        }
        $newTotalTask = $this->input->post('newTotalTask');
        $newtask = $this->input->post('newtask');
        $newstartTime = $this->input->post('newstartTime');
        $newendTime = $this->input->post('newendTime');
        $newissue =$this->input->post('newissue');
        $empId = $this->session->userdata('id');
        if($newTotalTask){
            for($i=0;$i<$newTotalTask;$i++){
                $taskdata = array(
                    'task' => $newtask[$i],
                    'startTime'=> $newstartTime[$i],
                    'endTime'=> $newendTime[$i],
                    'issue'=> $newissue[$i],
                    'reportId'=>$report_id,
                    'empId'=> $empId,
                );
                //  print_r($taskdata);exit;
                if($taskdata){
                    $this->Report_model->insertTaskData($taskdata);
                }
                
            }
        }
    
    }
    public function getTask($report_id){
        $result = $this->Report_model->getDataByReportId($report_id);
        
        echo json_encode($result);
        // exit;
    }
    
    public function deleteTask($task_id,$report_id){
        $this->Report_model->deleteTaskData($task_id,$report_id);
    }
    public function deleteReport($report_id){
        $this->Report_model->deleteReport($report_id);
    }
}
?>