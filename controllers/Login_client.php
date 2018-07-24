<?php
// Client File ( Client.php )
class Login_client extends CI_Controller
{
    // User's Login Credentials
    function __construct() {
        parent::__construct();
        $this->load->library('rest', array('server' => 'http://localhost/ci_template',
        'api_key' => 'REST API',
        'api_name' => 'X-API-KEY',
        'http_user' => 'admin',
        'http_pass' => '1234',
        'http_auth' => 'basic',
        ));
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
                        'username' => $readResult[0]->username,
                        'id' => $readResult[0]->id,
                        'user_type_id' => $readResult[0]->user_type_id
                    );
                    $this->session->set_userdata($sess_array);
                    if($this->session->userdata('username')){
                        redirect('/Dashboard');
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
    // Client's Put Method
    function put($id=0){
        if($id==0){
        $this->load->view('read');
        }
        $id = $this->uri->segment(3);
        $this->rest->format('application/json');
        $params = array(
        'id' => $id,
        'book_name' => $this->input->post('dname'),
        'book_price' => $this->input->post('dprice'),
        'book_author' => $this->input->post('dauthor')
        );
        $user = $this->rest->put('index.php/api/data/'.$id, $params,'');
        $this->rest->debug();
    }
    // Client's Post Method
    function post($id=0){
        if($id==0){
        $this->load->view('read');
        }
        $this->rest->format('application/json');
        $params = $this->input->post(NULL,TRUE);
        $user = $this->rest->post('index.php/api/data', $params,'');
        $this->rest->debug();
    }
    // Client's Get Method
    function get($id=0){
        if($id==0){
        $this->load->view('read');
        }
        $id = $this->uri->segment(3);
        $this->rest->format('application/json');
        $params = $this->input->get('id');
        $user = $this->rest->get('index.php/api/data/'.$id, $params,'');
        $this->rest->debug();
    }
    // Client's Delete Method
    function delete($id=0){
        if($id==0){
        $this->load->view('read');
        }
        $id = $this->uri->segment(3);
        $this->rest->format('application/json');
        $user = $this->rest->delete('index.php/api/data/'.$id,'','');
        $this->rest->debug();
    }
}