<?php
    class Upload_model extends CI_Model{
        var $tabel = 'media_master';
        public function __construct()
        {
            parent::__construct();
            $this->load->database();
        }

        public function insertData($data,$userfile,$fileSize)
        {
            //$fileSize = FileSizeConvert($size);
            $data = array(
                'file' => $userfile,
                'filePath' => '/uploads/'.$data['upload_data']['file_name'],
                'size' => $fileSize,
                'clientIP' => $_SERVER['REMOTE_ADDR'],
                'uploadtime' => date("Y-m-d H:i:s")
            );
            return $this->db->insert($this->tabel,$data);

        }

        public function displayData(){
            $this->db->order_by('id','DESC');
            $query=$this->db->get($this->tabel);
            return $query->result_array();
        }

        public function deleteData($id,$filename)
        {
            $this->db->where('id',$id);
            $this->db->delete($this->tabel);
            $path = FCPATH.'uploads/'.$filename;
            unlink($path);
        }
    }
?>