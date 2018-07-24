<?php
    class Music_model extends CI_Model{
        var $tabel = 'audio_media_master';
        public function __construct()
        {
            parent::__construct();
            $this->load->database();
        }

        public function insertData($data)
        {
            
            return $this->db->insert($this->tabel,$data);

        }
        public function getData($audio_id){
            $this->db->where('audioId',$audio_id);
            $query = $this->db->get($this->tabel);
            return $query->result_array();
        }
    }