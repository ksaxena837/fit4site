<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Job_model extends CI_Model
{
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function jobListingCount($searchText = '')
    {
        $user_id = $this->session->userdata('userId');
        $this->db->select('BaseTbl.id, BaseTbl.job_title, BaseTbl.job_short_description,BaseTbl.job_description,BaseTbl.location,BaseTbl.featured_image,BaseTbl.job_category_id,BaseTbl.job_type_id');
        $this->db->from('tbl_jobs as BaseTbl');
        //$this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.job_title  LIKE '%".$searchText."%'
                            OR  BaseTbl.location  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.posted_by', $user_id);
      //  $this->db->where('BaseTbl.roleId !=', 1);
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
    function jobListing($searchText = '', $page, $segment)
    {
      $user_id = $this->session->userdata('userId');
      $this->db->select('BaseTbl.id, BaseTbl.job_title, BaseTbl.job_short_description,BaseTbl.job_description,BaseTbl.location,BaseTbl.featured_image,BaseTbl.job_category_id,BaseTbl.job_type_id');
        $this->db->from('tbl_jobs as BaseTbl');

        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.company_name  LIKE '%".$searchText."%'
                            OR  BaseTbl.company_website  LIKE '%".$searchText."%')";

            $this->db->where($likeCriteria);
        }
        //$this->db->where('BaseTbl.is_deleted', 0);
        $this->db->where('BaseTbl.posted_by', $user_id);
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }


    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewJobs($jobInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_jobs', $jobInfo);
        //$this->db->insert_batch('tbl_jobs', $jobInfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function getJobInfo($user_id,$id)
    {
        //$this->db->select('BaseTbl.id, BaseTbl.company_id,BaseTbl.job_title,BaseTbl.job_short_description,BaseTbl.job_description,BaseTbl.location,BaseTbl.featured_image,BaseTbl.job_category_id,BaseTbl.job_type_id');
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_jobs BaseTbl');
        //$this->db->where('isDeleted', 0);

        $this->db->where('BaseTbl.posted_by', $user_id);
        $this->db->where('BaseTbl.id', $id);
        $query = $this->db->get();

        return $query->result();
    }


    /**
     * This function is used to update the user information
     * @param array $userInfo : This is users updated information
     * @param number $userId : This is user id
     */
    function editJob($jobInfo, $id)
    {
      $user_id = $this->session->userdata('userId');
        $this->db->where('id', $id);
        $this->db->where('posted_by',$user_id);
        $this->db->update('tbl_jobs', $jobInfo);
        return TRUE;
    }



    /**
     * This function is used to delete the user information
     * @param number $userId : This is user id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteJob($id)
    {

        $user_id = $this->session->userdata('userId');
        $this->db->where('id', $id);
        $this->db->where('posted_by',$user_id);
        $this->db->delete('tbl_jobs');

        return $this->db->affected_rows();
    }

    public function getJobTypes()
    {
        return $this->db->get('tbl_job_types')->result_array();
    }

    public function getJobCategories()
    {
        return $this->db->get('tbl_job_categories')->result_array();
    }


    /**
     * this function is used to fetch active jobs
     * @param
     * @return array $result : array: null
    */
    public function getJobsDetail()
    {
      $this->db->select('tj.*,tjc.name as job_category,tjt.name as job_type,tc.company_name,tc.company_address,tc.company_website,tc.twitter_url.tc.facebook_url.tc.company_contact,tc.company_description');
      $this->db->from('tbl_jobs tj');
      $this->db->join('tbl_job_categories tjc','tjc.id=tj.job_category_id');
      $this->db->join('tbl_job_types tjt','tjt.id=tj.job_type_id');
      $this->db->join('tbl_companies tc','tc.id=tj.company_id');
      $query = $this->db->get();
      $result = $query->result_array();
      if(!empty($result))
      {
        return $result;
      }
      else
      {
        return null;
      }
    }

    public function get_current_page_records($limit, $start)
    {

        //$this->db->select('tj.*,tjc.name as job_category,tjt.name as job_type');
        $this->db->select('tj.*,tjc.name as job_category,tjt.name as job_type,tc.company_name,tc.company_address,company_image,tc.company_description,tc.company_contact,tc.twitter_url,tc.facebook_url,tc.company_website');
        $this->db->from('tbl_jobs tj');
        $this->db->join('tbl_job_categories tjc','tjc.id=tj.job_category_id');
        $this->db->join('tbl_job_types tjt','tjt.id=tj.job_type_id');
        $this->db->join('tbl_companies tc','tc.id=tj.company_id');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        //echo $this->db->last_query(); die;
        $result = $query->result_array();
        if(!empty($result))
        {
          return $result;
        }
        else
        {
          return null;
        }
    }

    public function get_total()
    {
        return $this->db->count_all("tbl_jobs");
    }

    public function get_single_job_information($job_id=null)
    {
      if(!empty($job_id))
      {
      $this->db->select('tj.*,tjc.name as job_category,tjt.name as job_type,tc.company_name,tc.company_address,company_image,tc.company_description,tc.company_contact,tc.twitter_url,tc.facebook_url,tc.company_website');
      $this->db->from('tbl_jobs tj');
      $this->db->join('tbl_job_categories tjc','tjc.id=tj.job_category_id');
      $this->db->join('tbl_job_types tjt','tjt.id=tj.job_type_id');
      $this->db->join('tbl_companies tc','tc.id=tj.company_id');
      $this->db->where('tj.id',$job_id);
      $query = $this->db->get();
      $result = $query->row();
      if(!empty($result))
      {
        return $result;
      }
      else
      {
        return null;
      }
    }
    else {
      {
        return null;
      }
    }
  }

  public function job_applied($appliedJob)
  {
    if(!empty($appliedJob)){
        $this->db->trans_start();
        $this->db->insert('tbl_applied_jobs', $appliedJob);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }
  }
  public function is_applied($jobid,$user_id){
    $this->db->where('job_id', $jobid);
    $this->db->where('user_id', $user_id);
    return $this->db->get('tbl_applied_jobs')->result();
  }

  public function getPostedJobByCompanyId($company_id){
          $this->db->where('company_id',$company_id);
          $query= $this->db->get('tbl_jobs')->result();
          if($query){return $query;}else{return NULL;}

  }

  public function getAppliedCandidateByJobId($company_id,$job_id){

    $this->db->select('*');
    $this->db->from('tbl_applied_jobs');
    $this->db->where('job_id',$job_id);
    $this->db->where('company_id',$company_id);
    $appliedUserIds = $this->db->get()->result();
    $appliedUserList = array();
    foreach($appliedUserIds as $user_id){
      $this->db->where('userId',$user_id->user_id);
      $userlist = $this->db->get('tbl_users')->row();
      $appliedUserList[] = $userlist;
    }
    return $appliedUserList;
  }
  public function readUnreadCountStatus($job_id){
    $this->db->select('COUNT(*) as count');
    $this->db->from('tbl_applied_jobs');
    $this->db->where('job_id',$job_id);
   $this->db->where('read_unread','1');
  return  $unreadJob = $this->db->get()->row();
  }

  function jobsearch($limit_per_page, $offset,$match1 = '',$match2 = '')
  {
      $this->db->select('tj.*,tjc.name as job_category,tjt.name as job_type,tc.company_name,tc.company_address,company_image,tc.company_description,tc.company_contact,tc.twitter_url,tc.facebook_url,tc.company_website');
      $this->db->from('tbl_jobs as tj');
      $this->db->join('tbl_job_categories tjc','tjc.id=tj.job_category_id');
      $this->db->join('tbl_job_types tjt','tjt.id=tj.job_type_id');
      $this->db->join('tbl_companies as tc', 'tc.id = tj.company_id','left');
      if(!empty($match1)) {
          $likeCriteria = "(tj.job_title  LIKE '%".$match1."%') OR FIND_IN_SET('$match1',`skills`) OR (tc.company_name  LIKE '%".$match1."%')";

          $this->db->where($likeCriteria);
      }
      if(!empty($match2)){
        $likeCriteria2 = "(tj.location  LIKE '%".$match2."%')";
          $this->db->where($likeCriteria2);
      }
      if(!empty($limit_per_page) && !empty($offset)){
      $this->db->limit($limit_per_page, $offset);
      }
      $query = $this->db->get();
      //echo $this->db->last_query(); die;
      return $query->result_array();
      //return count($query->result());
  }


}
