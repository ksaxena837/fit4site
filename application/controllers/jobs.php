<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Jobs extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('job_model');
        $this->load->model('company_model');
        $this->load->helper(array('form', 'url'));

        $this->isLoggedIn();
    }

    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->global['pageTitle'] = 'Fit4Site : Jobs Listing';
        if($this->isTicketter() == FALSE)
        {
            $this->loadThis();
        }
        else
        {
            $this->load->model('job_model');

            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;

            $this->load->library('pagination');

            $count = $this->job_model->jobListingCount($searchText);

			         $returns = $this->paginationCompress ( "/", $count, 2 );

            $data['jobs'] = $this->job_model->jobListing($searchText, $returns["page"], $returns["segment"]);
               //echo '<pre>'; print_r($data); die;
            $this->global['pageTitle'] = 'Fit4Site : Job Listing';

            $this->loadViews("job_listing", $this->global, $data , NULL);
        }


    }



    /**
     * This function is used to load the add new form
     */
    function addNew()
    {
        if($this->isTicketter() == FALSE)
        {
            $this->loadThis();
        }
        else
        {

            $this->global['pageTitle'] = 'Fit4Site : Add New Job';
            $data['jobtypes'] = $this->job_model->getJobTypes();
            $data['jobcategories'] = $this->job_model->getJobCategories();
            $data['companylist'] = $this->company_model->getCompanylist();
            $this->loadViews("job_new", $this->global, $data, NULL);
        }
    }


    /**
     * This function is used to add new user to the system
     */
    function addNewJob()
    {

      if($this->isIndividual()=='true' || $this->isAdmin() =='true' || $this->isCompany())
      {
          $jobs = array();
            $this->load->library('form_validation');

            $this->form_validation->set_rules('job_title','Job Title','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('job_description','Job Description','required');
            $this->form_validation->set_rules('job_type_id','Company','required');

            if($this->form_validation->run() == FALSE)
            {
                $this->addNew();
            }
            else
            {
                $user_id = $this->session->userdata('userId');
                $config['upload_path']          = './uploads/job/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 2448;
                $config['max_width']            = 2048;
                $config['max_height']           = 2048;
                $config['file_name']  = substr(md5(time()), 0, 28);
                $this->load->library('upload', $config);
                if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = array('error' => $this->upload->display_errors());
                        print_r($error); die;
                        $this->addNew();
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
                        @chmod('./uploads/',0777);
                        $image_url = $data['upload_data']['file_name'];

                        $featruedimg = array('featured_image'=>$image_url);
                        $jobs = $this->input->post();
                        $userid = array('posted_by'=>$this->session->userdata('userId'));
                        $jobs =  array_merge($jobs,$featruedimg,$userid);


                        //echo '<pre>'; print_r($data['upload_data']['file_name']); echo '</pre>';
                }

                /****** company logo***************/
              /*  $config['upload_path']          = './uploads/job/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 500;
                $config['max_width']            = 300;
                $config['max_height']           = 200;
                $config['file_name']  = substr(md5(time()), 0, 28);
                $this->load->library('upload', $config);
                if ( ! $this->upload->do_upload('companylogo'))
                {
                        $error = array('error' => $this->upload->display_errors());
                        //print_r($error); die;
                        $this->addNew();
                }
                else
                {
                        $data1 = array('upload_data' => $this->upload->data());
                        chmod($data['upload_data']['full_path'],777);
                        $company_logo = $data1['upload_data']['file_name'];

                        $logo = array('company_logo'=>$company_logo);
                        $jobs = $this->input->post();
                        $userid = array('posted_by'=>$this->session->userdata('userId'));
                      $jobs =  array_merge($jobs,$featruedimg,$logo,$userid);


                        //echo '<pre>'; print_r($jobs); echo '</pre>'; die;
                }*/

                /********* end company logo *****************/

                $result = $this->job_model->addNewJobs($jobs);

                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New job created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Job creation failed');
                }

                redirect('jobs/addNew');
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
      if($this->isIndividual()=='true' || $this->isAdmin() =='true' || $this->isCompany())
      {
          //echo '<pre>'; print_r($data); die;
          $this->global['pageTitle'] = 'Fit4Site : Edit Job';
          $data['jobtypes'] = $this->job_model->getJobTypes();
          $data['jobcategories'] = $this->job_model->getJobCategories();
          $data['companylist'] = $this->company_model->getCompanylist();
          $data['job'] = $this->job_model->getJobInfo($user_id,$id);
          //pre($data['job']);die;
          $this->loadViews("job_edit", $this->global, $data, NULL);


        }else{$this->loadThis();}
    }


    /**
     * This function is used to edit the user information
     */
    function editJob()
    {
      if($this->isIndividual()=='true' || $this->isAdmin() =='true' || $this->isCompany())
      {
            $this->load->library('form_validation');
            $jobs = array();
            $id = $this->input->post('id');

            $this->form_validation->set_rules('job_title','Title','trim|required|max_length[128]|xss_clean');
            $this->form_validation->set_rules('job_description','Description','required');
            $this->form_validation->set_rules('job_type_id','Company','required');
            if($this->form_validation->run() == FALSE)
            {

                $this->editOld($id);
            }
            else
            {
              //pre($_POST); die;
                if($_FILES['userfile']['name']!="")
                {
                  $config['upload_path']          = './uploads/job';
                  $config['allowed_types']        = 'gif|jpg|png';
                  $config['max_size']             = 2448;
                  $config['max_width']            = 2048;
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
                      $image_url = $data['upload_data']['file_name'];
                      $ulinkOldImg = $this->input->post('old');
                      unlink('uploads/job/'.$ulinkOldImg);

                      $featruedimg = array('featured_image'=>$image_url);

                    }
                }
                else
                {       $old = $this->input->post('old');
                        $featruedimg = array('featured_image'=>$old);

                }

                /*************company logo start **********/

                /*if($_FILES['companylogo']['name']!="")
                {
                  $config['upload_path']          = './uploads/job';
                  $config['allowed_types']        = 'gif|jpg|png';
                  $config['max_size']             = 1000;
                  $config['max_width']            = 1024;
                  $config['max_height']           = 2048;
                  $config['file_name']  = substr(md5(time()), 0, 28);
                    $this->load->library('upload', $config);
                    if ( ! $this->upload->do_upload('companylogo'))
                    {
                         $error = array('error' => $this->upload->display_errors());
                        echo $error['error']; die;
                         $this->session->set_flashdata('error', $error['error']);
                          $this->editOld($id);
                    }
                    else
                    {

                      $data = array('upload_data' => $this->upload->data());
                      chmod($data['upload_data']['full_path'],777);
                      $logo = $data['upload_data']['file_name'];
                      $ulinkOldlogo = $this->input->post('oldlogo');
                      unlink('uploads/job/'.$ulinkOldlogo);

                      $companylogo = array('company_logo'=>$logo);

                    }
                }
                else
                {       $old = $this->input->post('oldlogo');
                        $companylogo = array('company_logo'=>$old);

                }*/

                /****************** company logo end ****************/
                $jobs = $this->input->post();
                $jobs =  array_merge($jobs,$featruedimg);
                  unset($jobs['old']);
                  unset($jobs['oldlogo']);
//pre($jobs); die;
                $result = $this->job_model->editJob($jobs, $id);

                if($result == true)
                {
                    $this->session->set_flashdata('success', 'Job updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Job updation failed');
                }

                redirect('jobs/jobListing');
            }
        }else{$this->loadThis();}
    }


    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteJob($id=null)
    {
      if($this->isIndividual()=='true' || $this->isAdmin() =='true' || $this->isCompany())
      {
            $result = $this->job_model->deleteJob($id);

            if ($result > 0) { redirect('jobs/jobListing'); }

        }else{
          $this->loadThis();
        }
    }

  /*  function appliedJobList(){
      $jobarray = array();
      $this->global['pageTitle'] = 'Applied Job Listing';
      $companyinfo = $this->company_model->getCompanylist();

    $data['jobs'] = $this->job_model->jobListing();
    //  $this->loadViews("appliedjoblist", $this->global, NULL, NULL);
    $this->loadViews("appliedjoblist", $this->global, $data , NULL);

  }*/


}

?>
