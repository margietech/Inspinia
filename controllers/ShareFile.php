<?php
class ShareFile extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url','download','util'));
        $this->load->model('Upload_model');
        $this->load->library('session');
    }
    public function index()
    {
        $this->lang->load('page_label_lang','english');
        $this->load->library('pagination_lib');
        // Retrieve session values of template
        $set_data = $this->session->all_userdata();

        //to view uploadFile.php
        $displayData = $this->pagination_lib->fetchRecord('media_master','shareFile','index');
        //$displayData =array('displayData'=>$this->Upload_model->displayData()) ;
        $this->load->view('template/navbar_side',$set_data);
        $this->load->view('template/header',$set_data);
        $this->load->view('pages/share_file', $displayData);
        $this->load->view('template/footer',$set_data);
    }
    public function doUpload()
    {
    
        $userfile = $_FILES["userfile"]["name"];//to get uploaded file name

        $size = $_FILES["userfile"]["size"];//to get file size in bytes
        
        //to load upload library
    
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = '*';
        $config['encrypt_name']         = TRUE;
        $this->load->library('upload', $config);
        
        //to fetch data from upload library and insert it into db 
        if ($this->upload->do_upload('userfile')){
            
            $data =array('upload_data' =>$this->upload->data());
            //print_r ($data);exit;
            chmod(FCPATH.'uploads/'.$data['upload_data']['file_name'], 0777); 
            
            $this->Upload_model->insertData($data,$userfile,$size);
            
        }
    }

    public function deleteFile($id,$filename)
    {
        $this->Upload_model->deleteData($id,$filename); 
         
    }
}
?>