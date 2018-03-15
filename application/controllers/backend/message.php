<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Message extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('msg_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->isLoggedIn();
    }

    /**
     * This function used to load the first screen of the user
     */
     public function index()
     {
         $user_id = $this->session->userdata('userId');
         $this->global['page_title'] = 'Fit4Site : Message List';
         $this->global['userprofile'] = $this->user_model->getuserinfobyid();
         $this->global['roles'] = $this->user_model->getUserRoles();
         $this->global['page_name'] = 'backend/message/messagelist';
         $this->global['messages'] = $this->msg_model->getMessages($user_id);
         //pre($this->global['messages']); die;
         $this->load->view("frontend/index", $this->global);
     }



     public function composeMessage(){
       $this->global['userprofile'] = $this->user_model->getuserinfobyid();
       $this->global['roles'] = $this->user_model->getUserRoles();
       //pre($this->global['userprofile']); die;
       $this->global['page_title'] = 'Fit4Site : Compose Message';
       $this->global['page_name'] = 'backend/message/composemessage';
       $this->load->view("frontend/index", $this->global);
     }

     public function postComposeMessage(){

       $this->form_validation->set_rules('compose_sendto','Email address can not be blank','required');
       $this->form_validation->set_rules('compose_subject','Email Subject can not be blank', 'required');
       $this->form_validation->set_rules('compose_message','Message can not be blank','required');
       $compose_sendto = $this->input->post('compose_sendto');

       $user_from_id = $this->session->userdata('userId');
       $msg = $this->input->post('compose_message');
       $user_to_id = $this->msg_model->getUserByEmailId(trim($compose_sendto));

       if ($this->form_validation->run() == FALSE)
       {
          $this->global['userprofile'] = $this->user_model->getuserinfobyid();
          $this->global['roles'] = $this->user_model->getUserRoles();
          $this->global['page_title'] = 'Fit4Site : Compose Message';
          $this->global['page_name'] = 'backend/message/composemessage';
          $this->load->view("frontend/index", $this->global);
       }
       else
       {
         $config['upload_path']          = './uploads/mail_attachment/';
         $config['allowed_types']        = 'gif|jpg|png';
         $config['max_size']             = 2448;
         $config['max_width']            = 2048;
         $config['max_height']           = 2048;
         $config['file_name']  = substr(md5(time()), 0, 28);
         $this->load->library('upload', $config);

         if($_FILES['attachment_file']['name']!="")
         {
               $this->upload->initialize($config);
               $this->upload->do_upload('attachment_file');
               $upload_data	= $this->upload->data();
               @chmod('./uploads/',0777);
               $attachedfile	= $upload_data['file_name'];

         }
         $messageArray = array(
              'user_from' => $user_from_id,
              'user_to' => $user_to_id,
              'message' => $this->input->post('compose_message'),
              'status' => 'unread',
              'attached_file' => $attachedfile,
              'date_received' => date('Y-m-d H:i:s')
         );
         if(!empty($user_to_id) && !empty($user_from_id) && !empty($msg)){
              $this->msg_model->insertMessage($messageArray);
              $this->session->set_flashdata('success','Message Sent Successfully!');
              redirect('backend/message');
         }else{
              $this->session->set_flashdata('danger','Something Went Wrong Please Try Again!');
              redirect('backend/composeMessage');
         }
       }
     }

     public function sentMessage(){
       $user_id = $this->session->userdata('userId');
       $this->global['userprofile'] = $this->user_model->getuserinfobyid();
       $this->global['roles'] = $this->user_model->getUserRoles();

       $this->load->library('pagination');
       $limit=1;
       $config['total_rows'] = $this->msg_model->total_rows($user_id);
       $config['per_page'] = $limit;
       $config['uri_segment']=3;
       $config['use_page_numbers'] = TRUE;
       $config['full_tag_open'] = '<div id="paginator">';
       $config['full_tag_close'] = '</div>';
       $this->pagination->initialize($config);
       $page_link = $this->pagination->create_links();

       $start=$this->input->post('page');
       $start=empty($start)?0:($start-1)*$limit;

       $this->global['messages'] = $this->msg_model->getSentMessages($user_id,$start,$limit);
       $this->global['page_title'] = 'Fit4Site : Sent Message';
       $this->global['page_name'] = 'backend/message/sentmessage';
       $this->load->view("frontend/index", $this->global);
     }

     public function deleteMessages()
     {
           $messageIds = $this->input->post('messageIds');
           $fireaction = $this->input->post('fireaction');

          if($fireaction=='selectall'){
           for ($i = 0; $i < sizeof($messageIds); $i++) {
             $this->msg_model->delete_check($messageIds[$i]);
           }

          }else if($fireaction=='readall'){
           echo 'read all';

          }else{
             for ($i = 0; $i < sizeof($messageIds); $i++) {
               $this->msg_model->delete_check($messageIds[$i]);
             }
          }
           exit;
     }

     function updatestarstatus(){
        $starStatus = $this->input->post('starStatus');
        $msg_id = $this->input->post('starValue');
       if($starStatus=='true'){
         $data = array('star_status'=>'starred');
         $this->msg_model->update_star($msg_id,$data);
       }else{
          $data = array('star_status'=>'unstarred');
          $this->msg_model->update_star($msg_id,$data);
       }

        exit;
     }

     public function starrtedMessage(){
       $this->global['userprofile'] = $this->user_model->getuserinfobyid();
       $this->global['roles'] = $this->user_model->getUserRoles();
       //pre($this->global['userprofile']); die;
       $this->global['page_title'] = 'Fit4Site : Starrted Message';
       $this->global['page_name'] = 'backend/message/starrtedmessage';
       $this->load->view("frontend/index", $this->global);
     }

     public function viewReply($msg_id,$userto){

       if(!empty($_POST)){
          $replyMessage = $this->input->post('reply_messages');
          $user_from = $this->session->userdata('userId');
          $user_to = $userto;
          $replyMessageArray = array('message_id'=>$msg_id,'user_from'=>$user_from,'user_to'=>$user_to,'reply_messages'=>trim($replyMessage),'sent_date'=>date('Y-m-d H:i:s'));

          if($this->msg_model->sendReplyMessage($replyMessageArray)){
            //redirect('backend/message/viewReply/'.$msg_id.'/'.$userto);
            redirect($_SERVER['HTTP_REFERER']);
          }
       }else{
         $this->global['userprofile'] = $this->user_model->getuserinfobyid();
         $this->global['roles'] = $this->user_model->getUserRoles();
         $this->global['messages'] = $this->msg_model->getReplyMessage($msg_id);
         $this->global['msg_id'] = $msg_id;
         $this->global['user_to'] = $userto;
         $this->global['page_title'] = 'Message Conversation';
         $this->global['page_name'] = 'backend/message/view_reply';
         $this->load->view("frontend/index", $this->global);
       }

     }


}

?>
