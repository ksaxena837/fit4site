<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Msg_model extends CI_Model
{
      function insertMessage($messageArray){
        if(!empty($messageArray)){
          $this->db->insert('tbl_messages',$messageArray);
          return true;
        }
      }

      function getUserByEmailId($recipient_email){

        if(!empty($recipient_email)){
            $this->db->select('userId');
            $this->db->from('tbl_users');
            $this->db->where('email',trim($recipient_email));
            $results = $this->db->get()->result();
           if(!empty($results))
           {
             return $results[0]->userId;
           }
           else
           {
             return false;
           }
        }
      }

      public function getMessages($user_id){
        if(!empty($user_id)){
          $this->db->select('tbl_messages.*');
          $this->db->from('tbl_messages');
          $this->db->where('user_to',trim($user_id));
          return $results = $this->db->get()->result();
        }
      }

      public function getSentMessages($user_id=null,$limit='',$start=''){
        //echo $limit; die;
        if(!empty($user_id)){
          /*$this->db->select('tbl_messages.*');
          $this->db->from('tbl_messages');
          $this->db->where('user_from',trim($user_id));
          return $results = $this->db->get()->result();*/

          $this->db->where('user_from',trim($user_id));
          if(($limit)>0){
            $this->db->limit($limit,$start);
          }
          $result = $this->db->get('tbl_messages');

           return $result->result();
          //echo $this->db->last_query();

        }
      }

      public function total_rows($user_id = '')
      {
        if(!empty($user_id)){
            $this->db->where('user_from',trim($user_id));
          return $this->db->count_all('tbl_messages');
        }
      }

      public function delete_check($msg_id){
        if(!empty($msg_id)){
          $this->db->where('msg_id',trim($msg_id));
          $this->db->delete('tbl_messages');

        }
      }
      public function update_star($msg_id,$data){
        if(!empty($msg_id) && $data){
          $this->db->where('msg_id',trim($msg_id));
          $this->db->update('tbl_messages',$data);

        }
      }

    public function sendReplyMessage($replyMessageArray){
      if(!empty($replyMessageArray)){
        return $this->db->insert('tbl_message_conversation',$replyMessageArray);
      }
    }
    public function getReplyMessage($msg_id){
      if(!empty($msg_id)){

        $this->db->select('tm.message,tmc.*');
        $this->db->from('tbl_messages tm');
        $this->db->join('tbl_message_conversation tmc','tmc.message_id=tm.msg_id','left');
        $query = $this->db->where('tmc.message_id',$msg_id)->get();
        $result = $query->result();
        return $result;
      }
    }

}
