<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
     public function index(){}
    function userListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.userId, BaseTbl.email, BaseTbl.name, BaseTbl.mobile, Role.role');
        $this->db->from('tbl_users as BaseTbl');
        $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%'
                            OR  BaseTbl.name  LIKE '%".$searchText."%'
                            OR  BaseTbl.mobile  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.roleId !=', 1);
        $query = $this->db->get();

        return count($query->result());
    }

    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function userListing($searchText = '', $page, $segment)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.email, BaseTbl.name, BaseTbl.mobile, Role.role');
        $this->db->from('tbl_users as BaseTbl');
        $this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%'
                            OR  BaseTbl.name  LIKE '%".$searchText."%'
                            OR  BaseTbl.mobile  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.roleId !=', 1);
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    /**
     * This function is used to get the user roles information
     * @return array $result : This is result of the query
     */
    function getUserRoles()
    {
        $this->db->select('roleId, role');
        $this->db->from('tbl_roles');
        $this->db->where('roleId !=', 1);
        $query = $this->db->get();

        return $query->result();
    }

    /**
     * This function is used to check whether email id is already exist or not
     * @param {string} $email : This is email id
     * @param {number} $userId : This is user id
     * @return {mixed} $result : This is searched result
     */
    function checkEmailExists($email, $userId = 0)
    {
        $this->db->select("email");
        $this->db->from("tbl_users");
        $this->db->where("email", $email);
        $this->db->where("isDeleted", 0);
        if($userId != 0){
            $this->db->where("userId !=", $userId);
        }
        $query = $this->db->get();

        return $query->result();
    }


    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewUser($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_users', $userInfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function getUserInfo($userId)
    {
        $this->db->select('tbl_users.userId, tbl_users.name, tbl_users.email,tbl_users.roleId, tbl_users.mobile,tbl_users.location,tbl_users.notes,tbl_users.profile_image,tbl_users.education,tbl_users.lat,tbl_users.lng,tbl_users.cover_image,tbl_roles.role,tbl_users.online_status');
        $this->db->from('tbl_users');
        $this->db->join('tbl_roles','tbl_users.roleId=tbl_roles.roleId');
        $this->db->where('tbl_users.isDeleted', 0);
		    $this->db->where('tbl_users.roleId !=', 1);
        $this->db->where('tbl_users.userId', $userId);
        $query = $this->db->get();
          $result = $query->result();

        foreach($result as $res){
          $this->db->select('count(*) as count');
          $this->db->where('user_id',$res->userId);
          $this->db->from('tbl_user_follow');
          $query = $this->db->get();
          $no_of_following = $query->result();
          $res->no_of_following = $no_of_following[0]->count;
        }
        foreach($result as $res){
          $this->db->select('count(*) as followers');
          $this->db->where('leader_id',$res->userId);
          $this->db->from('tbl_user_follow');
          $query = $this->db->get();
          $no_of_followers = $query->result();
          $res->followers = $no_of_followers[0]->followers;
        }

          return $result;
    }


    /**
     * This function is used to update the user information
     * @param array $userInfo : This is users updated information
     * @param number $userId : This is user id
     */
    function editUser($userInfo, $userId)
    {
        $this->db->where('userId', $userId);
        $this->db->update('tbl_users', $userInfo);

        return TRUE;
    }



    /**
     * This function is used to delete the user information
     * @param number $userId : This is user id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteUser($userId, $userInfo)
    {
        $this->db->where('userId', $userId);
        $this->db->update('tbl_users', $userInfo);

        return $this->db->affected_rows();
    }


    /**
     * This function is used to match users password for change password
     * @param number $userId : This is user id
     */
    function matchOldPassword($userId, $oldPassword)
    {
        $this->db->select('userId, password');
        $this->db->where('userId', $userId);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get('tbl_users');

        $user = $query->result();

        if(!empty($user)){
            if(verifyHashedPassword($oldPassword, $user[0]->password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }

    /**
     * This function is used to change users password
     * @param number $userId : This is user id
     * @param array $userInfo : This is user updation info
     */
    function changePassword($userId, $userInfo)
    {
        $this->db->where('userId', $userId);
        $this->db->where('isDeleted', 0);
        $this->db->update('tbl_users', $userInfo);

        return $this->db->affected_rows();
    }

    public function getUserProfileDetail($user_id=NULL){
        if(!empty($user_id)){
            $this->db->select('*');
            $this->db->from('tbl_users');
            $query = $this->db->where('userId',$user_id)->get();
            $result = $query->row();
            if(!empty($result)){
              return $result;
            }else{
              return false;
            }
        }
    }

    public function getUsers(){
      $user_id = $this->session->userdata('userId');
      $this->db->select('*');
        //$this->db->where_not_in('userId',$user_id);
          $this->db->where('online_status',1);
      $query = $this->db->from('tbl_users')->get();

      $result = $query->result();
      if(!empty($result)){
        return $result;
      }else{
        return false;
      }
    }

    public function getOrderHistory(){
      $user_id = $this->session->userdata('userId');
      $this->db->select('tbl_checkout.*,tbl_products.*');
      $this->db->from('tbl_checkout');
      $this->db->join('tbl_sales_detail','tbl_sales_detail.sale_id=tbl_checkout.sale_id');
      $this->db->join('tbl_products','tbl_sales_detail.product_code=tbl_products.product_code');
      if($user_id)
      $this->db->where('tbl_checkout.customer_id',$user_id);
      $query = $this->db->get();
      return $query->result();

    }
    public function getOrderByUserId(){
      $user_id = $this->session->userdata('userId');
      $this->db->select('*');
      $this->db->from('tbl_checkout');
      if($user_id)
      $this->db->where('tbl_checkout.customer_id',$user_id);
      $this->db->where('tbl_checkout.sale_id <>','0');
      $query = $this->db->get();
      return $query->result();
    }
    public function customer_list()
    {
        date_default_timezone_set('Asia/Kolkata');
        $date = date("Y-m-d");
        $query = $this->db->query("SELECT * FROM tbl_users WHERE DATE_FORMAT(createdDtm,'%Y-%m-%d') = '$date' ");
        return $query->result();
    }
	public function insertuserinfo_byid($usersprofileData){
		  $user_id = $this->session->userdata('userId');
		 $this->db->where('userId', $user_id);
        $this->db->update('tbl_users', $usersprofileData);
        return TRUE;

	}

		public function insertusercover_byid($usersprofileData1){
		  $user_id = $this->session->userdata('userId');
		 $this->db->where('userId', $user_id);
        $this->db->update('tbl_users', $usersprofileData1);
        return TRUE;

	}
	    public function getusercover()
    {
        $user_id = $this->session->userdata('userId');
		 $this->db->where('userId', $user_id);
        $query = $this->db->query("SELECT cover_image FROM tbl_users WHERE userId = '$user_id' ");
        return $query->result();
    }


	public function getuserinfobyid(){
		  $user_id = $this->session->userdata('userId');
		 $query = $this->db->query("SELECT tbl_users.*, tbl_roles.role as roletxt FROM tbl_users INNER JOIN tbl_roles on tbl_users.roleId=tbl_roles.roleId WHERE tbl_users.userID = '$user_id' ");
        return $query->result();

	}

  public function get_member_list($limit,$start){

    $user_id = $this->session->userdata('userId');
    if(!empty($user_id)){
        $this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->where('userId <>',$user_id);
        if(!empty($limit) && !empty($start)){
        $this->db->limit($limit,$start);
        }
        $query = $this->db->get();
        $result = $query->result();
        foreach($result as $res){
          $this->db->select('count(*) as count');
          $this->db->where('user_id',$res->userId);
          $this->db->from('tbl_user_follow');
          $query = $this->db->get();
          $no_of_followers = $query->result();
          $res->no_of_follower = $no_of_followers[0]->count;
        }

        if(!empty($result)){ return $result; }else{ return false; }
      }
  }

  public function get_following_list(){
    $user_id = $this->session->userdata('userId');
    if(!empty($user_id)){
        $this->db->select('leader_id');
        $this->db->from('tbl_user_follow');
        $this->db->where('tbl_user_follow.user_id',$user_id);
        $query = $this->db->get()->result_array();
        if(!empty($query)){ return array_column($query,'leader_id');  }else{ return false; }
      }
  }

  public function get_follower_ids(){
    $user_id = $this->session->userdata('userId');
    if(!empty($user_id)){
        $this->db->select('user_id');
        $this->db->from('tbl_user_follow');

        $this->db->where('tbl_user_follow.leader_id',$user_id);
        $this->db->where('tbl_user_follow.user_id <>',$user_id);
        $query = $this->db->get()->result_array();
        if(!empty($query)){ return array_column($query,'user_id');  }else{ return false; }
      }
  }

  public function get_following_members(){
    $user_id = $this->session->userdata('userId');
        if(!empty($user_id)){
          $followingids = $this->get_following_list();
          //print_r($followingids);die;
          $mainArray = array();
          if(!empty($followingids)){
          foreach($followingids as $leader_id){
            $this->db->select('tbl_users.*');
            $this->db->from('tbl_users');
            //$this->db->join('tbl_user_follow','tbl_user_follow.leader_id=tbl_users.userId');
            $this->db->where('tbl_users.userId',$leader_id);

            $query = $this->db->get();
            $result = $query->result();
            foreach($result as $res){
              $this->db->select('count(*) as count');
              $this->db->where('user_id',$res->userId);
              $this->db->from('tbl_user_follow');
              $query = $this->db->get();
              $no_of_followers = $query->result();
              $res->no_of_follower = $no_of_followers[0]->count;
            }

            $mainArray[] = $result[0];
          }
        }
        if(!empty($mainArray)){ return $mainArray; }else{ return false; }
      }
  }

  public function get_follower_members(){
    $user_id = $this->session->userdata('userId');
        if(!empty($user_id)){
          $followerids = $this->get_follower_ids();
          $mainArray = array();
          if(!empty($followerids)){
          foreach($followerids as $user_id){
            $this->db->select('tbl_users.*');
            $this->db->from('tbl_users');
            $this->db->join('tbl_user_follow','tbl_user_follow.user_id=tbl_users.userId');
            $this->db->where('tbl_users.userId =',$user_id);
            $query = $this->db->get();
            $result = $query->result();
            foreach($result as $res){
              $this->db->select('count(*) as count');
              $this->db->where('user_id',$res->userId);
              $this->db->from('tbl_user_follow');
              $query = $this->db->get();
              $no_of_followers = $query->result();
              $res->no_of_follower = $no_of_followers[0]->count;
            }

            $mainArray[] = $result[0];
          }
        }
        if(!empty($mainArray)){ return $mainArray; }else{ return false; }
      }
  }

  public function updateFollowUnfollow($friendData){
      $user_id = $this->session->userdata('userId');
      $leader_id = $friendData['leader_id'];
      $this->db->where('leader_id',$leader_id);
      $this->db->where('user_id',$user_id);
      $frndquery = $this->db->get('tbl_user_follow');
      $singleFriend = $frndquery->result();

      if(empty($singleFriend)){
        $this->db->insert('tbl_user_follow',$friendData);
        echo "Unfollow"; exit;

      }else{
        $this->db->where('leader_id',$leader_id);
        $this->db->where('user_id',$user_id);
        $this->db->delete('tbl_user_follow');
        echo "Follow"; exit;
      }
  }

  public function getUserInformationByEmailId($emailid){
    $userEmailId = trim($emailid);
    $query = $this->db->query("SELECT tbl_users.*, tbl_roles.role as roletxt FROM tbl_users INNER JOIN tbl_roles on tbl_users.roleId=tbl_roles.roleId WHERE tbl_users.email = '$userEmailId' ");
      return $query->result();
  }

  public function getFollowersCount($friend_id){
      if(!empty($friend_id)){
        $this->db->select('count(*) as count');
        $this->db->where('user_id',$friend_id);
        $this->db->from('tbl_user_follow');
        $query = $this->db->get();
        return $no_of_followers = $query->result();
      }
  }

  public function getFollowingCount($friend_id){
    if(!empty($friend_id)){
      $this->db->select('count(*) as count');
      $this->db->where('user_id',$friend_id);
      $this->db->from('tbl_user_follow');
      $query = $this->db->get();
      return $no_of_following = $query->result();
    }
  }

  public function saveF4SGallery($data){
    if(!empty($data)){
      $this->db->trans_start();
      $this->db->insert_batch('tbl_individual_docs_meta', $data);
      $insert_id = $this->db->insert_id();
      $this->db->trans_complete();
      return $insert_id;
    }
  }
  public function saveF4SDocument($data){
      if(!empty($data)){
        $this->db->trans_start();
        $this->db->insert('tbl_individual_docs', $data);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
      }
  }

  public function getF4SGalleryFiles($user_id=''){
      if(!empty($user_id)){
          $this->db->select('tid.title,tid.description,tidm.filename,tidm.image_type');
          $this->db->from('tbl_individual_docs tid');
          $this->db->join('tbl_individual_docs_meta tidm','tidm.doc_id=tid.id');
          $query = $this->db->get();
          return $result = $query->result();
      }
  }

  public function getGalleryTitlerDes($user_id=''){
    if(!empty($user_id)){
        $this->db->select('tid.title,tid.description,tid.id');
        $this->db->where('tid.user_id',$user_id);
        $this->db->from('tbl_individual_docs tid');
        $query = $this->db->get();
        return $result = $query->result();
    }
  }

  public function getGalleryFilesById($gal_id){
    if(!empty($gal_id)){
        $this->db->select('*');
        $this->db->where('doc_id',$gal_id);
        $this->db->from('tbl_individual_docs_meta');
        $query = $this->db->get();
        return $result = $query->result();
    }
  }

  public function updateF4SGalleryDetails($gal_id,$data,$user_id){
    if(!empty($gal_id) && !empty($data) && !empty($user_id)){
        $this->db->where('id',$gal_id);
        $this->db->where('user_id',$user_id);
        $this->db->update('tbl_individual_docs',$data);
        return true;
    }else{
      return false;
    }
  }

  public function removeGalleryFileById($file_id, $user_id){
    if(!empty($file_id) && !empty($user_id)){
        $this->db->where('id',$file_id);
        $this->db->delete('tbl_individual_docs_meta');
        return true;
    }
  }
  public function getF4sFileNameByFileId($file_id){
      if(!empty($file_id)){
          $this->db->where('id',$file_id);
          $query = $this->db->get('tbl_individual_docs_meta');
          $result = $query->result();
          return $result;
      }
  }

}
