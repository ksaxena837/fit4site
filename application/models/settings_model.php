<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Settings_model extends CI_Model
{
      function updateUserSettings($data)
      {
        $user_id = $this->session->userdata('userId');
        if(!empty($user_id)){
          $this->db->where('userId', $user_id);
          $this->db->update('tbl_users', $data);
          return TRUE;
        }else{
          return false;
        }
      }
}
