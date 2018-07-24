<?php
require_once(APPPATH.'libraries/getid3/getid3.php');
class Music extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->library('session');
        $this->load->model('Music_model');
    }
    
    
    public function index()
    {
        $this->lang->load('page_label_lang','english');
        $this->load->library('pagination_lib');
        // Retrieve session values of template
        $set_data = $this->session->all_userdata();
        $displayData = $this->pagination_lib->fetchRecord('audio_media_master','music','index');
        $this->load->view('template/navbar_side',$set_data);
        $this->load->view('template/header',$set_data);
        $this->load->view('pages/music',$displayData);
        $this->load->view('template/footer',$set_data);
    
    }
        
    public function doUpload()
    {
        $config['upload_path'] = './uploads/mp3/';
        $config['allowed_types'] = 'mp3';
        $config['encrypt_name']         = TRUE;
        
        
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('mp3file'))
        {
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
        }    
        else
        {
           
            $uploaddata = array('upload_data' => $this->upload->data());
            chmod(FCPATH.'uploads/mp3/'.$uploaddata['upload_data']['file_name'], 0777); 
            $filename = $uploaddata['upload_data']['file_name'];
            $audiofile = $_FILES["mp3file"]["name"];//to get uploaded file name
            
            $getID3 = new getID3;
            $fileInfo = $getID3->analyze(FCPATH.'uploads/mp3/'.$filename);
            // print_r($fileInfo);exit;
            $size = $_FILES["mp3file"]["size"];//to get file size in bytes
            // $duration = date('h:i:s',strtotime($fileInfo['playtime_seconds']));
            // echo $duration;exit;
            $uploaddata = array('upload_data' => $this->upload->data());
            chmod(FCPATH.'uploads/mp3/'.$uploaddata['upload_data']['file_name'], 0777); 
            $data = array(
                'audioFile' => $audiofile,
                'audioTitle' => $fileInfo['tags']['id3v2']['title'][0],
                'audioArtist' => $fileInfo['tags']['id3v2']['artist'][0],
                'audioDuration' => $fileInfo['playtime_string'],
                'audioComposer' => $fileInfo['tags']['id3v2']['composer'][0],
                'audioFilePath' => 'uploads/mp3/'.$uploaddata['upload_data']['file_name'],
                'audioFileSize' => $size,
                'uploadTime' => date("Y-m-d H:i:s")
            );
            
            $this->Music_model->insertData($data);
            echo "success";

        }
        // exit;
    }
    public function getData($audio_id){
        $result = $this->Music_model->getData($audio_id);
        echo json_encode($result);
    }

} 