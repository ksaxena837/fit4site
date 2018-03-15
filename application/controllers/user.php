<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class User extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->isLoggedIn();
    }

    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->global['pageTitle'] = 'Fit4Site : Dashboard';
        $data['customer_list'] = $this->user_model->customer_list();
        $this->loadViews("dashboard", $this->global, $data , NULL);
    }

    /**
     * This function is used to load the user list
     */
    function userListing()
    {
      if($this->isAdmin() == TRUE)
      {
            $this->load->model('user_model');

            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->user_model->userListingCount($searchText);

			$returns = $this->paginationCompress ( "userListing/", $count, 5 );

            $data['userRecords'] = $this->user_model->userListing($searchText, $returns["page"], $returns["segment"]);

            $this->global['pageTitle'] = 'Fit4Site : User Listing';

            $this->loadViews("users", $this->global, $data, NULL);
        }else{$this->loadThis();}
    }

    /**
     * This function is used to load the add new form
     */
    function addNew()
    {
      if($this->isAdmin() == TRUE)
      {
            $this->load->model('user_model');
            $data['roles'] = $this->user_model->getUserRoles();

            $this->global['pageTitle'] = 'Fit4Site : Add New User';

            $this->loadViews("addNew", $this->global, $data, NULL);
        }else{$this->loadThis();}
    }

    /**
     * This function is used to check whether email already exist or not
     */
    function checkEmailExists()
    {
        $userId = $this->input->post("userId");
        $email = $this->input->post("email");

        if(empty($userId)){
            $result = $this->user_model->checkEmailExists($email);
        } else {
            $result = $this->user_model->checkEmailExists($email, $userId);
        }

        if(empty($result)){ echo("true"); }
        else { echo("false"); }
    }

    /**
     * This function is used to add new user to the system
     */
    function addNewUser()
    {
      if($this->isAdmin() == TRUE)
      {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean|max_length[128]');
            $this->form_validation->set_rules('password','Password','required|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
            $this->form_validation->set_rules('role','Role','trim|required|numeric');
            $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]|xss_clean');

            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
                $name = ucwords(strtolower($this->input->post('fname')));
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $roleId = $this->input->post('role');
                $mobile = $this->input->post('mobile');

                $userInfo = array('email'=>$email, 'password'=>getHashedPassword($password), 'roleId'=>$roleId, 'name'=> $name,
                                    'mobile'=>$mobile, 'createdBy'=>$this->vendorId, 'createdDtm'=>date('Y-m-d H:i:s'));

                $this->load->model('user_model');
                $result = $this->user_model->addNewUser($userInfo);

                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New User created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'User creation failed');
                }

                redirect('addNew');
            }
        }else{$this->loadThis();}
    }


    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function editOld($userId = NULL)
    {if($this->isAdmin() == TRUE)
    {
            if($userId == null)
            {
                redirect('userListing');
            }

            $data['roles'] = $this->user_model->getUserRoles();
            $data['userInfo'] = $this->user_model->getUserInfo($userId);

            $this->global['pageTitle'] = 'Fit4Site : Edit User';

            $this->loadViews("editOld", $this->global, $data, NULL);
        }else{$this->loadThis();}
    }


    /**
     * This function is used to edit the user information
     */
    function editUser()
    {
      if($this->isAdmin() == TRUE)
      {
            $this->load->library('form_validation');

            $userId = $this->input->post('userId');

            $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('email','Email','trim|required|valid_email|xss_clean|max_length[128]');
            $this->form_validation->set_rules('password','Password','matches[cpassword]|max_length[20]');
            $this->form_validation->set_rules('cpassword','Confirm Password','matches[password]|max_length[20]');
            $this->form_validation->set_rules('role','Role','trim|required|numeric');
            $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]|xss_clean');

            if($this->form_validation->run() == FALSE)
            {
                $this->editOld($userId);
            }
            else
            {
                $name = ucwords(strtolower($this->input->post('fname')));
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $roleId = $this->input->post('role');
                $mobile = $this->input->post('mobile');

                $userInfo = array();

                if(empty($password))
                {
                    $userInfo = array('email'=>$email, 'roleId'=>$roleId, 'name'=>$name,
                                    'mobile'=>$mobile, 'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
                }
                else
                {
                    $userInfo = array('email'=>$email, 'password'=>getHashedPassword($password), 'roleId'=>$roleId,
                        'name'=>ucwords($name), 'mobile'=>$mobile, 'updatedBy'=>$this->vendorId,
                        'updatedDtm'=>date('Y-m-d H:i:s'));
                }

                $result = $this->user_model->editUser($userInfo, $userId);

                if($result == true)
                {
                    $this->session->set_flashdata('success', 'User updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'User updation failed');
                }

                redirect('userListing');
            }
        }else{$this->loadThis();}
    }


    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteUser()
    {

        if($this->isAdmin() == TRUE)
        {
            $userId = $this->input->post('userId');
            $userInfo = array('isDeleted'=>1,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));

            $result = $this->user_model->deleteUser($userId, $userInfo);

            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }else{echo(json_encode(array('status'=>'access')));}
    }

    /**
     * This function is used to load the change password screen
     */
    function loadChangePass()
    {
        $this->global['pageTitle'] = 'Fit4Site : Change Password';

        $this->loadViews("changePassword", $this->global, NULL, NULL);
    }


    /**
     * This function is used to change the password of the user
     */
    function changePassword()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('oldPassword','Old password','required|max_length[20]');
        $this->form_validation->set_rules('newPassword','New password','required|max_length[20]');
        $this->form_validation->set_rules('cNewPassword','Confirm new password','required|matches[newPassword]|max_length[20]');

        if($this->form_validation->run() == FALSE)
        {
            $this->loadChangePass();
        }
        else
        {
            $oldPassword = $this->input->post('oldPassword');
            $newPassword = $this->input->post('newPassword');;

            $resultPas = $this->user_model->matchOldPassword($this->vendorId, $oldPassword);

            if(empty($resultPas))
            {
                $this->session->set_flashdata('nomatch', 'Your old password not correct');
                redirect('loadChangePass');
            }
            else
            {
                $usersData = array('password'=>getHashedPassword($newPassword), 'updatedBy'=>$this->vendorId,
                                'updatedDtm'=>date('Y-m-d H:i:s'));

                $result = $this->user_model->changePassword($this->vendorId, $usersData);

                if($result > 0) { $this->session->set_flashdata('success', 'Password updation successful'); }
                else { $this->session->set_flashdata('error', 'Password updation failed'); }

                redirect('loadChangePass');
            }
        }
    }

    function pageNotFound()
    {
        $this->global['pageTitle'] = 'Fit4Site : 404 - Page Not Found';

        $this->loadViews("404", $this->global, NULL, NULL);
    }

    public function profileStatus(){
		    echo $available_status = $this->input->post('available_status');
        //$profileStatusId = $s_id;
        $user_id = $this->session->userdata('userId');
      /*  if($available_status==1){
          $available_status = 0;
        }else{
          $available_status = 1;
        }*/

        $array = array('online_status'=>$available_status);
        $this->db->where('userId',$user_id);
        $this->db->update('tbl_users',$array);

exit;
        //if ($res > 0) {  redirect($_SERVER['HTTP_REFERER']); }

    }

    public function getProfileDetail(){
      $user_id = $this->session->userdata('userId');
      $data['roles'] = $this->user_model->getUserRoles();
      $data['userInfo'] = $this->user_model->getUserInfo($user_id);
	   $data['userprofile'] = $this->user_model->getuserinfobyid();
      $this->global['pageTitle'] = 'Fit4Site : My Profile';
      $this->loadViews("myprofile", $this->global, $data, NULL);
      //pre($data);
    }
    public function userChat(){
      $user_id = $this->session->userdata('userId');
      $data['roles'] = $this->user_model->getUserRoles();
      $data['userInfo'] = $this->user_model->getUserInfo($user_id);
      $this->global['pageTitle'] = 'Fit4Site : onliechat';
      $this->loadViews("onlinechat", $this->global, $data, NULL);
    }

    public function order(){
      if($this->isClient()=='true'){
      $data['orders'] = $this->user_model->getOrderByUserId();
      //pre($data); die;
      $this->global['pageTitle'] = 'Fit4Site : Orders';
      $this->loadViews("sale/orderhistory", $this->global, $data, NULL);
    }else{$this->loadThis();}
    }
	public function editprofile(){
		$user_id = $this->session->userdata('userId');
	     $this->load->library('form_validation');
		 if(!empty ($_POST)) {
		 $this->form_validation->set_rules('usereducation','Education','required');
		 $this->form_validation->set_rules('userlocation','Location','required');
		 $this->form_validation->set_rules('userskills','Skills','required');
		 $this->form_validation->set_rules('usernotes','Notes','required');
		 $this->form_validation->set_rules('useremail','Email','required');
		 $this->form_validation->set_rules('usermobile','Mobile','required');
		 $this->form_validation->set_rules('username','Name','required');
		  if($this->form_validation->run() == FALSE)
        {
			$data['userprofile'] = $this->user_model->getuserinfobyid();
           $this->global['pageTitle'] = 'Fit4Site : profile';
      $this->loadViews("editprofile", $this->global, $data, NULL);
        }else {
			$usereducation = $this->input->post('usereducation');
		$userlocation = $this->input->post('userlocation');
		$userskills = $this->input->post('userskills');
		$usernotes = $this->input->post('usernotes');
		$useremail = $this->input->post('useremail');
		$usermobile = $this->input->post('usermobile');
		$username = $this->input->post('username');
		$usersprofileData = array('education'=>$usereducation, 'location'=>$userlocation,
                                'skills'=>$userskills, 'notes'=>$usernotes, 'email'=>$useremail, 'mobile'=>$usermobile, 'name'=>$username);
		$data['insertuserprofile'] = $this->user_model->insertuserinfo_byid($usersprofileData);
		$data['userprofile'] = $this->user_model->getuserinfobyid();
		 $this->global['pageTitle'] = 'Fit4Site : profile';
      $this->loadViews("editprofile", $this->global, $data, NULL);
		}
		 }
        else
        {
		$data['userprofile'] = $this->user_model->getuserinfobyid();
		 $this->global['pageTitle'] = 'Fit4Site : profile';
      $this->loadViews("editprofile", $this->global, $data, NULL);
		}

	}


}

?>
