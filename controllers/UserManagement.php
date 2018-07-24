<?php 
// require_once(APPPATH.'libraries/Pagination.php');
class UserManagement extends CI_Controller{
    public function __construct()
    {
       parent::__construct();
       $this->load->helper(array('url','form','email','security'));
       $this->load->model('User_model');
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
        // $pagination = new Pagination();
        $userdata = $this->pagination_lib->fetchRecord('user_master','userManagement','index');
        //retrieve tabel data from database
        //$userdata['userdata'] = $this->User_model->getData();
        $this->load->view('template/navbar_side',$set_data);
        $this->load->view('template/header',$set_data);
        $this->load->view('pages/user_management',$userdata);
        $this->load->view('template/footer',$set_data);
    }
    public function addUser()
    {
       
        $this->form_validation->set_rules('firstname', 'Firstname', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Lastname', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user_master.email]');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[user_master.username]');        
        
            if ($this->form_validation->run() == TRUE)
            {
                $from_email = "margib.etechmavens@gmail.com"; 
                $to_email = $this->input->post('email'); 
        
                //Load email library 
                $this->load->library('email');
                
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

                $this->email->from($from_email, 'INSPANIA'); 
                $this->email->to($to_email);
                $this->email->subject('Set password for INSPANIA');
                $to_email = $this->input->post('email'); 
                $data['email']=$to_email; 
                $body = $this->load->view('pages/mail_template',$data,TRUE);
                $this->email->message($body);
    
                //Send mail 
                if($this->email->send()) {
                    $message='Data is successfully submitted.'; 
                    $this->session->set_userdata('message',$message);
                }
                else{
                    $message='Error in sending data.';
                    $this->session->set_userdata('message',$message);
                    $this->index(); 
                }               
        
                //to insert data in database
                $data = array(
                    'firstname' => $this->input->post('firstname') ,
                    'lastname' => $this->input->post('lastname'),
                    'email'=> $this->input->post('email'),
                    'username'=> $this->input->post('username'),
                    'password'=> "TEST",
                    'status'=> $this->input->post('status'),
                    'user_type_id'=> 2
                );
                if(isset($data)){
                    $this->User_model->insertData($data);
                    $last_id = $this->db->insert_id();
                    $this->session->set_userdata('id',$last_id);
                    
                }
            }
            else
            {

                $error_array = array(
                    'firstname' => form_error('firstname'),
                    'lastname' => form_error('lastname'),
                    'email' => form_error('email'),
                    'username' => form_error('username'),
                    
                );
                echo json_encode($error_array);  
                return $error_array;
            }
        
    }
    public function deleteUser($id)
    {
        $this->User_model->deleteData($id);
    }
    public function editUser($id)
    {
        $userdata = $this->User_model->getById($id);
        echo json_encode($userdata);
        
    }
    public function updateUser()
    {
        $this->form_validation->set_rules('firstname', 'Firstname', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Lastname', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
       
            if ($this->form_validation->run() == TRUE){
                $data = array(  
                    'firstname' => $this->input->post('firstname') ,
                    'lastname' => $this->input->post('lastname'),
                    'email'=> $this->input->post('email'),
                    'username'=> $this->input->post('username'),
                    'status'=> $this->input->post('status')
                );
                $id =$this->input->post('id'); 
                $this->User_model->updateData($id,$data);
            }
            else
            {

                $error_array = array(
                    'firstname' => form_error('firstname'),
                    'lastname' => form_error('lastname'),
                    'email' => form_error('email'),
                    'username' => form_error('username'),
                    'password' => form_error('password'),
                    'cpassword' => form_error('cpassword')
                );
                echo json_encode($error_array);  
                return json_encode($error_array);
            }
        }
        public function changeStatus($id,$status)
        {
           // echo $status;exit;
            $this->User_model->updateByStatus($id,$status);
        }
}
?>