<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Profile extends BaseController
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
        $this->isLoggedIn();
    }

    /**
     * This function used to load the first screen of the user
     */
     public function index()
     {
         $this->global['page_title'] = 'Fit4Site : Profile';

             $this->global['page_title'] = 'Fit4Site : Profile';
             $this->global['page_name'] = 'backend/profile';

             $this->load->view("frontend/index", $this->global);

     }

     public function editprofile(){
       $user_id = $this->session->userdata('userId');
   	     $this->load->library('form_validation');
   		 if(!empty ($_POST)) {
         		 $this->form_validation->set_rules('useremail','Email','required');
         		 $this->form_validation->set_rules('usermobile','Mobile','required');
         		 $this->form_validation->set_rules('username','Name','required');
   		  if($this->form_validation->run() == FALSE)
        {
         			$this->global['userprofile'] = $this->user_model->getuserinfobyid();
              $this->global['roles'] = $this->user_model->getUserRoles();

              $this->global['page_title'] = 'Fit4Site : Change Profile';
              $this->global['page_name'] = 'backend/edit_profile';
              $this->load->view("frontend/index", $this->global);

        }else {
             		$usereducation = $this->input->post('usereducation');
             		 $userlocation = $this->input->post('userlocation');
             		$userskills = $this->input->post('userskills');
             		$usernotes = $this->input->post('usernotes');
             		$useremail = $this->input->post('useremail');
             		$usermobile = $this->input->post('usermobile');
             		$username = $this->input->post('username');
                $roleId = $this->input->post('role');
                $lat = $this->input->post('lat');
                $lng = $this->input->post('lng');

                if($_FILES['userfile']['name']==''){
                   $mainimagefilename = $this->input->post('old_profile_image');

                 }else{
                   $unlink = $this->input->post('old_profile_image');
                   $config['upload_path'] = './uploads/profile/';
                   $config['allowed_types'] = 'gif|jpg|png|jpeg';
                   $config['file_name']  = substr(md5(time()), 0, 28);

                   //$config['file_name'] = strtolower($_FILES['product_image']['name']);
                   $this->load->library('upload', $config);

                   $this->upload->initialize($config);
                   $this->upload->do_upload('userfile');
                   $upload_data	= $this->upload->data();
                     @chmod('./uploads/',0777);


                   $mainimagefilename	= $upload_data['file_name'];
                   $config1['image_library'] = 'gd2';
                   $config1['source_image'] = "./uploads/profile/$mainimagefilename";
                   //$config1['create_thumb'] = TRUE;
                   $config1['new_image'] = "./uploads/profile/profile_thumb/$mainimagefilename";
                   $config1['maintain_ratio'] = FALSE;
                   $config1['width']         = 300;
                   $config1['height']       = 200;
                   $this->load->library('image_lib', $config1);
                   $this->image_lib->resize();
                   unlink('uploads/profile/'.$unlink);
                   unlink('uploads/profile/profile_thumb/'.$unlink);

                }


             		$usersprofileData = array('education'=>$usereducation, 'location'=>$userlocation,
                                             'skills'=>$userskills, 'notes'=>$usernotes, 'email'=>$useremail, 'mobile'=>$usermobile, 'name'=>$username,'roleId'=>$roleId,'lat'=>$lat,'lng'=>$lng,'profile_image'=>$mainimagefilename);
             		$this->global['insertuserprofile'] = $this->user_model->insertuserinfo_byid($usersprofileData);

             		redirect('backend/profile/editprofile');

   		         }
   		 }
      else
      {
           		$this->global['userprofile'] = $this->user_model->getuserinfobyid();
              $this->global['roles'] = $this->user_model->getUserRoles();
              //pre($this->global['userprofile']); die;
              $this->global['page_title'] = 'Fit4Site : Change Profile';
              $this->global['page_name'] = 'backend/edit_profile';
              $this->load->view("frontend/index", $this->global);
   		}


     }

     public function memberlist(){
       $this->global['userprofile'] = $this->user_model->getuserinfobyid();
       $this->global['roles'] = $this->user_model->getUserRoles();
       //pre($this->global['userprofile']); die;
       $this->global['page_title'] = 'Fit4Site : Members';
       $this->global['page_name'] = 'backend/memberlist';
       $this->load->view("frontend/index", $this->global);
     }

     public function sitegroup(){

       $this->global['userprofile'] = $this->user_model->getuserinfobyid();
       $this->global['roles'] = $this->user_model->getUserRoles();
       //pre($this->global['userprofile']); die;
       $this->global['page_title'] = 'Fit4Site : Group List';
       $this->global['page_name'] = 'backend/sitegroup';
       $this->load->view("frontend/index", $this->global);
     }

     public function creategroup(){

       $this->global['userprofile'] = $this->user_model->getuserinfobyid();
       $this->global['roles'] = $this->user_model->getUserRoles();
       //pre($this->global['userprofile']); die;
       $this->global['page_title'] = 'Fit4Site : Create Group';
       $this->global['page_name'] = 'backend/creategroup';
       $this->load->view("frontend/index", $this->global);
     }

	      public function uploadcover(){
			//pre($_FILES['file']); die;
          //upload cover file
        $config['upload_path'] = './uploads/profile/profile_cover';
                   $config['allowed_types'] = 'gif|jpg|png|jpeg';
                   $config['file_name']  = substr(md5(time()), 0, 28);

        if (isset($_FILES['file']['name'])) {
            if (0 < $_FILES['file']['error']) {
                echo 'Error during file upload' . $_FILES['file']['error'];
            } else {
                if (file_exists('uploads/profile/profile_cover/' . $_FILES['file']['name'])) {
                    echo 'File already exists : uploads/profile/profile_cover/' . $_FILES['file']['name'];
                } else {
                    $this->load->library('upload', $config);
					@chmod('./uploads',0777);
                    if (!$this->upload->do_upload('file')) {
                        echo $this->upload->display_errors();
                    } else {
						  $upload_data	= $this->upload->data();
						  $profilecover = $upload_data['file_name'];
						  $usersprofileData1 = array('cover_image'=>$profilecover);
             		      $this->global['insertusercover'] = $this->user_model->insertusercover_byid($usersprofileData1);
						  //$this->global['usercover'] = $this->user_model->getusercover();
                        echo  $profilecover; exit;
                    }
                }
            }
                } else {
                    echo 'Please choose a file';
                }

           		$this->global['userprofile'] = $this->user_model->getuserinfobyid();
              $this->global['roles'] = $this->user_model->getUserRoles();
              //pre($this->global['userprofile']); die;
              $this->global['page_title'] = 'Fit4Site : Change Profile';
              $this->global['page_name'] = 'backend/edit_profile';
              $this->load->view("frontend/index", $this->global);
     }

		
	/*
	|-------------------------
	**************************
	*****--------------------- INTERIOR WALL ----------------*****
	**************************
	|-------------------------
	*/
     public function activity(){
       $this->global['userprofile'] = $this->user_model->getuserinfobyid();
       $this->global['roles'] = $this->user_model->getUserRoles();
       //pre($this->global['userprofile']); die;
       $this->global['page_title'] = 'Fit4Site : INTERIOR WALL';
       $this->global['page_name'] = 'backend/group/activity';
       $this->load->view("frontend/index", $this->global);
     }
	 
	 public function interiorwall($wallid){

	 
	   $getUserInfo = $this->user_model->getUserInfo($wallid);
	   
	   $page = ($this->uri->segment(5)) ? ($this->uri->segment(5)-1) : '0';
	   $limit_per_page = 10;
	   $currentPage = ($this->uri->segment(5)) ? $this->uri->segment(5) : '1'; 
				
	   $followed = 	$this->Group_model->followedWall($wallid);
	   $walluserInfo = $this->Group_model->followedWall($wallid);
	   $postsComments = $this->Group_model->get_wallPostsComments($wallid); 
	   $postLiked = $this->Group_model->wallpostLiked($wallid); 
	   $postslikes = $this->Group_model->get_wallPostsLikes($wallid); 
	   $this->global['comments'] = $postsComments;  
	   $this->global['followed'] = $followed;
	   $this->global['likes'] = $postslikes;
	   $this->global['liked'] = $postLiked; 
	   $this->global['wallPosts'] = $this->Group_model->get_wallPosts($wallid, $limit_per_page, $page*$limit_per_page);	   
	   $this->global['userprofile'] = $this->user_model->getuserinfobyid();
	   $this->global['wallInfo'] = $getUserInfo;
       $this->global['roles'] = $this->user_model->getUserRoles();
       //pre($this->global['userprofile']); die;
       $this->global['page_title'] = 'Fit4Site : INTERIOR WALL';
       $this->global['page_name'] = 'backend/group/interiorwall';
	   $this->global['wall_id'] = $wallid;
	   $this->global['page_num'] = $currentPage;
       $this->load->view("frontend/index", $this->global);
	 }
	 
	 //Ajax Submit Post By Interior Wall
	 public function ajaxSubmitPost(){
		$userid = $this->session->userdata('userId');
		$this->load->helper('form');
		$userWallId = $this->input->post('wall_id');

		
		if (!is_dir('uploads/wall/'.$userWallId)) {
			mkdir('./uploads/wall/'.$userWallId, 0777, TRUE);
		 }

		 $config['upload_path']   = './uploads/wall/'.$userWallId;
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
	 
	  //Post Saved To Database Interior Wall
	  public function ajaxAddPost(){
		  $this->load->helper('form');

		  $data = array(
			'post_type' => $this->input->post('postType'),
			'post_desc' => $this->input->post('postDesc'),
			'wall_id'  => $this->input->post('wallId'),
			'user_id'   => $this->input->post('userId'),
			'attachment'=> $this->input->post('postVal'),
			'time' => time()
		  );
		  $post = $this->db->insert("tbl_wall_post", $data);
		  if($post){
			echo json_encode('Post Published');
		  }
		  die();
	  }
	  
	  
	//post Like On wall
	public function postlike(){
		
		$this->load->helper('form');
		$wallid = $this->input->post('wallid');
		$postId = $this->input->post('postid');
		$userProfile = $this->user_model->getuserinfobyid();
		$userid = $userProfile[0]->userId;
		
		$this->db->select('*')
		->from('tbl_wall_post_likes')
		->where('wall_id', $wallid)
		->where('post_id', $postId)
		->where('member_id', $userid);
		$result = $this->db->get()->result();
		
		if(count($result) > 0){
			$this->db->where('wall_id', $wallid);
			$this->db->where('member_id', $userid);
			$this->db->where('post_id', $postId);
			$deletelike = $this->db->delete("tbl_wall_post_likes");
			if($deletelike){
				echo json_encode(0);
			}
		}
		else{
			$data = array(
				'wall_id' => $wallid,
				'post_id' => $postId,
				'member_id' => $userid
			);
			$post = $this->db->insert("tbl_wall_post_likes", $data);
			if($post){
				echo json_encode(1);
			}
		}
		
		
		die();
	}
	
	// add Comment on Wall
	public function addComment(){
		$userProfile = $this->user_model->getuserinfobyid();
		$memberId = $userProfile[0]->userId;
		$wall_id = $this->input->post('wall_id');
		$postId = $this->input->post('postid');
		$comment = $this->input->post('comment');
		
		$data = array(
			'post_id' 	=> $postId,
			'wall_id' 	=> $wall_id,
			'member_id' => $memberId,
			'comment' 	=> $comment,
		);
		$post = $this->db->insert("tbl_wall_post_comment", $data);

		
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
		$allcomments = $this->Group_model->get_all_wallComments($postId);
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
	
	public function searchwall(){
		$searchName = $this->input->get('name');
		$this->db->select('*');
		$this->db->from('tbl_users');
		$this->db->like('name', $searchName, 'both');
		$result = $this->db->get()->result();
		
		$res = '<ul class="list-unstyled">';
		foreach($result as $userdata){
			$res .= '<li class="media" data-name="'.$userdata->name.'" data-id="'.$userdata->userId.'">';
			$res .= '<div class="media-left">
						<img src="'. (empty($userdata->profile_image) ? 'https://s-media-cache-ak0.pinimg.com/originals/5a/59/1c/5a591c4e208e1747894b41ec7f830beb.png' : base_url().'uploads/profile/'. $userdata->profile_image).'" alt="'.$userdata->name.'" class="media-object img-responsive user-image"/>
					</div>';
			$res .= '<div class="media-body">';
			$res .= '<h4 class="media-heading">'.$userdata->name.'</h4>';
			$res .= '</div>';
			$res .= '</li>';
		}	
		$res .= '</ul>';
		echo json_encode($res);
		die;
	}
	
	/*
	|-------------------------
	**************************
	*****--------------------- END OF INTERIOR WALL ----------------*****
	**************************
	|-------------------------
	*/
	
	 
	 

     public function getF4SGallery(){
       $user_id = $this->session->userdata('userId');
       $this->global['userprofile'] = $this->user_model->getuserinfobyid();
       $this->global['roles'] = $this->user_model->getUserRoles();
       $this->global['galleries'] = $this->user_model->getF4SGalleryFiles($user_id);
       $mygallery = $this->user_model->getGalleryTitlerDes($user_id);


       $galleryInformation = array();
       foreach($mygallery as $gal){
        $galleryInformation = $this->user_model->getGalleryFilesById($gal->id);
        $gal->gallery_files = $galleryInformation;
       }
       $this->global['galleries'] = $mygallery;
      //pre($this->global['mediainformation']); die;
       $this->global['page_title'] = 'Fit4Site : F4S Docs';
       $this->global['page_name'] = 'backend/fitforsite_docs';
       $this->load->view("frontend/index", $this->global);
     }

     public function getF4sDocument(){
       $this->global['userprofile'] = $this->user_model->getuserinfobyid();
       $this->global['roles'] = $this->user_model->getUserRoles();
       $this->global['page_title'] = 'Fit4Site : Create Gallery';
       $this->global['page_name'] = 'backend/get_gallery_information';

       $this->load->view("frontend/index", $this->global);
     }

     public function postF4sDocument(){
         $user_id  = $this->session->userdata('userId');
         $docsArray = array(
                'user_id'   => $user_id,
                'title'     => $this->input->post('gallery_title'),
                'description' => $this->input->post('gallery_description'),
                'doc_type'  => $this->input->post('file_type'),
                'doc_visibilty' => $this->input->post('file_status')
         );
          $doc_id = $this->user_model->saveF4SDocument($docsArray);
          $number_of_files = sizeof($_FILES['mediafile']['tmp_name']);
          $files = $_FILES['mediafile'];
          $errors = array();
          for($i=0;$i<$number_of_files;$i++)
          {
            if($_FILES['mediafile']['error'][$i] != 0) $errors[$i][] = 'Couldn\'t upload file '.$_FILES['mediafile']['name'][$i];
          }
          if(sizeof($errors)==0)
          {
            $this->load->library('upload');
            $config['upload_path'] = FCPATH . 'uploads/docs';
            $config['allowed_types'] = 'gif|jpg|png|pdf|docx|doc';
            for ($i = 0; $i < $number_of_files; $i++) {
              $_FILES['mediafile']['name'] = $files['name'][$i];
              $_FILES['mediafile']['type'] = $files['type'][$i];
              $_FILES['mediafile']['tmp_name'] = $files['tmp_name'][$i];
              $_FILES['mediafile']['error'] = $files['error'][$i];
              $_FILES['mediafile']['size'] = $files['size'][$i];
              $this->upload->initialize($config);
              if ($this->upload->do_upload('mediafile'))
              {
                $data['uploads'][$i] = $this->upload->data();
              }
              else
              {
                $data['upload_errors'][$i] = $this->upload->display_errors();
              }
            }
          }

          foreach($data['uploads'] as $upload){
              $filesArray[] = array('filename'=>$upload['file_name'],'user_id'=>$user_id,'doc_id'=>$doc_id,'image_type'=>$upload['file_type']);
          }

          $this->user_model->saveF4SGallery($filesArray);
          $this->session->set_flashdata('success','F4S Document Uploaded Successfully');
          redirect('backend/profile/getF4sDocument');
     }

     public function updateF4SGalleryInformation(){

      $content = $this->input->post('content');
      $gallery_id = $this->input->post('gallery_id');
      $title = $this->input->post('title');
      $user_id = $this->session->userdata('userId');
      $data = array();
      if(!empty($content)){
        $data['description'] = $content;
      }
      if(!empty($title)){
        $data['title'] = $title;
      }

      $this->user_model->updateF4SGalleryDetails($gallery_id,$data,$user_id);
       exit;
     }

     public function removeGalleryFiles(){
       $file_id = $this->input->post('file_id');
       $fileinfo = $this->user_model->getF4sFileNameByFileId($file_id);
       $filename = $fileinfo[0]->filename;
       if(!empty($filename)){
         unlink('uploads/docs/'.$filename);
       }
       $user_id = $this->session->userdata('userId');
       if(!empty($file_id) && !empty($user_id)){
         $this->user_model->removeGalleryFileById($file_id,$user_id);
       }
     }

     public function uploadMultiFile(){
       $doc_id = $this->input->post('doc_id');
       $user_id = $this->session->userdata('userId');
       $number_of_files = sizeof($_FILES['mediafile']['tmp_name']);
       $files = $_FILES['mediafile'];
       $errors = array();
       for($i=0;$i<$number_of_files;$i++)
       {
         if($_FILES['mediafile']['error'][$i] != 0) $errors[$i][] = 'Couldn\'t upload file '.$_FILES['mediafile']['name'][$i];
       }
       if(sizeof($errors)==0)
       {
         $this->load->library('upload');
         $config['upload_path'] = FCPATH . 'uploads/docs';
         $config['allowed_types'] = 'gif|jpg|png|pdf|docx|doc';
         for ($i = 0; $i < $number_of_files; $i++) {
           $_FILES['mediafile']['name'] = $files['name'][$i];
           $_FILES['mediafile']['type'] = $files['type'][$i];
           $_FILES['mediafile']['tmp_name'] = $files['tmp_name'][$i];
           $_FILES['mediafile']['error'] = $files['error'][$i];
           $_FILES['mediafile']['size'] = $files['size'][$i];
           $this->upload->initialize($config);
           if ($this->upload->do_upload('mediafile'))
           {
             $data['uploads'][$i] = $this->upload->data();
           }
           else
           {
             $data['upload_errors'][$i] = $this->upload->display_errors();
           }
         }
       }

       foreach($data['uploads'] as $upload){
           $filesArray[] = array('filename'=>$upload['file_name'],'user_id'=>$user_id,'doc_id'=>$doc_id,'image_type'=>$upload['file_type']);
       }

       $this->user_model->saveF4SGallery($filesArray);
       $this->session->set_flashdata('success','F4S Document Uploaded Successfully');
       redirect('backend/profile/getF4SGallery');
     }

}

?>
