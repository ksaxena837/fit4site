<?php
class Group_model extends CI_Model
{
	function __construct() {
        // Call the Model constructor
        parent::__construct();
				$this->load->library('pagination');

        }

    public function insertGroup($data)
    {
      if(!empty($data))
      {
          $this->db->insert('tbl_groups',$data);
					$group_id = $this->db->insert_id();
					$data = array();
				$this->db->insert('tbl_group_members',['group_id'=>$group_id,'user_id'=>$this->session->userdata('userId'),'leader_id'=>$this->session->userdata('userId'),'is_admin'=>1]);

      }
      else
      {
          return false;
      }
    }

    public function getMyGroupList($limit,$start)
    {
      $created_by = $this->session->userdata('userId');
			$this->db->select('*');
			$this->db->from('tbl_groups');
			if(!empty($limit)){
				$this->db->limit($limit,$start);
			}
			  $this->db->where('created_by',$created_by);
      $query = $this->db->get();

      $result = $query->result();
      if(!empty($result)){return $result;}

    }
	
	public function getMyJoinedGroupList($limit,$start){
      $created_by = $this->session->userdata('userId');
			$this->db->select('group_id');
			$this->db->from('tbl_group_members');
			if(!empty($limit)){
				$this->db->limit($limit,$start);
			}
			$this->db->where('user_id',$created_by);
			
      $query = $this->db->get();

      $result = $query->result();
	  
	  $mylist = array();
	  foreach($result as $key => $val){
		  $mylist[] = $val->group_id;
	  }
	  
	  
      if(!empty($result)){return $mylist;}

    }

    public function getGroupInformation($groupId,$created_by){
      if(!empty($groupId) && !empty($created_by)){
        $this->db->where('created_by', $created_by);
        $this->db->where('id',$groupId);
        $query = $this->db->get('tbl_groups');
        $result = $query->result();
        if(!empty($result)){return $result;}else{return false;}
      }
    }

	public function getGroupDetail($slug){
			if(!empty($slug)){

				$this->db->where('slug',$slug);
				$query = $this->db->get('tbl_groups');
				$result = $query->result();
				if(!empty($result)){
					return $result;
				}else{
					return false;
				}
			}
	}

    public function updateGroup($data,$groupId){
      if(!empty($data) && !empty($groupId)){
        $this->db->where('id',$groupId);
        $this->db->update('tbl_groups',$data);
        return true;
      }else{
        return false;
      }
    }

    public function deleteGroup($groupId){
      $created_by = $this->session->userdata('userId');
      if(!empty($groupId) && !empty($groupId)){
        $this->db->where('id',$groupId);
        $this->db->where('created_by',$created_by);
        $this->db->delete('tbl_groups');
      }
    }

	public function getAllGroups($limit,$start) {
		$user_id = $this->session->userdata('userId');
        $this->db->select("*");
        $this->db->from('tbl_groups');
		
		if(!empty($limit)){
			$this->db->limit($limit,$start);
		}
        $query = $this->db->get();
		
        $result = $query->result();
		
        if(!empty($result)){ 
			return $result; 
		}
		else{ 
			return false; 
		}
	}
	
	public function joinedMembers(){
		$this->db->select('COUNT(group_id) as members, group_id');
        $this->db->from('tbl_group_members');
		$this->db->group_by('group_id');
		$query = $this->db->get();
        $result = $query->result();
		return $result;
	}


	public function get_usergrouplist() {
		 $user_id = $this->session->userdata('userId');
		  if(!empty($user_id)){
        $this->db->select('*');
        $this->db->from('tbl_groups');
		$this->db->where('created_by',$user_id);
        $query = $this->db->get();
        $result = $query->result();
        if(!empty($result)){ return $result; }else{ return false; }
      }
	}

	//Group Posts
	public function get_groupPosts($slug,$limit,$start){
		
		 $this->db->select('t1.id, t1.post_type, t1.post_desc, t1.attachment, t1.time, t1.group_id,  t3.username, t3.profile_image ')
		 ->from('tbl_group_posts as t1')
		 ->join('tbl_groups t2', 't1.group_id = t2.id', 'LEFT')
		 ->join('tbl_users t3', 't1.user_id = t3.userId', 'LEFT')
		 ->where('t2.slug', $slug)
		 ->order_by('t1.time','DESC')
		 ->limit($limit,$start);  
		$result = $this->db->get()->result();
		return $result;
	}
	
