<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Store extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('store_model');
        $this->load->helper(array('form', 'url'));

        $this->isLoggedIn();
    }

    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {

      $user_id = $this->session->userdata('userId');
      if($this->isIndividual()=='true' || $this->isAdmin() =='true' || $this->isSuplier() =='true')
      {
        if(empty($_POST)){
            $businessDetails = $this->store_model->get_business_detail($user_id);
            $this->global['pageTitle'] = 'Fit4Site : Store page';
            if(!empty($businessDetails)){$data['businessDetails'] = $businessDetails;}else{$data['businessDetails']=NULL;}
            $this->loadViews("store_page", $this->global, $data , NULL);
        }else{
        
            $businessDetails = $this->store_model->get_business_detail($user_id);
            if(!empty($businessDetails)){
              $businessData = array(
                'business_title' => $this->input->post('business_title'),
                'about_us' => $this->input->post('about_us'),
                'contact_us' => $this->input->post('contact_us'),
                'user_id' => $user_id,
              );
              $this->store_model->updateBusinessDetail($user_id,$businessData);
              redirect('store');
            }else{
              $businessData = array(
                'business_title' => $this->input->post('business_title'),
                'about_us' => $this->input->post('about_us'),
                'contact_us' => $this->input->post('contact_us'),
                'user_id' => $user_id,

              );
              $this->store_model->insertBusinessDetail($businessData);
                redirect('store');
            }
        }

      }else{
        $this->loadThis();
      }
    }


}

?>
