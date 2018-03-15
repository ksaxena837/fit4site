<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Portfolio_model extends CI_Model
{
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function portfolioListingCount($searchText = '')
    {
        $user_id = $this->session->userdata('userId');
        $this->db->select('BaseTbl.id, BaseTbl.title, BaseTbl.description');
        $this->db->from('tbl_portfolio as BaseTbl');
        //$this->db->join('tbl_roles as Role', 'Role.roleId = BaseTbl.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.title  LIKE '%".$searchText."%')";
                            //OR  BaseTbl.name  LIKE '%".$searchText."%'
                            //OR  BaseTbl.mobile  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('user_id',$user_id);
        $this->db->where('BaseTbl.is_deleted', 0);
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
    function portfolioListing($searchText = '', $page, $segment)
    {
      $user_id = $this->session->userdata('userId');
        $this->db->select('BaseTbl.id,BaseTbl.user_id, BaseTbl.title, BaseTbl.description, BaseTbl.image_url');
        $this->db->from('tbl_portfolio as BaseTbl');

        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.title  LIKE '%".$searchText."%'
                            OR  BaseTbl.description  LIKE '%".$searchText."%')";

            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.is_deleted', 0);
        $this->db->where('BaseTbl.user_id', $user_id);
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
    function addNewPortfolio($Portfolioinfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_portfolio', $Portfolioinfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function getPortfolioInfo($user_id,$id)
    {
        $this->db->select('id, title, description, image_url');
        $this->db->from('tbl_portfolio');
        //$this->db->where('isDeleted', 0);

        $this->db->where('user_id', $user_id);
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->result();
    }


    /**
     * This function is used to update the user information
     * @param array $userInfo : This is users updated information
     * @param number $userId : This is user id
     */
    function editPortfolio($portfolioInfo, $id)
    {
      $user_id = $this->session->userdata('userId');
        $this->db->where('id', $id);
        $this->db->where('user_id',$user_id);
        $this->db->update('tbl_portfolio', $portfolioInfo);

        return TRUE;
    }



    /**
     * This function is used to delete the user information
     * @param number $userId : This is user id
     * @return boolean $result : TRUE / FALSE
     */
    function deletePortfolio($id, $porfolio)
    {

      $user_id = $this->session->userdata('userId');

        $this->db->where('id', $id);
        $this->db->where('user_id',$user_id);
        $this->db->delete('tbl_portfolio');

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

    public function getPortfoliosByUserId($user_id)
    {

      if(!empty($user_id))
      {
        $result =  $this->db->where('user_id',$user_id)->get('tbl_portfolio')->result();
        if(!empty($result))
        {
          return $result;
        }
        else
        {
          return null;
        }
      }
    }
}
