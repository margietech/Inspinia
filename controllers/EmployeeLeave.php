<?php 
class EmployeeLeave extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url','form'));
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('Leave_model');
    }
    public function index()
    {
        $this->load->library('pagination_lib');
        $this->lang->load('page_label_lang','english');
        // Retrieve session values of template
        $set_data = $this->session->all_userdata();
        $user_id = $this->session->userdata('id');
        $leavedata = $this->pagination_lib->fetchRecordById('leave_master','EmployeeLeave','index',$user_id);

       // $leavedata['data'] = $this->Leave_model->getDataById($user_id);
        $this->load->view('template/navbar_side',$set_data);
        $this->load->view('template/header',$set_data);
        $this->load->view('pages/employee_leave',$leavedata);
        $this->load->view('template/footer',$set_data);

    }
    public function addLeave()
    {
        
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');
        $date = $this->input->post('daterange');
        $date_from = substr($date,0,10 );
        $date_to = substr($date,12,21 );
        $date_from = date('Y-m-d',strtotime($date_from));
        $date_to = date('Y-m-d',strtotime($date_to));
        $leave_type = $this->input->post('leavetype');
        $description = $this->input->post('description');
        //echo $date_from; echo $date_to;exit;
       if ($this->form_validation->run() == TRUE){
            $this->load->library('email');
            $from_email = $this->session->userdata('email');
            $to_email = array(CON_EMAIL_ONE,CON_EMAIL_TWO);
            $name = $this->session->userdata('name');

            $config['protocol']    = 'smtp';
            $config['smtp_host']    = 'ssl://smtp.gmail.com';
            $config['smtp_port']    = '465';
            $config['smtp_timeout'] = '7';
            $config['smtp_user']    = $from_email;
            $config['smtp_pass']    = '1234@margi';
            $config['charset']    = 'utf-8';
            $config['newline']    = "\r\n";
            $config['mailtype'] = 'html';
            $config['validation'] = TRUE;     

            $this->email->initialize($config);

            $this->email->from($from_email,$name); 
            $this->email->to($to_email);
            $subject = $leave_type.'::Request for leave::Date:'.date('d-m-Y',strtotime($date_from)).' to '.date('d-m-Y',strtotime($date_to)); 
            $this->email->subject($subject);
            //$to_email = $this->input->post('email'); 
            //$data['email']=$to_email; 
            //$body = $this->load->view('pages/mail_template',$data,TRUE);
            $this->email->message($description);

            //Send mail 
            if($this->email->send()) {
                $message='Data is successfully submitted.'; 
                $this->session->set_userdata('message',$message);
                //echo $message;
            }
            else{
                $message='Error in sending data.';
                //echo $message; //exit;
                $this->session->set_userdata('message',$message);
                $this->index(); 
            }               

            $data = array(  
                'date_from' => $date_from ,
                'date_to' => $date_to,
                'subject'=> $this->input->post('subject'),
                'description'=> $description ,
                'leave_type' => $leave_type ,
                'leave_status'=> 'Pending',
                'user_id'=> $this->session->userdata('id')

            );
            //print_r($data);exit;
            $this->Leave_model->insertData($data);
            
        }
        else{
            $error_array = array(
                'subject' => form_error('subject'),
                'description' => form_error('description'),
                
            );
            echo json_encode($error_array);  
            return $error_array;
        }
    }
    public function cancelRequest($id)
    {
       $this->Leave_model->updateStatus($id,'Cancel');
        
    }
    public function getAllRequest()
    {
        $this->load->library('pagination_lib');
        $this->lang->load('page_label_lang','english');
        // Retrieve session values
        $set_data = $this->session->all_userdata();
        $data = $this->pagination_lib->fetchRecordByJoin('leave_master','EmployeeLeave','getAllRequest');
       
        
        //$data['data'] = $this->Leave_model->getData();
        $this->load->view('template/navbar_side',$set_data);
        $this->load->view('template/header',$set_data);
        $this->load->view('pages/leave_management',$data);
        $this->load->view('template/footer',$set_data);

    }
    public function approveRequest($id)
    {
        //echo "in controller".$id;
        $result = $this->Leave_model->updateStatus($id,'Approve');
        if($result == 1){
            $this->getAllRequest();
        }
    }
    public function rejectRequest($id)
    {
        $result = $this->Leave_model->updateStatus($id,'Reject');
        if($result == 1){
            $this->getAllRequest();
        }
    }
    public function viewDetail($leave_id)
    {
        //echo $leave_id;exit;
        $result = $this->Leave_model->getDataByLeaveId($leave_id);
        if($result){
            echo json_encode($result);
        }
        else{
            echo "error";
        }
    }
}
?>