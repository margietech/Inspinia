<?php
//server side
class Login_api extends CI_Controller {
    public function __construct() {
        parent::__construct();
        //$this->output->set_content_type('application/json');
        $this->load->model('Login_model');
    }
    //API's get Method
    public function login(){
        //get the data when type in postman is formdata which reurns text data
        $username = $_POST['username'];
        $password = $_POST['password']; 
        //echo $username;
        // //get the data when type in postman is raw which reurns json encoded data
        // $json = file_get_contents("php://input");
        // //convert the string of data to an array
        // $data = json_decode($json, true);
        // $username = $data['username'];
        // $password = $data['password'];
        // //print_r($data['password']);
        if(empty($username) && empty($password)){
            $response = array(
                'res_code' => '0',
                'res_msg' => "Username or password is empty",
                'res_data' => ''
            );
            echo json_encode($response);
        }
        else{
            $data = $this->Login_model->readUserData($username,$password);
            if ($data[0]->status == 'Active'){
                $user = array(
                    'username' => $data[0]->username,
                    'id' => $data[0]->id,
                    'user_type_id' => $data[0]->user_type_id
                );
                $response = array(
                    'res_code' => '1',
                    'res_msg' => "Login successful",
                    'res_data' =>array('usredata'=>$user)
                );
                echo json_encode($response);
            }
            else{
                $response = array(
                    'res_code' => '0',
                    'res_msg' => "No user found",
                    'res_data' => ''
                );
                echo json_encode($response);
            }
        }  
    }

}
        