	//Joined or Unjoined Group
	public function get_groupJoined($slug){
		$user_id = $this->session->userdata('userId');
		$this->db->select('tbl_group_members.group_id')
		->from('tbl_group_members')
		->join('tbl_groups', 'tbl_group_members.group_id = tbl_groups.id')
		->where('tbl_groups.slug', $slug)
		->where('tbl_group_members.user_id', $user_id);
		$result = $this->db->get()->result();
		return $result;
	}	
	
	
	//group Post Liked By Current User
	public function postLiked($slug){
		$user_id = $this->session->userdata('userId');
		$this->db->select('tbl_post_likes.post_id as postid')
		 ->from('tbl_post_likes')
		 ->join('tbl_groups', 'tbl_post_likes.group_id = tbl_groups.id','LEFT')
		 ->where('tbl_groups.slug', $slug)
		 ->where('tbl_post_likes.member_id', $user_id);
		$result = $this->db->get()->result();
		
		$groupPostLiked = array();
		foreach($result as $val){
			$groupPostLiked[] = $val->postid;
		}
		
		return $groupPostLiked;
		
	}

	
	//View all comments
	public function get_allComments($postid){
		$this->db->select('tbl_post_comment.comment, tbl_users.username, tbl_users.profile_image')
		 ->from('tbl_post_comment')
		 ->join('tbl_users', 'tbl_users.userId = tbl_post_comment.member_id', 'LEFT')
		 ->where('tbl_post_comment.post_id', $postid);
		$result = $this->db->get()->result();
		return $result;
	}	
	
	
	//get Group Posts Likes
	public function get_groupPostsLikes($slug){
		
		 $this->db->select('COUNT(tbl_post_likes.post_id) as likes, tbl_post_likes.group_id, tbl_post_likes.post_id')
		 ->from('tbl_post_likes')
		 ->join('tbl_groups', 'tbl_post_likes.group_id = tbl_groups.id', 'LEFT')
		 ->where('tbl_groups.slug', $slug)
		 ->group_by('tbl_post_likes.post_id');
		$result = $this->db->get()->result();
		
		return $result;
	}

	//get Group Posts Comments
	public function get_groupPostsComments($slug){
		$this->db->select('COUNT(tbl_post_comment.post_id) as comments, tbl_post_comment.group_id, tbl_post_comment.post_id')
		 ->from('tbl_post_comment')
		 ->join('tbl_groups', 'tbl_post_comment.group_id = tbl_groups.id', 'LEFT')
		 ->where('tbl_groups.slug', $slug)
		 ->group_by('tbl_post_comment.post_id');
		$result = $this->db->get()->result();
		return $result; 
	}

	//Group Single Post 
	public function singlePost($postid){
		$this->db->select('tbl_group_posts.post_type, tbl_group_posts.post_desc, tbl_group_posts.group_id, tbl_group_posts.attachment, tbl_group_posts.time,tbl_users.username')
		->from('tbl_group_posts')
		->join('tbl_users', 'tbl_group_posts.user_id = tbl_users.userId', 'LEFT')
		->where('tbl_group_posts.id', $postid);
		$result = $this->db->get()->result();
		
		return $result; 
	}

	
	//Members List Of the Group
	public function group_members_list($slug){
		$this->db->select('tbl_group_members.user_id, tbl_users.name, tbl_users.profile_image, tbl_users.location')
		->from('tbl_group_members')
		->join('tbl_users', 'tbl_group_members.user_id = tbl_users.userId', 'LEFT')
		->join('tbl_groups', 'tbl_group_members.group_id = tbl_groups.id', 'LEFT')
		->where('tbl_groups.slug', $slug);
		$result = $this->db->get()->result();
		
		return $result; 
	}
	
	
	
	/*
	|-------------------------
	**************************
	*****--------------------- INTERIOR WALL ----------------*****
	**************************
	|-------------------------
	*/
	
	//Wall Posts
	public function get_wallPosts($wallid,$limit,$start){
		
		$this->db->select('t1.id, t1.post_type, t1.post_desc, t1.attachment, t1.time, t1.wall_id,  t3.username, t3.profile_image ')
		 ->from('tbl_wall_post as t1')
		 ->join('tbl_users t3', 't1.user_id = t3.userId', 'LEFT')
		 ->where('t1.wall_id', $wallid)
		 ->order_by('t1.time','DESC')
		 ->limit($limit,$start); ;  
		$result = $this->db->get()->result();
		
		return $result;
	}
	
	
	//Wall Post Liked By Current User
	public function wallpostLiked($wallid){
		$user_id = $this->session->userdata('userId');
		$this->db->select('post_id as postid')
		 ->from('tbl_wall_post_likes')
		 ->where('wall_id', $wallid)
		 ->where('member_id', $user_id);
		$result = $this->db->get()->result();
		
		$wallPostLiked = array();
		foreach($result as $val){
			$wallPostLiked[] = $val->postid;
		}
		
		return $wallPostLiked;
		
	}
	
	//get Group Posts Likes
	public function get_wallPostsLikes($wallid){
		
		 $this->db->select('COUNT(post_id) as likes, wall_id, post_id')
		 ->from('tbl_wall_post_likes')
		 ->where('wall_id',$wallid)
		 ->group_by('post_id');
		$result = $this->db->get()->result();
		
		return $result;
	}
	
	//View all comments On Wall
	public function get_all_wallComments($postid){
		$this->db->select('tbl_wall_post_comment.comment, tbl_users.username, tbl_users.profile_image')
		 ->from('tbl_wall_post_comment')
		 ->join('tbl_users', 'tbl_users.userId = tbl_wall_post_comment.member_id', 'LEFT')
		 ->where('tbl_wall_post_comment.post_id', $postid);
		$result = $this->db->get()->result();
		return $result;
	}	
	
	//get Wall Posts Comments
	public function get_wallPostsComments($wallid){
		$this->db->select('COUNT(post_id) as comments, wall_id, post_id')
		 ->from('tbl_wall_post_comment')
		 ->where('wall_id', $wallid)
		 ->group_by('post_id');
		$result = $this->db->get()->result();
		
		
		return $result; 
	}
	
	
	//Followed Wall
	public function followedWall($wallid){
		$this->db->select('*')
		->from('tbl_user_follow')
		->where('leader_id', $wallid)
		->where('user_id', $this->session->userdata('userId'));
		$result = $this->db->get()->result();
		return $result;
	}
	
}
