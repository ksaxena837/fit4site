<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Memberlist extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->helper(array('form', 'url'));
        $this->isLoggedIn();
    }

    /**
     * This function used to load the first screen of the user
     */
     public function index()
     {
           $this->load->library('pagination');
           $this->global['page_title'] = 'Fit4Site : Profile';
					 $this->global['userprofile'] = $this->user_model->getuserinfobyid();
					 $this->global['roles'] = $this->user_model->getUserRoles();
					 //$this->global['memberlist'] = $this->user_model->get_member_list();
           $this->global['followinglist'] = $this->user_model->get_following_list();
           $this->global['followerids'] = $this->user_model->get_follower_ids();

           $this->global['followingmembers'] = $this->user_model->get_following_members();
           $this->global['followermembers'] = $this->user_model->get_follower_members();

           $limit_per_page = 5;
           $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 1;
           $total_records = count($this->user_model->get_member_list($limit='',$start=''));
           if ($total_records > 0)
           {

               // get current page records
              $this->global['memberlist'] = $this->user_model->get_member_list($limit_per_page, $page*$limit_per_page);
               //pre($page_data); die;
               $config['base_url'] = base_url() . 'backend/memberlist/index/';
               $config['total_rows'] = $total_records;
               $config['per_page'] = $limit_per_page;
               $config["uri_segment"] = 4;

               $config['num_links'] = 2;
               $config['use_page_numbers'] = TRUE;
               $config['reuse_query_string'] = TRUE;

               $config['full_tag_open'] = '<nav id="job-listing-pagination"><ul class="pagination pull-right">';
               $config['full_tag_close'] = '</ul></nav>';
               $config['next_link'] = '<span aria-hidden="true">&raquo;</span>';
               $config['next_tag_open'] = '<li>';
               $config['next_tag_close'] = '</li>';

               $config['prev_link'] = '<span aria-hidden="true">&laquo;</span>';
               $config['prev_tag_open'] = '<li>';
               $config['prev_tag_close'] = '</li>';

               $config['cur_tag_open'] = '<li class="active"><span>';
               $config['cur_tag_close'] = '</span></li>';

               $config['num_tag_open'] = '<li>';
               $config['num_tag_close'] = '</li>';
               $this->pagination->initialize($config);
               // build paging links
               $this->global["links"] = $this->pagination->create_links();
           }
           $this->global['no_of_all_members'] =  $total_records;
					 $this->global['page_title'] = 'Fit4Site : Members';
					 $this->global['page_name'] = 'backend/memberlist';
					 $this->load->view("frontend/index", $this->global);

     }
     public function followUnfollow(){
        $user_id = $this->session->userdata('userId');
         $leader_id = $this->input->post('followerid');
         if(!empty($leader_id) && !empty($user_id)){
           $friendData = array('user_id'=>$user_id,'leader_id'=>$leader_id,'subscribed_at' => date('Y-m-d h:i:s'));
           $result = $this->user_model->updateFollowUnfollow($friendData);
           echo $result; exit;
         }

     }
     public function viewMemberDetail($friend_id){
       $friend_id = $friend_id/224;
       $this->global['memberinfo'] = $this->user_model->getUserInfo($friend_id);
       $this->global['userprofile'] = $this->user_model->getuserinfobyid();
       $this->global['roles'] = $this->user_model->getUserRoles();

       //pre($this->global); die;
       $this->global['page_title'] = 'Fit4Site : Member Information';
       $this->global['page_name'] = 'backend/viewMemberDetail';
       $this->load->view("frontend/index", $this->global);

     }


}

?>
