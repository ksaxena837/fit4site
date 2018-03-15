<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Product extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('product_model');
        $this->load->model('category_model');
        $this->load->model('subcategory_model');
        $this->load->library('form_validation');

        $this->load->helper(array('form', 'url'));

        $this->isLoggedIn();
    }

    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {

      if($this->isSuplier()=='true' || $this->isAdmin() =='true')
      {
          $product_code='';
          $product_description='';
          $category_id='';
           $data['product_list'] = $this->product_model->getProductList($product_code,$product_description,$category_id);
           $data['category_list'] = $this->category_model->get_list();
           $this->global['pageTitle'] = 'Fit4Site : Admin Product List';


          $this->loadViews("product/product_list", $this->global, $data, NULL);
      }else{$this->loadThis();}

    }
    public function ProductStatus($id,$status)
    {
        $this->product_model->ProductStatus($id,$status);
        $this->session->set_flashdata('success','Product Status Updated Successfully!!');
        redirect('account/product-list');
    }
    public function deleteProduct($id)
    {
        $this->Product_Model->deleteProduct($id);
        $this->session->set_flashdata('success','Product Deleted Successfully!!');
        redirect('account/product-list');
    }

    public function addCategory()
    {
      //die('here');

      if($this->isSuplier()=='true' || $this->isAdmin() =='true')
      {
        if(empty($_POST))
        {
            $this->global['pageTitle'] = 'Fit4Site : Add Category';
            $data['category_list'] = $this->category_model->get_list();
            $this->loadViews("product/add_category", $this->global, $data, NULL);
        }
      else
       {
          $this->form_validation->set_rules('product_category','Category Name','required');
          if($this->form_validation->run()==TRUE)
          {
              $categoryData = array(
                    'category_name'=> $this->input->post('product_category'),
                    'created_by' => $this->session->userdata('userId'),

                    'created_date' => date('Y-m-d H:i:s'),

                    'status' => 0
              );
              $catname= $this->input->post('product_category');
              $catexist = $this->product_model->check_category($catname);

              if($catexist){
                  $this->session->set_flashdata('error','Product Category Exist');
                  redirect('account/add-category');
              }else{
                $this->db->insert('tbl_category', $categoryData);
                $catId = $this->db->insert_id();
                $this->session->set_flashdata('success','Product Category Added Successfully'); redirect('account/add-category');
              }

          }else{
            $this->global['pageTitle'] = 'Fit4Site : Add Category';
            $data['category_list'] = $this->category_model->get_list();


            $this->loadViews("product/add_category", $this->global, $data, NULL);
          }
       }
     }else{$this->loadThis();}
    }

    public function editCategory($catid)
    {
      if($this->isSuplier()=='true' || $this->isAdmin() =='true')
      {
          if(!empty($_POST))
          {
            $categoryData = array(
                  'category_name'=> $this->input->post('product_category'),
                  'modified_by' => $this->session->userdata('userId'),
                  'modified_date' => date('Y-m-d H:i:s'),
                  'status' => 0
            );
            $this->category_model->editCategorySubmit($categoryData,$catid);
            $this->session->set_flashdata('success','Product Category Updated Successfully'); redirect('account/add-category');
          }
          else
          {
            $this->global['pageTitle'] = 'Fit4Site : Edit Category';
            $data['category'] = $this->category_model->editCategory($catid);
            $data['category_list'] = $this->category_model->get_list();
            //pre($data);
            $this->loadViews("product/edit_category", $this->global, $data, NULL);
          }
      }
      else
      {
        $this->loadThis();
      }
    }

    public function deleteCategory($id)
    {
        $this->category_model->deleteCategory($id);
        $this->session->set_flashdata('success','Category Deleted Successfully!!');
        redirect('account/add-category');
    }
    public function CategoryStatus($id,$status)
    {
        $this->category_model->CategoryStatus($id,$status);
        $this->session->set_flashdata('success','Category Updated Successfully!!');
        redirect('account/add-category');
    }
    /**
     * This function is used to load the add new form
     */
    function addNew()
    {
      $this->load->model('store_model');
      $user_id = $this->session->userdata('userId');
      if($this->isSuplier()=='true' || $this->isAdmin() =='true')
      {
          if(empty($_POST))
          {
              $this->global['pageTitle'] = 'Fit4Site : Add New Product';
              $data['product_list'] = $this->product_model->get_list();
              $data['category_list'] = $this->category_model->get_list();
              $data['store']  = $this->store_model->get_business_detail($user_id);
              //pre($data);
              $this->loadViews("product/add_product", $this->global, $data, NULL);
          }
          else
          {
            $this->form_validation->set_rules('product_code', 'Product Code', 'required');
            $this->form_validation->set_rules('product_name', 'Product Name', 'required');
            $this->form_validation->set_rules('product_description', 'Product Description', 'required');
            $this->form_validation->set_rules('product_category', 'Product Category', 'required');
            $this->form_validation->set_rules('store_id','Please create store','required');
//            $this->form_validation->set_rules('product_type', 'Product Type', 'required');
            $this->form_validation->set_rules('rate', 'Product Price', 'required');
            if($_FILES['product_image']['name']=='')
                       $this->form_validation->set_rules('product_image','Image','required');
            if($this->form_validation->run() == FALSE)
            {
              $this->global['pageTitle'] = 'Fit4Site : Add New Product';
              $data['product_list'] = $this->product_model->get_list();
              $data['category_list'] = $this->category_model->get_list();
              $data['store']  = $this->store_model->get_business_detail($user_id);
              $this->loadViews("product/add_product", $this->global, $data, NULL);
            }
            else
            {
                if(!empty($this->input->post('sub_category_id')))
                {
                    $sub_category_id = implode(",", $this->input->post('sub_category_id'));
                }
                else
                {
                    $sub_category_id= '';
                }
                if(!empty($this->input->post('relatedproduct')))
                {
                    $relatedproduct = implode(",", $this->input->post('relatedproduct'));
                }
                else
                {
                    $relatedproduct = '';
                }
                $config['upload_path'] = './uploads/products/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['file_name']  = substr(md5(time()), 0, 28);

                //$config['file_name'] = strtolower($_FILES['product_image']['name']);
                $this->load->library('upload', $config);

                $this->upload->initialize($config);
                $this->upload->do_upload('product_image');
                $upload_data	= $this->upload->data();
                  @chmod('./uploads/',0777);
                //echo '<pre>'; print_r($upload_data); die;
                $mainimagefilename	= $upload_data['file_name'];


                $config1['image_library'] = 'gd2';
                $config1['source_image'] = "./uploads/products/$mainimagefilename";
                //$config1['create_thumb'] = TRUE;
                $config1['new_image'] = "./uploads/products/product_thumb/$mainimagefilename";
                $config1['maintain_ratio'] = FALSE;
                $config1['width']         = 300;
                $config1['height']       = 200;
                $this->load->library('image_lib', $config1);
                $this->image_lib->resize();
                $this->image_lib->clear();

                $config2['image_library'] = 'gd2';
                $config2['source_image'] = "./uploads/products/$mainimagefilename";
                //$config1['create_thumb'] = TRUE;
                $config2['new_image'] = "./uploads/products/product_orignal/$mainimagefilename";
                $config2['maintain_ratio'] = FALSE;
                $config2['width']         = 400;
                $config2['height']       = 300;
                $this->load->library('image_lib', $config2);
                $this->image_lib->resize();


              $productData = array(
                    'product_name'=>$this->input->post('product_name'),
                    'product_code'=>$this->input->post('product_code'),
                    'product_description' => $this->input->post('product_description'),
                    'product_long_description' => $this->input->post('product_long_description'),
                    'additional' => $this->input->post('additional'),
                    'product_price' => $this->input->post('rate'),
                    'product_type' => $this->input->post('product_type'),
                    'product_image'=>$mainimagefilename,
                    'category_id' => $this->input->post('product_category'),
                    'sub_category_id' => $sub_category_id,
                    'related_product' => $relatedproduct,
                    'quantity' => $this->input->post('quantity'),
                    'discount' => $this->input->post('product_discount'),
                    'gross_amount' => $this->input->post('gross_amount'),
                    'net'=> $this->input->post('net_amount'),
                    'created_date' =>date("Y-m-d H:i:s"),
                    'modified_date' =>date("Y-m-d H:i:s"),
                    'created_by' => $this->session->userdata('userId'),
                    'modified_by' => $this->session->userdata('userId'),
                    'store_id' => $this->input->post('store_id'),
                    'status' => '0'
              );
                $insert_id = $this->product_model->insertProduct($productData);
                  redirect('account/add-product');
            }

          }
      }else{$this->loadThis();}
    }

    public function editProduct($product_id){
      $this->load->model('store_model');
      $user_id = $this->session->userdata('userId');
      if($this->isSuplier()=='true' || $this->isAdmin() =='true')
      {
          if(empty($_POST))
          {
                      $this->global['pageTitle'] = 'Fit4Site : Edit Product';
                      $data['product_list'] = $this->product_model->get_list();
                      $data['category_list'] = $this->category_model->get_list();
                      $data['store']  = $this->store_model->get_business_detail($user_id);
                      $data['product'] = $this->product_model->getProductById($product_id);
                      //echo '<pre>'; print_r($data['product']); echo '</pre>'; die;
                      $this->loadViews("product/edit_product", $this->global, $data, NULL);
          }else{
                      $this->form_validation->set_rules('product_name', 'Product Name', 'required');
                      $this->form_validation->set_rules('product_description', 'Product Description', 'required');
                      $this->form_validation->set_rules('product_category', 'Product Category', 'required');
                      $this->form_validation->set_rules('store_id','Please create store','required');
          //            $this->form_validation->set_rules('product_type', 'Product Type', 'required');
                      $this->form_validation->set_rules('rate', 'Product Price', 'required');
                      //if($_FILES['product_image']['name']=='')
                                 //$this->form_validation->set_rules('product_image','Image','required');
                      if($this->form_validation->run() == FALSE)
                      {

                        $this->global['pageTitle'] = 'Fit4Site : Edit Product';
                        $data['product_list'] = $this->product_model->get_list();
                        $data['category_list'] = $this->category_model->get_list();
                        $data['store']  = $this->store_model->get_business_detail($user_id);
                        $data['product'] = $this->product_model->getProductById($product_id);
                        //echo '<pre>'; print_r($data['product']); echo '</pre>'; die;
                        $this->loadViews("product/edit_product", $this->global, $data, NULL);
                      }else{
                            if($_FILES['product_image']['name']==''){
                               $mainimagefilename = $this->input->post('oldproductimg');
                             }else{
                               $config['upload_path'] = './uploads/products/';
                               $config['allowed_types'] = 'gif|jpg|png|jpeg';
                               $config['file_name']  = substr(md5(time()), 0, 28);

                               //$config['file_name'] = strtolower($_FILES['product_image']['name']);
                               $this->load->library('upload', $config);

                               $this->upload->initialize($config);
                               $this->upload->do_upload('product_image');
                               $upload_data	= $this->upload->data();
                                 @chmod('./uploads/',0777);
                               //echo '<pre>'; print_r($upload_data); die;
                               $mainimagefilename	= $upload_data['file_name'];


                               $config1['image_library'] = 'gd2';
                               $config1['source_image'] = "./uploads/products/$mainimagefilename";
                               //$config1['create_thumb'] = TRUE;
                               $config1['new_image'] = "./uploads/products/product_thumb/$mainimagefilename";
                               $config1['maintain_ratio'] = FALSE;
                               $config1['width']         = 300;
                               $config1['height']       = 200;
                               $this->load->library('image_lib', $config1);
                               $this->image_lib->resize();
                               $this->image_lib->clear();

                               $config2['image_library'] = 'gd2';
                               $config2['source_image'] = "./uploads/products/$mainimagefilename";
                               //$config1['create_thumb'] = TRUE;
                               $config2['new_image'] = "./uploads/products/product_orignal/$mainimagefilename";
                               $config2['maintain_ratio'] = FALSE;
                               $config2['width']         = 400;
                               $config2['height']       = 300;
                               $this->load->library('image_lib', $config2);
                               $this->image_lib->resize();

                            }

                            $productData = array(
                                  'product_name'=>$this->input->post('product_name'),
                                  //'product_code'=>$this->input->post('product_code'),
                                  'product_description' => $this->input->post('product_description'),
                                  'product_long_description' => $this->input->post('product_long_description'),
                                  'additional' => $this->input->post('additional'),
                                  'product_price' => $this->input->post('rate'),
                                  'product_type' => $this->input->post('product_type'),
                                  'product_image'=>$mainimagefilename,
                                  'category_id' => $this->input->post('product_category'),
                                  'sub_category_id' => $sub_category_id,
                                  'related_product' => $relatedproduct,
                                  'quantity' => $this->input->post('quantity'),
                                  'discount' => $this->input->post('product_discount'),
                                  'gross_amount' => $this->input->post('gross_amount'),
                                  'net'=> $this->input->post('net_amount'),
                                  'created_date' =>date("Y-m-d H:i:s"),
                                  'modified_date' =>date("Y-m-d H:i:s"),
                                  'created_by' => $this->session->userdata('userId'),
                                  'modified_by' => $this->session->userdata('userId'),
                                  'store_id' => $this->input->post('store_id'),
                                  'status' => '0'
                            );
                            $this->product_model->update_product_by_product_id($product_id,$productData);
                            redirect('account/product-list');
                      }

          }
      }
    }

    public function subcategory_view()
    {
        $id = $this->input->post('category_id');
        $response = $this->subcategory_model->viewSubCategory($id);
        $htmlvalue='';
         if(!empty($response))
         {
           foreach($response as $valCat) {
              $htmlvalue.='<option style="text-transform: capitalize;" value="'.$valCat->subcat_id.'">'.$valCat->subcategory_name.'</option>';
           }
           $html = '<label class="col-md-2 control-label">Sub Category<span class="text-danger">*</span></label></div><div class="col-md-7"><select name="sub_category_id[]" class="form-control" multiple>'.$htmlvalue.'</select> ';
         }
         else
         {
             $html = '<label class="col-md-2 control-label">Sub Category<span class="text-danger">*</span></label></div><div class="col-md-7"><select name="sub_category_id[]" class="form-control" multiple></select> ';
         }
         $data['html'] = $html;
         echo json_encode($data);
    }

    function genret_code() {
        $pass = "";
        $chars = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");

        for ($i = 0; $i < 15; $i++) {
            $pass .= $chars[mt_rand(0, count($chars) - 1)];
        }
        return $pass;
    }

    public function product_code()
    {
        $code = $this->genret_code();
        $response = $this->product_model->check_existance($code);
        if ($response) {
                $this->product_code();
           } else {
               echo $code;
               exit;
           }
           exit;
    }




    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function editOld($id= NULL)
    {
      $user_id = $this->session->userdata('userId');

      if($this->isSuplier()=='true' || $this->isAdmin() =='true')
      {

          $data['portfolio'] = $this->portfolio_model->getPortfolioInfo($user_id,$id);
          $this->global['pageTitle'] = 'Fit4Site : Edit Portfolio';

          $this->loadViews("edit_portfolio", $this->global, $data, NULL);


        }else{$this->loadThis();}
    }

}

?>
