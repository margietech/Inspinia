<?php 
class Profile extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('url','form')); 
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('Profile_model');
    }
    public function index(){
        $this->lang->load('page_label_lang','english');
        
        // Retrieve session values of template
        $set_data = $this->session->all_userdata();
        //to view profile.php
        $user_id = $this->session->userdata('id');      
        $displayData['displayData'] =$this->Profile_model->getDataById($user_id);
       
        $this->load->view('template/navbar_side',$set_data);
        $this->load->view('template/header',$set_data);
        $this->load->view('pages/profile',$displayData);
        $this->load->view('template/footer',$set_data);
    }
    public function editProfile(){
        $this->form_validation->set_rules('city', 'city', 'trim|required');
        $this->form_validation->set_rules('country', 'country', 'trim|required');
        $this->form_validation->set_rules('designation', 'designation', 'trim|required');
        if ($this->form_validation->run() == TRUE)
        {
            $data = array(
                'city' => $this->input->post('city') ,
                'country' => $this->input->post('country'),
                'designation'=> $this->input->post('designation'),
                
            );
            $user_id = $this->session->userdata('id');   
            if(isset($data)){
                $this->Profile_model->updateData($user_id,$data);
            }
        }
        else
        {
            $error_array = array(
                'city' => form_error('city'),
                'country' => form_error('country'),
                'designation' => form_error('designation'),
                
            );
            echo json_encode($error_array);  
            return $error_array;
        }        
       
    }
}
?>