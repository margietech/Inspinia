 <?php
 //Model File ( API_model )
defined('BASEPATH') OR exit('No direct script access allowed');
class Login_api_model extends CI_Model{
    // Read Query
    public function read($id){
        if($id===NULL){
        $replace = "" ;
        }
        else{
        $replace = "=$id";
        }
        $query = $this->db->query("select * from books where id".$replace);
        return $query->result_array();
    }
    // Insert/Create Query
    public function insert($data){
        $this->db->insert('books', $data);
        return TRUE;
    }
    // Delete Query
    public function delete($id){
        $query = $this->db->query("delete from books where id=$id");
        return TRUE;
    }
    // Update Query
    public function update($data){
        $id= $data['id'];
        $this->db->where('id',$id);
        $this->db->update('books',$data);
    }
}
?>