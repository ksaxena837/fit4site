<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';

class Home extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('shop_model');
        $this->load->model('user_model');
        $this->load->model('category_model');

    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
      $this->global['page_name']  = 'home';
      $this->global['page_title'] = 'home';
      $this->global['userprofile'] = $this->user_model->getuserinfobyid();
      $this->global['roles'] = $this->user_model->getUserRoles();
      $this->load->view('frontend/index',$this->global);
    }
    /**
     * Index Page for this controller.
     */
    public function about()
    {
      $this->global['page_name']  = 'about';
      $this->global['page_title'] = 'About Us';
      $this->load->view('frontend/index',$this->global);
    }
    /**
     * Index Page for this controller.
     */
    public function services()
    {
      $this->global['page_name']  = 'services';
      $this->global['page_title'] = 'Our Services';
      $this->load->view('frontend/index',$this->global);
    }

    /**
     * Index Page for this controller.
     */
    public function contact()
    {
      $this->global['page_name']  = 'contact';
      $this->global['page_title'] = 'Contact Us';
      $this->load->view('frontend/index',$this->global);
    }

    /**
     * Index Page for this controller.
     */
    public function portfolio()
    {
      $this->load->model('portfolio_model');
      $this->global['page_name']  = 'portfolio';
      $this->global['page_title'] = 'Portfolio';
      $user_id = $this->session->userdata('userId');
      $this->global['portfolios'] = $this->portfolio_model->getPortfoliosByUserId($user_id);

      $this->load->view('frontend/index',$this->global);
    }

    /**
     * Index Page for this controller.
     */
    public function shop()
    {
      //if($this->session->userdata('role')==ROLE_CLIENT){
      //$this->load->model('shop_model');
      $this->global['page_name']  = 'shop';
      $this->global['page_title'] = 'Shop';
      $user_id = $this->session->userdata('userId');
      $this->global['category_list'] = $this->category_model->get_list();
      //$data['slider'] = $this->Dashboard_Model->get_slider();
      //$data['subcate'] = $this->Subcategory_Model->viewSubCategoryList();
      $this->global['latest_product'] = $this->shop_model->latest_product();
      $this->global['popular_product'] = $this->shop_model->popular_product();
      $this->global['feature_product'] = $this->shop_model->feature_product();
      $this->global['userprofile'] = $this->user_model->getuserinfobyid();
      $this->global['roles'] = $this->user_model->getUserRoles();
      //pre($page_data); die;
      $this->load->view('frontend/index',$this->global);
      //}else{redirect('/');}
    }



    /**
     * Jobs Page for this controller.
     */
    public function jobs()
    {

      $this->load->model('job_model');
      $this->load->library('pagination');
      $this->global['page_name']  = 'jobs';
      $this->global['page_title'] = 'Jobs';
      //$page_data['jobs'] = $this->job_model->getJobsDetail();
        $limit_per_page = 5;
        $page = ($this->uri->segment(2)) ? ($this->uri->segment(2) - 1) : 0;
        $total_records = $this->job_model->get_total();
        if ($total_records > 0)
        {
            // get current page records
            $this->global["jobs"] = $this->job_model->get_current_page_records($limit_per_page, $page*$limit_per_page);
            //pre($page_data); die;
            $config['base_url'] = base_url() . 'index.php/featured-job';
            $config['total_rows'] = $total_records;
            $config['per_page'] = $limit_per_page;
            $config["uri_segment"] = 2;

            $config['num_links'] = 2;
            $config['use_page_numbers'] = TRUE;
            $config['reuse_query_string'] = TRUE;

            $config['full_tag_open'] = '<nav id="job-listing-pagination"><ul class="pagination pull-right">';
            $config['full_tag_close'] = '</ul></nav>';
            $config['next_link'] = '<span aria-hidden="true">&raquo;</span>';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';

            $config['prev_link'] = '<span aria-hidden="true">&laquo;</span>';
            $config['prev_tag_open'] = '<li>';
            $config['prev_tag_close'] = '</li>';

            $config['cur_tag_open'] = '<li class="active"><span>';
            $config['cur_tag_close'] = '</span></li>';

            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            // build paging links
            $this->global["links"] = $this->pagination->create_links();
        }
        $this->load->model('user_model');
        $this->global['userprofile'] = $this->user_model->getuserinfobyid();
        $this->load->view('frontend/index',$this->global);
    }

    /**
      * this function is used to display single job detail page
      * @param $jobid integer
      * @return $result : array/null
      */
      public function singleJob($job_id=null)
      {
        $this->load->model('job_model');
        $user_id = $this->session->userdata('userId');
        if(!empty($job_id))
        {
          $this->global['page_title'] = 'Single Job';
          $this->global['page_name'] = 'single-job';
          $this->global['job'] = $this->job_model->get_single_job_information($job_id);
          $checkApplied = $this->job_model->is_applied($job_id,$user_id);
          if(!empty($checkApplied)){$this->global['appliedstatus']= 'APPLIED';}else{$this->global['appliedstatus']= 'APPLY NOW';}
          $this->load->model('user_model');
      		$this->global['userprofile'] = $this->user_model->getuserinfobyid();
          $this->load->view('frontend/index',$this->global);
        }
      }

      public function single_portfolio(){
        $this->global['page_title'] = 'Single Portfolio';
        $this->global['page_name'] = 'single-portfolio';
          $this->load->view('frontend/index',$this->global);
      }

      public function cart(){
        $this->global['page_title'] = 'Cart';
        $this->global['page_name'] = 'cart';
          $this->load->view('frontend/index',$this->global);
      }

      public function checkout(){
        $this->global['page_title'] = 'Checkout';
        $this->global['page_name'] = 'checkout';
          $this->load->view('frontend/index',$this->global);
      }

      public function searchJob(){
        $match1 = $this->input->post('match1');
        $match2 = $this->input->post('match2');
        $this->global['page_title'] = 'Jobs';
        $this->global['page_name'] = 'job_search';
        $this->load->model('job_model');
        $this->global['match1'] = $match1;
        $this->global['match2'] = $match2;
          $limit_per_page = 1;
          $page = ($this->uri->segment(3)) ? ($this->uri->segment(3) - 1) : 0;
          $this->global['jobs'] = $this->job_model->jobsearch($limit_per_page, $page*$limit_per_page,$match1,$match2);
          //pre($page_data); die;
      $this->load->view('frontend/index',$this->global);
        //pre($data); die;

      }

}

?>
