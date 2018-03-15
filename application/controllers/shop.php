<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Shop extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('shop_model');
        $this->load->model('category_model');
        $this->load->library('cart');
        $this->load->helper(array('form', 'url'));

        $this->isLoggedIn();
    }

    public function index(){

    }
    /**
     * Index Page for this controller.
     */
     function shopProduct($pid){
       $this->global['page_name'] = 'single-shop';
       $this->global['page_title'] = 'Product Detail';

       $final_data = array();
       //$product_id = $this->uri->segment('2');
       $this->global['product_detail'] = $this->shop_model->productDetailsignle($pid);

       foreach($this->global['product_detail'] as $post)
       {
           $related_product = $post->related_product;
           if(($related_product!='')){
           $related_id = explode(",", $related_product);

           foreach ($related_id as $post)
           {
               $related_product_detail = $this->shop_model->relatedProduct($post);
              // echo '<pre>';print_r($related_product_detail); die;
               $pro['detail']  = $related_product_detail;
               $final_data[]   = $pro;

           }
         }
           $this->global['related_product_detail'] = $final_data;
       }
       $this->global['userprofile'] = $this->user_model->getuserinfobyid();
       $this->global['roles'] = $this->user_model->getUserRoles();

// pre($data); die;
       $this->load->view('frontend/index',$this->global);
     }
     public function shopByCategoryId($category_id){
       $this->global['page_name']  = 'shopByCategory';
       $this->global['page_title'] = 'Shop';
       $user_id = $this->session->userdata('userId');
       $this->global['categoryproducts'] = $this->shop_model->productByCategoryId($category_id);
       $this->global['category_list'] = $this->category_model->get_list();
       $this->global['userprofile'] = $this->user_model->getuserinfobyid();
       $this->global['roles'] = $this->user_model->getUserRoles();
       $this->load->view('frontend/index',$this->global);
     }




}

?>
