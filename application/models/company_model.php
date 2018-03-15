<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Company_model extends CI_Model
{
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function companyListingCount($searchText = '')
    {
        $user_id = $this->session->userdata('userId');
        $this->db->select('BaseTbl.id, BaseTbl.company_name, BaseTbl.company_description,BaseTbl.company_contact,BaseTbl.company_website,BaseTbl.twitter_url,BaseTbl.facebook_url,BaseTbl.company_website,BaseTbl.company_image');
        $this->db->from('tbl_companies as BaseTbl');
        //$this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.company_name  LIKE '%".$searchText."%'
                            OR  BaseTbl.company_website  LIKE '%".$searchText."%'
                            OR  BaseTbl.company_contact  LIKE '%".$searchText."%')";
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
    function companyListing($searchText = '', $page, $segment)
    {
      $user_id = $this->session->userdata('userId');
    $this->db->select('BaseTbl.id, BaseTbl.company_name, BaseTbl.company_description,BaseTbl.company_contact,BaseTbl.company_website,BaseTbl.twitter_url,BaseTbl.facebook_url,BaseTbl.company_website,BaseTbl.company_image');
        $this->db->from('tbl_companies as BaseTbl');

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
    function addNewCompany($companyInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_companies', $companyInfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function getCompanyInfo($user_id,$id)
    {
        $this->db->select('BaseTbl.id, BaseTbl.company_name,BaseTbl.company_address, BaseTbl.company_description,BaseTbl.company_contact,BaseTbl.company_website,BaseTbl.twitter_url,BaseTbl.facebook_url,BaseTbl.company_website,BaseTbl.company_image');
        $this->db->from('tbl_companies BaseTbl');
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
    function editCompany($companyInfo, $id)
    {
      $user_id = $this->session->userdata('userId');
        $this->db->where('id', $id);
        $this->db->where('posted_by',$user_id);
        $this->db->update('tbl_companies', $companyInfo);

        return TRUE;
    }



    /**
     * This function is used to delete the user information
     * @param number $userId : This is user id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteCompany($id)
    {

      $user_id = $this->session->userdata('userId');

        $this->db->where('id', $id);
        $this->db->where('posted_by',$user_id);
        $this->db->delete('tbl_companies');

        return $this->db->affected_rows();
    }

    public function getCompanylist(){
      $user_id = $this->session->userdata('userId');
      $this->db->where('posted_by',$user_id);
      return $this->db->get('tbl_companies')->result_array();
    }

    function getCompanyName($company_id)
    {

        $this->db->where('id', $company_id);
      $res =  $this->db->get('tbl_companies')->result();
      if(!empty($res)){return $res;}else{return NULL;}

    }

}
