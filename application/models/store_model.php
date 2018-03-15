<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Store_model extends CI_Model
{
    public function get_business_detail($user_id){
      $this->db->select('*');
      $this->db->from('tbl_user_business_details');
      $query = $this->db->where('user_id',$user_id);
      $result = $query->get()->result();
      if(!empty($result)){
        return $result;
      }else{
        return NULL;
      }
    }
    public function insertBusinessDetail($data){
        $this->db->insert('tbl_user_business_details',$data);
        $insert_id = $this->db->insert_id();
    }
    public function updateBusinessDetail($user_id,$data){
      if(!empty($data) && !empty($user_id)){
        $this->db->where('user_id',$user_id);
        $this->db->update('tbl_user_business_details',$data);
        return true;
      }
    }


}
