<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Company extends BaseController
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
         $this->global['page_title'] = 'Fit4Site : Company Listing';
         if($this->isTicketter() == FALSE)
         {
             $this->loadThis();
         }
         else
         {

             $searchText = $this->input->post('searchText');
             $this->global['searchText'] = $searchText;
             $this->load->library('pagination');
             $count = $this->company_model->companyListingCount($searchText);
 			       $returns = $this->paginationCompress ( "/", $count, 5 );
             $this->global['companies'] = $this->company_model->companyListing($searchText, $returns["page"], $returns["segment"]);
             $this->global['page_title'] = 'Fit4Site : Company List';
             $this->global['page_name'] = 'backend/company/list';
             $this->load->view("frontend/index", $this->global);
         }


     }



     public function addNewCompany(){
       $this->load->library('form_validation');

       $this->form_validation->set_rules('ac','Title','trim|required|max_length[128]|xss_clean');
       $this->form_validation->set_rules('company_description','Company Description','required');


       if($this->form_validation->run() == FALSE)
       {
           $this->addNew();
       }
       else
       {

           $title = $this->input->post('ac');
           $description = $this->input->post('company_description');
           $website = $this->input->post('company_website');
           $contact = $this->input->post('company_contact');
           $facebook = $this->input->post('facebook_url');
           $twitter = $this->input->post('twitter_url');
           $address = $this->input->post('company_address');
           $user_id = $this->session->userdata('userId');
           $config['upload_path']          = './uploads/company/';
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

           $companyDetails = array('company_name'=>$title, 'company_description'=>$description,'posted_by'=>$user_id,'company_website'=>$website,'company_address'=>$address,'company_contact'=>$contact,'facebook_url'=>$facebook,'twitter_url'=>$twitter,'updated_at'=>date('Y-m-d H:i:s'),'company_image'=>$image_url);

           $result = $this->company_model->addNewCompany($companyDetails);

           if($result > 0)
           {
               $this->session->set_flashdata('success', 'New company created successfully');
           }
           else
           {
               $this->session->set_flashdata('error', 'Company creation failed');
           }

           redirect('backend/company/addNew');
       }
     }


    /**
     * This function is used to load the add new form
     */
    function addNew()
    {

      if($this->isIndividual()=='true' || $this->isAdmin() =='true' || $this->isCompany())
      {
        $this->global['page_name']  = 'backend/company/add';
        $this->global['page_title'] = 'Add New Company';
        $this->load->view('frontend/index',$this->global);
      }
      else
      {
        $this->loadThis();

      }
    }


      function editOld($id= NULL)
      {
        $user_id = $this->session->userdata('userId');
        if($this->isIndividual()=='true' || $this->isAdmin() =='true' || $this->isCompany())
        {
            $this->global['company'] = $this->company_model->getCompanyInfo($user_id,$id);
            $this->global['page_name']  = 'backend/company/edit';
            $this->global['page_title'] = 'Edit Company';
            $this->load->view('frontend/index',$this->global);
          }else{
            $this->loadThis();
          }
      }


      function editCompany()
      {
        if($this->isIndividual()=='true' || $this->isAdmin() =='true' || $this->isCompany())
        {
          $this->load->library('form_validation');

          $id = $this->input->post('id');

          $this->form_validation->set_rules('ac','Title','trim|required|max_length[128]|xss_clean');
          $this->form_validation->set_rules('company_description','Description','required');

          if($this->form_validation->run() == FALSE)
          {

              $this->editOld($id);
          }
          else
          {

              $title = $this->input->post('ac');
              $description = $this->input->post('company_description');
              $company_address = $this->input->post('company_address');
              $company_contact = $this->input->post('company_contact');
              $company_website = $this->input->post('company_website');
              $twitter_url = $this->input->post('twitter_url');
              $facebook_url = $this->input->post('facebook_url');
            //  echo '<pre>'; print_r($_FILES['userfile']['name']);
//die('here');
              $portfolioInfo = array();
              if($_FILES['userfile']['name']!="")
              {
                $config['upload_path']          = './uploads/company';
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
                    //unlink('uploads/company/'.$ulinkOldImg);
                    $image_url = $data['upload_data']['file_name'];


                  }
              }
              else
              {
                     $image_url=$this->input->post('old');
              }
              $companyInfo = array('company_name'=>$title,'company_description'=>$description,'company_image'=>$image_url,'company_address'=>$company_address,'company_contact'=>$company_contact,'facebook_url'=>$facebook_url,'twitter_url'=>$twitter_url);
              $result = $this->company_model->editCompany($companyInfo, $id);

              if($result == true)
              {
                  $this->session->set_flashdata('success', 'Company updated successfully');
              }
              else
              {
                  $this->session->set_flashdata('error', 'Company updation failed');
              }

              redirect('backend/company');
          }
          }else{$this->loadThis();}
      }

      function deleteCompany($id=null)
      {
        if($this->isIndividual()=='true' || $this->isAdmin() =='true' || $this->isCompany())
        {
              $result = $this->company_model->deleteCompany($id);

              if ($result > 0) { redirect('backend/company'); }
            }else{
                echo(json_encode(array('status'=>'access')));
            }


      }

      public function viewpostedjobs($company_id){
        if($this->isIndividual()=='true' || $this->isAdmin() =='true' || $this->isCompany())
        {
          $this->global['page_title'] = 'Fit4Site : Posted jOBS';
          $this->global['page_name']  = 'backend/company/viewjobs';
          $this->load->model('job_model');
          $co = $this->company_model->getCompanyName($company_id);
          //pre($co); die;
        //readUnreadCountStatus
          $this->global['company_name'] = $co[0]->company_name;
          $this->global['jobsByCompanyId'] = $this->job_model->getPostedJobByCompanyId($company_id);

          foreach($this->global['jobsByCompanyId'] as $company){
            $this->global['readunreadcounter'][] = $this->job_model->readUnreadCountStatus($company->id);
          }
    //pre($data['readunreadcounter']); die;

         $this->load->view('frontend/index',$this->global);
        }
      }

      public function viewNumberOfUsersAppliedJob($company_id,$job_id){
        $this->load->model('job_model');
        if(!empty($company_id) && !empty($job_id)){
          $this->global['page_title'] = 'Fit4Site : View Applied Candidate';
          $this->global['page_name']  = 'backend/company/viewjobs';
          $this->global['appliedusers'] = $this->job_model->getAppliedCandidateByJobId($company_id,$job_id);
          $status = array('read_unread'=>'0');
          $this->db->where('job_id',$job_id);
          $this->db->update('tbl_applied_jobs',$status);
        $this->load->view('frontend/index',$this->global);
        }
      }



}

?>
