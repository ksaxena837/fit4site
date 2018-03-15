<?php
require APPPATH . '/libraries/BaseController.php';

class Chat extends BaseController {

	//Global variable
    public $outputData;		//Holds the output data for each view
	public $loggedInUser;
	public function __construct()
	{
			parent::__construct();
			$this->load->model('user_model');
			$this->load->model('company_model');
			$this->load->helper(array('form', 'url'));

			$this->isLoggedIn();
	}

	public function index()
    {
			if($this->isTicketter() == TRUE)
			{
		    $this->global['listOfUsers']	= $this->user_model->getUsers();
		    $this->global['pageTitle'] = 'Fit4Site : Chat';
		    $this->loadViews('userList',$this->global,NULL,NULL);
		  }
    }


}
?>
