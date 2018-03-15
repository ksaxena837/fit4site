<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Portfolio extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
          $this->load->model('portfolio_model');
        $this->load->helper(array('form', 'url'));

        $this->isLoggedIn();
    }

    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->global['pageTitle'] = 'Fit4Site : Dashboard';

        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }

    /**
     * This function is used to load the user list
     */
    function portfolioListing()
    {
      if($this->isIndividual()=='true' || $this->isAdmin() =='true' || $this->isCompany() =='true')
      {
            $this->load->model('portfolio_model');

            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->portfolio_model->portfolioListingCount($searchText);

			         $returns = $this->paginationCompress ( "portfolio/portfolioListing/", $count, 5 );

            $data['portfolioRecord'] = $this->portfolio_model->portfolioListing($searchText, $returns["page"], $returns["segment"]);
               //echo '<pre>'; print_r($data['portfolioRecord']);
            $this->global['pageTitle'] = 'Fit4Site : User Listing';

            $this->loadViews("portfolios", $this->global, $data, NULL);
        }else{$this->loadThis();}
    }

    /**
     * This function is used to load the add new form
     */
    function addNew()
    {
      if($this->isIndividual()=='true' || $this->isAdmin() =='true' || $this->isCompany() =='true')
      {
            $this->load->model('user_model');
            $data['roles'] = $this->user_model->getUserRoles();

            $this->global['pageTitle'] = 'Fit4Site : Add New Portfolio';

            $this->loadViews("add_portfolio", $this->global, $data, NULL);
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
    function addNewPortfolio()
    {
      if($this->isIndividual()=='true' || $this->isAdmin() =='true' || $this->isCompany() =='true')
      {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('title','Title','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('description','Description','required');

            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {

                $title = $this->input->post('title');
                $description = $this->input->post('description');
                $user_id = $this->session->userdata('userId');
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 1000;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;
                $config['file_name']  = substr(md5(time()), 0, 28);
                $this->load->library('upload', $config);
                if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = array('error' => $this->upload->display_errors());
                        $this->addNew();
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
                          @chmod('./uploads/',0777);
                        $image_url = $data['upload_data']['file_name'];

                        $userInfo[] = array('image_url'=>$image_url);

                        //echo '<pre>'; print_r($data['upload_data']['file_name']); echo '</pre>';
                }

                $Portfolioinfo = array('title'=>$title, 'description'=>$description,'user_id'=>$user_id, 'updated_at'=>date('Y-m-d H:i:s'),'image_url'=>$image_url);

                $this->load->model('portfolio_model');
                $result = $this->portfolio_model->addNewPortfolio($Portfolioinfo);

                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Portfolio created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Portfolio creation failed');
                }

                redirect('portfolio/addNew');
            }
        }else{$this->loadThis();}
    }


    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function editOld($id= NULL)
    {
      $user_id = $this->session->userdata('userId');

      if($this->isIndividual()=='true' || $this->isAdmin() =='true' || $this->isCompany() =='true')
      {

          $data['portfolio'] = $this->portfolio_model->getPortfolioInfo($user_id,$id);
          $this->global['pageTitle'] = 'Fit4Site : Edit Portfolio';

          $this->loadViews("edit_portfolio", $this->global, $data, NULL);


        }else{$this->loadThis();}
    }


    /**
     * This function is used to edit the user information
     */
    function editPortfolio()
    {
      if($this->isIndividual()=='true' || $this->isAdmin() =='true' || $this->isCompany() =='true')
      {
            $this->load->library('form_validation');

            $id = $this->input->post('id');

            $this->form_validation->set_rules('title','Title','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('description','Description','required');

            if($this->form_validation->run() == FALSE)
            {

                $this->editOld($id);
            }
            else
            {

                $title = $this->input->post('title');
                $description = $this->input->post('description');
              //  echo '<pre>'; print_r($_FILES['userfile']['name']);
//die('here');
                $portfolioInfo = array();
                if($_FILES['userfile']['name']!="")
                {
                  $config['upload_path']          = './uploads/';
                  $config['allowed_types']        = 'gif|jpg|png';
                  $config['max_size']             = 1000;
                  $config['max_width']            = 1024;
                  $config['max_height']           = 2048;
                  $config['file_name']  = substr(md5(time()), 0, 28);
                    $this->load->library('upload', $config);
                    if ( ! $this->upload->do_upload('userfile'))
                    {
                         $error = array('error' => $this->upload->display_errors());
                        echo $error['error']; die;
                         $this->session->set_flashdata('error', $error['error']);
                          $this->editOld($id);
                    }
                    else
                    {
                      $data = array('upload_data' => $this->upload->data());
                        @chmod('./uploads/',0777);
                      $ulinkOldImg = $this->input->post('old');
                      @unlink('uploads/'.$ulinkOldImg);
                      $image_url = $data['upload_data']['file_name'];

                    }
                }
                else
                {
                       $image_url=$this->input->post('old');
                }
                $portfolioInfo = array('title'=>$title,'description'=>$description,'image_url'=>$image_url);
                $result = $this->portfolio_model->editPortfolio($portfolioInfo, $id);

                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Portfolio updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Portfolio updation failed');
                }

                redirect('portfolio/portfolioListing');
            }
        }else{$this->loadThis();}
    }


    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteportfolio()
    {
      if($this->isIndividual()=='true' || $this->isAdmin() =='true' || $this->isCompany() =='true')
      {
            $id = $this->input->post('id');
            $portfolio = array('is_deleted'=>'1');

            $result = $this->portfolio_model->deletePortfolio($id, $portfolio);

            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }else{$this->loadThis();}
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
            $newPassword = $this->input->post('newPassword');

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
}

?>
