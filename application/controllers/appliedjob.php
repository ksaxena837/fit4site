<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Appliedjob extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('company_model');
        $this->load->model('job_model');
        $this->load->helper(array('form', 'url'));

        $this->isLoggedIn();
    }

    public function index()
    {
      $companyId = $this->input->get('c_id');
      $jobId = $this->input->get('jid');
      $userId = $this->session->userdata('userId');
      $appliedJob = array('company_id'=>$companyId,'job_id'=>$jobId,'user_id'=>$userId);
      $checkApplied = $this->job_model->is_applied($jobId,$userId);
      if(empty($checkApplied)){
        $this->job_model->job_applied($appliedJob);
      }

      redirect($_SERVER['HTTP_REFERER']);
    }
}

?>
