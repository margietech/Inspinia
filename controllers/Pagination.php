<?php
class Pagination extends CI_Controller{
    // public function __construct()
    // {
    //     parent::__construct();
    //     //$this->load->helper(array('url','form','email','security'));
    //     //$this->load->library('session');
    //     //$this->load->database();

    // }
    public function fetchRecord($tabel)
    {    
        //$this->lang->load('page_label_lang','english');
        // Retrieve session values of template
        //$set_data = $this->session->all_userdata();
        $this->load->model('Pagination_model');
        $this->load->library('pagination');
        
        $config = array();
        $config["base_url"] = base_url() . "pagination/fetchRecord";
        
        $total_row = $this->Pagination_model->recordCount($tabel);
        
        $config["total_rows"] = $total_row;
        $config["per_page"] = 3;
        $config['use_page_numbers'] = TRUE;
        $choice = $config["total_rows"] / $config["per_page"];
        $config['num_links'] = round($choice) ;
        // echo $config['num_links'];exit;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 1;
        
        $userdata['userdata'] = $this->Pagination_model->getData($config["per_page"],$page,$tabel);
        //echo "<pre>";print_r($userdata);exit;
        $str_links = $this->pagination->create_links();
        
        $userdata['links'] = explode('&nbsp;',$str_links );
        return json_encode($userdata);
        // print_r($userdata['links'] );exit;
        //retrieve tabel data from database
        //$userdata['userdata'] = $this->User_model->getData();
        // $this->load->view('template/navbar_side',$set_data);
        // $this->load->view('template/header',$set_data);
        // $this->load->view('pages/user_management',$userdata);
        // $this->load->view('template/footer',$set_data);
    }
}
?>