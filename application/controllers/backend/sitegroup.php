<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Sitegroup extends BaseController
{
    /**
     * This is default constructor of the class
     */
      public function __construct()
      {
          parent::__construct();
          $this->load->model('user_model');
          $this->load->model("Group_model");
          $this->load->helper(array('form', 'url'));
  				$this->load->library('form_validation');
          //$this->isLoggedIn();
          if(empty($this->session->userdata('userId'))) {
              $this->load->helper('url');
              $this->session->set_userdata('last_page', current_url());
              redirect('/login');
          }
      }


     public function index(){
		   
		   $groupmembers = $this->Group_model->joinedMembers();
		  
		   $this->global['members'] = $groupmembers;	
		   $this->global['page_title'] = 'Fit4Site : Profile';
		   $this->global['userprofile'] = $this->user_model->getuserinfobyid();
		   $this->global['roles'] = $this->user_model->getUserRoles();
		   $this->global['mygroups'] = $this->Group_model->getMyGroupList($limit_per_page='',$offset='');
		   $this->global['allgroup'] = $this->Group_model->getAllGroups($limit_per_page='',$offset='');
		   $this->global['joinedGroup'] = $this->Group_model->getMyJoinedGroupList($limit_per_page='',$offset='');
           $page = ($this->uri->segment(4)) ? ($this->uri->segment(4)-1) : '0';
           $limit_per_page = 5;
           $total_records = count($this->global['allgroup']);
           if ($total_records > 0){
             //echo $page*$limit_per_page; die;
               // get current page records
               $this->global["allgroup"] = $this->Group_model->getAllGroups($limit_per_page, $page*$limit_per_page);
               $allgroup = $this->Group_model->getAllGroups($limit_per_page, $page*$limit_per_page);
			   //pre($allgroup); die;
               
			   
			   
			   $config['base_url'] = base_url() . 'backend/sitegroup/index';
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
		   
				
			   
		       $this->global['page_title'] = 'Fit4Site : Group List';
		       $this->global['page_name'] = 'backend/sitegroup';
			   $this->global['no_of_all_group'] = $total_records;
		       $this->load->view("frontend/index", $this->global);
			   
			
			
     }

		 public function create(){

			   $this->global['page_title'] = 'Fit4Site : Create Group';
				 $this->global['userprofile'] = $this->user_model->getuserinfobyid();
				 $this->global['roles'] = $this->user_model->getUserRoles();
				 $this->global['page_title'] = 'Fit4Site : Create Group';
				 $this->global['page_name'] = 'backend/creategroup';
				 $this->load->view("frontend/index", $this->global);


		 }

		 public function postGroup()
		 {
				if(!empty($_POST))
        {

          //pre($invitemailid); die;
					$this->form_validation->set_rules('title','Group Name','required');
					if($this->form_validation->run()==TRUE)
          {
							$config['upload_path'] = './uploads/profile/sitegroup/';
              $config['allowed_types'] = 'gif|jpg|png|jpeg';
							$config['file_name']  = substr(md5(time()), 0, 28);
							$this->load->library('upload', $config);
				      $this->upload->initialize($config);
              $this->upload->do_upload('cover_image');
              $upload_data	= $this->upload->data();
              @chmod('./uploads/',0777);
              $group_image	= $upload_data['file_name'];
              $groupname = $this->input->post('title');
					    $groupdesc = $this->input->post('description');
					    $enable_review = $this->input->post('enable_review');
					    $enable_gallery = $this->input->post('enable_gallery');
					    $group_visibility = $this->input->post('grouptype');
					    $allow = $this->input->post('allow');
					    $created_by = $this->input->post('created_by');
					    $created_at = date('Y-m-d H:i:s a');

               $invitemailid = $this->input->post('invite_emails');
              if(!empty($invitemailid)){
                $this->load->library('email');
                $fromemail="info@fit4site.co.uk";
                $toemail = "girjesh@infiniteloopcorp.com";
                $subject = "Invitation for group join";
                $data=array();

                $config=array(
                'charset'=>'utf-8',
                'wordwrap'=> TRUE,
                'mailtype' => 'html'
                );

                $this->email->initialize($config);
                $loggedinuser = $this->user_model->getuserinfobyid();
                $invitationEmailArray = explode(',',$invitemailid);
                $inviteuserDetails = array();
                if(!empty($invitationEmailArray)){
                  foreach($invitationEmailArray as $key =>$email){
                    $userdetail = $this->user_model->getUserInformationByEmailId($email);
                    $inviteuserDetails[$key]['name'] = $userdetail[0]->name;
                    $inviteuserDetails[$key]['email'] = $userdetail[0]->email;
                    $inviteuserDetails[$key]['username'] = $userdetail[0]->username;
                    $inviteuserDetails[$key]['group_name'] = $this->input->post('title');
                  }

                }
                foreach($inviteuserDetails as $result){
                  $data['result'] =  $result;
                  $data['groupaliase'] = url_title(strtolower(trim($groupname)),'-',true);
                  $mesg = $this->load->view('frontend/backend/groupemailtemplate',$data,true);
                  $this->email->to($result['email']);
                  $this->email->from($fromemail, $loggedinuser[0]->name);
                  $this->email->subject($subject);
                  $this->email->message($mesg);
                  $mail = $this->email->send();
                }
             //echo $this->email->print_debugger(); die;
              }

					    $creategroupdata = array(
                'title'=>$groupname,
                'slug'=>url_title(strtolower(trim($groupname)),'-',true),
                'cover_image'=>$group_image,
                'group_visibility'=>$group_visibility,
                'description'=>$groupdesc,
                'group_inivitation'=>$allow,
                'enable_review'=>$enable_review,
                'enable_gallery'=>$enable_gallery,
								'created_at'=>$created_at,
                'created_by'=>$created_by);

					      $data['creategroup'] = $this->Group_model->insertGroup($creategroupdata);
					      $this->global['userprofile'] = $this->user_model->getuserinfobyid();
	 				      $this->global['roles'] = $this->user_model->getUserRoles();
	 				      $this->global['page_title'] = 'Fit4Site : Create Group';
	 				      $this->global['page_name'] = 'backend/creategroup';
	 				      $this->load->view("frontend/index", $this->global);
					}
          else
          {
						    $this->global['userprofile'] = $this->user_model->getuserinfobyid();
	 				      $this->global['roles'] = $this->user_model->getUserRoles();
	 				      $this->global['page_title'] = 'Fit4Site : Create Group';
	 				      $this->global['page_name'] = 'backend/creategroup';
	 				      $this->load->view("frontend/index", $this->global);
					}
				}
        else
        {
					redirect('backend/sitegroup/mygroup');
				}
		 }

     public function mygroup($offset=''){
       $this->global['page_title'] = 'Fit4Site : My Group';
       $this->global['userprofile'] = $this->user_model->getuserinfobyid();
       $this->global['roles'] = $this->user_model->getUserRoles();
       $this->global['allgroup'] = $this->Group_model->getAllGroups($limit_per_page='',$offset='');
       $this->global['mygroups'] = $this->Group_model->getMyGroupList($limit_per_page='',$offset='');
        $page = ($this->uri->segment(4)) ? ($this->uri->segment(4)-1) : '0';
       $limit_per_page = 1;
       $total_records = count($this->global['mygroups']);
       if ($total_records > 0)
       {
         //echo $page*$limit_per_page; die;
           // get current page records
           $this->global["mygroups"] = $this->Group_model->getMyGroupList($limit_per_page, $page*$limit_per_page);
           //pre($page_data); die;
           $config['base_url'] = base_url() . 'backend/sitegroup/mygroup';
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
       $this->global['page_name'] = 'backend/mygroup';
       $this->load->view("frontend/index", $this->global);
     }
	 
	 
	 
     public function view($requestalias){
		
		$page = ($this->uri->segment(5)) ? ($this->uri->segment(5)-1) : '0';
		$limit_per_page = 10;
		$currentPage = ($this->uri->segment(5)) ? $this->uri->segment(5) : '1';
		
       $result = $this->Group_model->getGroupDetail($requestalias);
	   $group_posts = $this->Group_model->get_groupPosts($requestalias, $limit_per_page, $page*$limit_per_page);
	   $joined = $this->Group_model->get_groupJoined($requestalias);
	   $postLiked = $this->Group_model->postLiked($requestalias); 
	   $postslikes = $this->Group_model->get_groupPostsLikes($requestalias); 
	   $postsComments = $this->Group_model->get_groupPostsComments($requestalias); 
	   
	   $this->global['comments'] = $postsComments; 
	   $this->global['likes'] = $postslikes;
	   $this->global['liked'] = $postLiked;
	   $this->global['joined'] = $joined;
	   $this->global['group_posts'] = $group_posts;
	   $this->global['group'] = $result;
       $this->global['page_name'] = 'backend/group/view_group';
       $this->global['page_title'] = 'Group Information ';
       $this->global['userprofile'] = $this->user_model->getuserinfobyid();
       $this->global['roles'] = $this->user_model->getUserRoles();
	   $this->global['page_num'] = $currentPage;
       $this->load->view("frontend/index", $this->global);
       //pre($result); die;
     }

	 
	 public function view_post($postid){
	   $this->global['page_name'] = 'backend/group/view_post';
       $this->global['page_title'] = 'Single Post';
       $this->global['userprofile'] = $this->user_model->getuserinfobyid();
       $this->global['roles'] = $this->user_model->getUserRoles();
       $this->global['post'] = $this->Group_model->singlePost($postid);
	   
       $this->load->view("frontend/index", $this->global);
		 
	 }	 
	 
	 
     public function getGroupComments(){
       $this->global['page_name'] = 'backend/group/get_group_comment_list';
       $this->global['page_title'] = 'Group comment list';
       $this->global['userprofile'] = $this->user_model->getuserinfobyid();
       $this->global['roles'] = $this->user_model->getUserRoles();
       $this->load->view("frontend/index", $this->global);
     }

     public function aboutGroup($requestalias = ''){
	   $this->global['group'] = $this->Group_model->getGroupDetail($requestalias);
       $this->global['page_name'] = 'backend/group/group_profile';
       $this->global['page_title'] = 'About Group';
       $this->global['userprofile'] = $this->user_model->getuserinfobyid();
       $this->global['roles'] = $this->user_model->getUserRoles();
       $this->load->view("frontend/index", $this->global);
     }
     public function joinGroupMembers($requestalias= ''){
	
	   $this->global['members'] = $this->Group_model->group_members_list($requestalias);
	   $this->global['group'] = $this->Group_model->getGroupDetail($requestalias);
       $this->global['page_name'] = 'backend/group/join_group_members_list';
       $this->global['page_title'] = 'Join Members';
       $this->global['userprofile'] = $this->user_model->getuserinfobyid();
       $this->global['roles'] = $this->user_model->getUserRoles();
       $this->load->view("frontend/index", $this->global);
     }

     public function groupGallery($requestalias= ''){
	   $this->global['group'] = $this->Group_model->getGroupDetail($requestalias);
       $this->global['page_name'] = 'backend/group/group_photos';
       $this->global['page_title'] = 'Group Gallery';
       $this->global['userprofile'] = $this->user_model->getuserinfobyid();
       $this->global['roles'] = $this->user_model->getUserRoles();
       $this->load->view("frontend/index", $this->global);
     }

	 //Ajax Submit Post
	 public function ajaxSubmitPost(){
		$this->load->helper('form');
		$groupid = $this->input->post('groupid');

		if (!is_dir('uploads/groups/'.$groupid)) {
			mkdir('./uploads/groups/'.$groupid, 0777, TRUE);
		 }

		 $config['upload_path']   = './uploads/groups/'.$groupid;
		 $config['allowed_types'] = '*';
		 $config['max_size']  = 10000;
         $this->load->library('upload', $config);

         if ( ! $this->upload->do_upload('file')) {
            $error = array('error' => $this->upload->display_errors());
            $fileInfo = array(
              'message' => 'Not Uploaded',
            );
            echo json_encode($fileInfo);
         }

         else {
            $data = array('upload_data' => $this->upload->data());

			$fileInfo = array(
				'filetype' => $data['upload_data']['file_type'],
				'filename' => $data['upload_data']['file_name'],
        'message' => 'Uploaded',
			);

			print_r(json_encode($fileInfo));

         }

		die();
	 }


  //Post Saved To Database
  public function ajaxAddPost(){
      $this->load->helper('form');

      $data = array(
        'post_type' => $this->input->post('postType'),
        'post_desc' => $this->input->post('postDesc'),
        'group_id'  => $this->input->post('groupId'),
        'user_id'   => $this->input->post('userId'),
        'attachment'=> $this->input->post('postVal'),
        'time' => time()
      );
      $post = $this->db->insert("tbl_group_posts", $data);
      if($post){
        echo json_encode('Post Published');
      }
      die();
  }

  
  
	//Join Group 
	public function joinGroupLeaveGroup(){
		$this->load->helper('form');
		$userProfile = $this->user_model->getuserinfobyid();
		$groupId = $this->input->post('group_id');
		$userid = $userProfile[0]->userId;
		
		$data = array(
			'group_id' => $groupId,
			'user_id' => $userid
		);
		$post = $this->db->insert("tbl_group_members", $data);
		if($post){
			echo json_encode('1');
		}
		die();
	}
	
	//Unjoined Group
	public function unjoinedGroup(){
		$this->load->helper('form');
		$userProfile = $this->user_model->getuserinfobyid();
		$groupId = $this->input->post('group_id');
		$userid = $userProfile[0]->userId;
		
		$this->db->where('group_id', $groupId);
		$this->db->where('user_id', $userid);
		$post = $this->db->delete("tbl_group_members");
		if($post){
			echo json_encode('1');
		}
		die();
	}

	
	//post Like 
	public function postlike(){
		
		$this->load->helper('form');
		$groupId = $this->input->post('group_id');
		$postId = $this->input->post('postid');
		$userProfile = $this->user_model->getuserinfobyid();
		$userid = $userProfile[0]->userId;
		
		$this->db->select('*')
		->from('tbl_post_likes')
		->where('group_id', $groupId)
		->where('post_id', $postId)
		->where('member_id', $userid);
		$result = $this->db->get()->result();
		
		
		
		if(count($result) > 0){
			$this->db->where('group_id', $groupId);
			$this->db->where('member_id', $userid);
			$this->db->where('post_id', $postId);
			$deletelike = $this->db->delete("tbl_post_likes");
			if($deletelike){
				echo json_encode(0);
			}
		}
		else{
			$data = array(
				'group_id' => $groupId,
				'post_id' => $postId,
				'member_id' => $userid
			);
			$post = $this->db->insert("tbl_post_likes", $data);
			if($post){
				echo json_encode(1);
			}
		}
		
		
		die();
	}
	
	// add Comment
	public function addComment(){
		$userProfile = $this->user_model->getuserinfobyid();
		$memberId = $userProfile[0]->userId;
		$groupId = $this->input->post('group_id');
		$postId = $this->input->post('postid');
		$comment = $this->input->post('comment');
		
		$data = array(
			'post_id' 	=> $postId,
			'group_id' 	=> $groupId,
			'member_id' => $memberId,
			'comment' 	=> $comment,
		);
		$post = $this->db->insert("tbl_post_comment", $data);

		
		if($post){
			$res = '';
			$res .= '<li>';
			$res .= '<div class="media">';
			$res .= '<div class="media-left"><div class="userimage"><img src=" '.base_url().'uploads/profile/'.$userProfile[0]->profile_image.' " alt="" class="img-circle img-responsive" /></div></div>';
			$res .= '<div class="media-body"><h5 class="username">'.$userProfile[0]->username.'</h5><small>'.$comment.'</small></div>';
			$res .= '</div">';
			$res .= '</li>';
			
			echo json_encode($res);
			
		}
		die;
		
	}	
	
	//View all comments for posts
	public function vieaAllComments(){
		$postId = $this->input->post('postid');
		$allcomments = $this->Group_model->get_allComments($postId);
		$userProfile = $this->user_model->getuserinfobyid();

		$res = '';
		foreach($allcomments as $comment){
			$res .= '<li>';
			$res .= '<div class="media">';
			$res .= '<div class="media-left"><div class="userimage"><img src=" '.base_url().'uploads/profile/'.$comment->profile_image.' " alt="" class="img-circle img-responsive" /></div></div>';
			$res .= '<div class="media-body"><h5 class="username">'.$comment->username.'</h5><small>'.$comment->comment.'</small></div>';
			$res .= '</div">';
			$res .= '</li>';
		}
		echo json_encode($res);
		die();
	}
	
	
	//members view 
	public function members(){
		$this->load->helper('form');
		$groupId = $this->input->post('groupid');
		$name = $this->input->post('name');
		
		$this->db->select('*');
		$this->db->from('tbl_users');
		$this->db->like('name', $name, 'both');
		$result = $this->db->get()->result();
		
		$res = '';
		foreach($result as $userdata){
			$res .= '<tr>';
			$res .= '<td style="max-width:25px;"><label class="custom-checkbox"><input type="checkbox" name="add_member" class="addMember" value="'.$userdata->userId.'"><span class="checkmark"></span></label></td>';
			$res .= '<td style="max-width:50px;"><img src="'. (empty($userdata->profile_image) ? 'https://s-media-cache-ak0.pinimg.com/originals/5a/59/1c/5a591c4e208e1747894b41ec7f830beb.png' : base_url().'uploads/profile/'. $userdata->profile_image).'" alt="'.$userdata->name.'" class="thumbnail img-responsive user-image"/></td>';
			$res .=	'<td><h5 class="username">'.$userdata->name.'</h5><p class="description">'.$userdata->notes.'</p></td>';
			$res .= '</tr>';
		}
		
		echo json_encode($res);
		die();
	}
	
	//add Members 
	public function addmembers(){
		$this->load->helper('form');
		$groupId = $this->input->post('groupid');
		$members = $this->input->post('members');
		
		foreach($members as $member){
			
			
			$this->db->select('*');
			$this->db->from('tbl_group_members');
			$this->db->where('user_id', $member);
			$this->db->where('group_id', $groupId);
			$memberResult = $this->db->get()->result();
			if(count($memberResult) > 0){
				//already Joined
			}
			else{
				
				$data = array(
					'group_id' => $groupId,
					'user_id' => $member
				);
				$post = $this->db->insert("tbl_group_members", $data); 
			}

		}
		echo json_encode('Members Joined');
		die;
		
	}
	

}

?>
