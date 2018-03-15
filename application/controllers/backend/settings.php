<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Settings extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('settings_model');
        $this->load->helper(array('form', 'url'));
        $this->isLoggedIn();
    }

    public function index(){
      $this->global['userprofile'] = $this->user_model->getuserinfobyid();
      $this->global['roles'] = $this->user_model->getUserRoles();
      $this->global['page_title'] = 'Fit4Site : General Settings';
      $this->global['page_name'] = 'backend/profile_settings';
      $this->load->view("frontend/index", $this->global);

    }

    public function updateGeneralSettings(){
      $availablestatus = $this->input->post('availablestatus');
      $callstatus = $this->input->post('callstatus');
      $about_status = $this->input->post('about_status');
      $email_status = $this->input->post('email_status');
      $website_status = $this->input->post('website_status');
      $userSettings = array();
      if(!empty($availablestatus)){
        $userSettings['availablity_status	'] = $availablestatus;
      }
      if(!empty($callstatus)){
        $userSettings['on_call_status	'] = $callstatus;
      }
      if(!empty($about_status)){
        $userSettings['about_status	'] = $about_status;
      }
      if(!empty($email_status)){
        $userSettings['email_status'] = $email_status;
      }
      if(!empty($website_status)){
        $userSettings['website_status	'] = $website_status;
      }
      if($this->settings_model->updateUserSettings($userSettings)){
        redirect('backend/settings');
      }
    }

}
