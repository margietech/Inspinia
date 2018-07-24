<?php
class Login extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->model('Login_model');
        $this->load->library('form_validation');
        $this->load->library('session');
    }
    public function index($msg = NULL)
    {
        $data['msg'] = $msg;
        $this->load->view('pages/login',$data);
    }
    public function authentication()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == TRUE)
        {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            
            $result = $this->Login_model->loginData($username,$password);
            if($result == 1){
                $readResult = $this->Login_model->readUserData($username,$password);
                if($readResult != FALSE ){
                    $sess_array = array(
                        'name' => $readResult[0]->firstname." ".$readResult[0]->lastname,
                        'id' => $readResult[0]->id,
                        'user_type_id' => $readResult[0]->user_type_id,
                        'email' =>$readResult[0]->email
                    );
                    $this->session->set_userdata($sess_array);
                    if($this->session->userdata('name')){
                        redirect('/dashboard');
                    }
                }
            }
            else{
                $msg = '<font color=red>Invalid username and/or password.</font><br/><br/>';
                $this->index($msg);
            }
        }
        else{
            $this->index();
        }
    }
}
?>