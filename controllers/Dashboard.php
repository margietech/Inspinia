<?php
class Dashboard extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url'));
        $this->load->library('session');
    }
    public function index()
    {
        $this->lang->load('page_label_lang','english');
        //load language folder
        $this->lang->load('template_label_lang','english');

        //create session array of template
        $template_data = array(
            'Logout' => $this->lang->line('Logout'),
            'Profile' => $this->lang->line('Profile'),
            'Contacts' => $this->lang->line('Contacts'),
            'Mailbox' => $this->lang->line('Mailbox'),
            'Dashboard' => $this->lang->line('Dashboard'),
            'Share' => $this->lang->line('Share'),
            'User Management' => $this->lang->line('User Management'),
            'Leave' => $this->lang->line('Leave'),
            'Employee Leave Requests' => $this->lang->line('Employee Leave Requests'),
            'Daily Report' => $this->lang->line('Daily Report'), 
            'Employee Report' => $this->lang->line('Employee Report'),
            'Music'=> $this->lang->line('Music'),
        );
        // Set values in session of template 
        $this->session->set_userdata('session_data', $template_data);

        // Retrieve session values of template
        $set_data = $this->session->all_userdata();


        $this->load->view('template/navbar_side', $set_data);
        $this->load->view('template/header', $set_data);
        $this->load->view('pages/dashboard');
        $this->load->view('template/footer', $set_data);
        
    }
}
?>