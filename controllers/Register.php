<?php
class Register extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->model('User_model');
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->library('session');
    }
    public function index($msg = NULL)
    {
        $data['msg'] = $msg;
        $this->load->view('pages/register',$data);
    }
    public function sendMail()
    {   
        //check form validation
        $this->form_validation->set_rules('firstname', 'Firstname', 'trim|required');
        $this->form_validation->set_rules('lastname', 'Lastname', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user_db.email]');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[user_db.username]');        
        
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
                $msg = '<p>Set your INSPANIA password by clicking below link.</p></br><a href="http://[::1]/ci_template/index.php/Set_password/" target="_blank">click here</a>';
        
                $this->email->from($from_email, 'INSPANIA'); 
                $this->email->to($to_email);
                $this->email->subject('Set password for INSPANIA'); 
                $this->email->message($msg); 
        
                //Send mail 
                if($this->email->send()) 
                $message='To set password for your INSPANIA account check your email.'; 
                else 
                $message='Error in sending mail';
                $this->index($message); 
                //insert data into database
                $data = array(
                    'firstname' => $this->input->post('firstname') ,
                    'lastname' => $this->input->post('lastname'),
                    'email'=> $this->input->post('email'),
                    'username'=> $this->input->post('username'),
                    'password'=> 'TEST',
                    'status'=> 'Active'
                );
                if(isset($data)){
                    $this->User_model->insertData($data);
                    $last_id = $this->db->insert_id();
                    //set session data
                    $this->session->set_userdata('id',$last_id);
                    $this->session->set_userdata('username',$data['username']);
                    $this->session->set_userdata('email',$data['email']);
                }
                
                //  if($this->session->userdata('id')){
                //    echo "username session set";
                //  }

            }
            else{
                $this->index();
            }
     } 
   
}
?>