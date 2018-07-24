<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pagination_api extends CI_Controller{
    
    public function fetchRecord($tabel,$controller,$method)
    {    
        $CI = & get_instance();
        $CI->load->model('Pagination_model');
        $CI->load->library('pagination');
        
        $config = array();
        $config["base_url"] = base_url() . $controller ."/". $method;
        
        $total_row = $CI->Pagination_model->recordCount($tabel);
        
        $config["total_rows"] = $total_row;
        $config["per_page"] = 4;
        $config['use_page_numbers'] = TRUE;
        $choice = $config["total_rows"] / $config["per_page"];
        $config['num_links'] = round($choice) ;
        // echo $config['num_links'];exit;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        $config['uri_segment'] = 3;
        $CI->pagination->initialize($config);
        $page = ($CI->uri->segment(3)) ? $CI->uri->segment(3) : 0;
        
        $data['data'] = $CI->Pagination_model->getData($config["per_page"],$page,$tabel);
        // echo "<pre>";print_r($userdata);exit;
        $str_links = $CI->pagination->create_links();
        
        $data['links'] = explode('&nbsp;',$str_links );
        return json_encode($data);
        
    }
    public function fetchRecordById($tabel,$controller,$method,$id)
    {
        $CI = & get_instance();
        $CI->load->model('Pagination_model');
        $CI->load->library('pagination');    
        
        $config = array();
        $config["base_url"] = base_url() . $controller."/".$method;

        $total_row = $CI->Pagination_model->recordCount($tabel);  

        $config["total_rows"] = $total_row;
        $config["per_page"] = 6;
        $config['use_page_numbers'] = TRUE;
        $choice = $config["total_rows"] / $config["per_page"];
        $config['num_links'] = round($choice) ;
        // echo $config['num_links'];exit;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
         $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        $config['uri_segment'] = 3;

        $CI->pagination->initialize($config);

        $page = ($CI->uri->segment(3)) ? $CI->uri->segment(3) : 0;
        $data['data'] = $CI->Pagination_model->getDataById($config["per_page"],$page,$tabel,$id);

        // echo "<pre>";print_r($userdata);exit;

        $str_links = $CI->pagination->create_links();
        $data['links'] = explode('&nbsp;',$str_links );
        return $data;

    }
    public function fetchRecordByJoin($tabel,$controller,$method)
    {
        $CI = & get_instance();
        $CI->load->model('Pagination_model');
        $CI->load->library('pagination');    
        
        $config = array();
        $config["base_url"] = base_url() . $controller."/".$method;

        $total_row = $CI->Pagination_model->recordCount($tabel);  

        $config["total_rows"] = $total_row;
        $config["per_page"] = 6;
        $config['use_page_numbers'] = TRUE;
        $choice = $config["total_rows"] / $config["per_page"];
        $config['num_links'] = round($choice) ;
        // echo $config['num_links'];exit;
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
         $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        $config['uri_segment'] = 3;

        $CI->pagination->initialize($config);

        $page = ($CI->uri->segment(3)) ? $CI->uri->segment(3) : 0;
        $data['data'] = $CI->Pagination_model->getDataByJoin($config["per_page"],$page);

        // echo "<pre>";print_r($userdata);exit;

        $str_links = $CI->pagination->create_links();
        $data['links'] = explode('&nbsp;',$str_links );
        return $data;

    }
}
?>