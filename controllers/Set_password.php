<?php
class Set_password extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }
    public function index($msg = NULL)
    {
        $data['msg'] = $msg;
        $this->load->view('pages/set_password',$data);
        $email = $this->input->get('email');
        $this->session->set_userdata('email',$email);
    }
    public function validate()
    {
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]');
        if ($this->form_validation->run() == TRUE){
            $data = array(
                'password' => $this->input->post('password'),
            );
            $email=$this->session->userdata('email');
            if($email){
                $result = $this->User_model->updateWhereEmail($email,$data);
                if($result == 1){
                    redirect('/Login');
                }
            }
            
            
            
        }
        else{
            $this->index();
        }
    }
}