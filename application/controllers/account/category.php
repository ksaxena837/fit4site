<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';


class Category extends BaseController
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
        $this->load->model('common_model');
        $this->load->model('subcategory_model');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url'));

        $this->isLoggedIn();
    }

    public function index(){
      redirect('account/add-category');
    }

    public function addSubCategory($id)
    {

      if($this->isSuplier()=='true' || $this->isAdmin() =='true')
      {
        if(empty($_POST)){
            $this->global['pageTitle'] = 'Fit4Site : Product Sub Category';
            $this->loadViews("product/subcategory/add", $this->global, NULL, NULL);
        }else{
          $this->form_validation->set_rules('sub_category_name', 'Sub Category Name', 'trim|required');
          if($_FILES['subimage']['name']=='')
                 $this->form_validation->set_rules('subimage','Image','required');

          if ($this->form_validation->run() == FALSE)
          {
            $this->global['pageTitle'] = 'Fit4Site : Product Sub Category';
            $this->loadViews("product/subcategory/add", $this->global, NULL, NULL);
          }else{
            $config['upload_path'] = './uploads/subcategory/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['file_name']  = substr(md5(time()), 0, 28);
            //$config['file_name'] = strtolower($_FILES['product_image']['name']);
            $this->load->library('upload', $config);

            $this->upload->initialize($config);
            $this->upload->do_upload('subimage');
            $upload_data	= $this->upload->data();
            $mainimagefilename	= $upload_data['file_name'];
            @chmod('./uploads/',0777);
            $subData = array(
              'parent_category_id' => $id,
              'subcategory_name' => $this->input->post('sub_category_name'),
              'image'=> $mainimagefilename,
              'created_by' => $this->session->userdata('userId'),
              'created_date' => date('Y-m-d H:i:s'),
              'status' => 0
            );
            $this->subcategory_model->insertSubCategoryData($subData);
            $this->session->set_flashdata('success','Subcategory Added Successfully');
            redirect('account/category');

          }
        }
      }else{$this->loadThis();}
    }

    public function editSubCategory($id)
    {

      if($this->isSuplier()=='true' || $this->isAdmin() =='true')
      {
        if(empty($_POST)){
            $this->global['pageTitle'] = 'Fit4Site : Edit Sub Category';
            $data['editSubCategory'] = $this->subcategory_model->editSubCategory($id);
            //pre($data);die;
            $this->loadViews("product/subcategory/edit", $this->global, $data, NULL);
        }else{
          $this->form_validation->set_rules('sub_category_name', 'Sub Category Name', 'trim|required');



          if ($this->form_validation->run() == FALSE)
          {
            $this->global['pageTitle'] = 'Fit4Site : Edit Sub Category';
            $data['editSubCategory'] = $this->subcategory_model->editSubCategory($id);
            $this->loadViews("product/subcategory/edit", $this->global, $data, NULL);
          }else{

            if($_FILES['subimage']['name']==''){
                          $mainimagefilename	=$this->input->post('sub_category_image');

            }else{
                      $config['upload_path'] = './uploads/subcategory/';
                      $config['allowed_types'] = 'gif|jpg|png|jpeg';
                      $config['file_name']  = substr(md5(time()), 0, 28);
                      //$config['file_name'] = strtolower($_FILES['product_image']['name']);
                      $this->load->library('upload', $config);

                      $this->upload->initialize($config);
                      $this->upload->do_upload('subimage');
                      $upload_data	= $this->upload->data();
                        @chmod('./uploads/',0777);
                      $mainimagefilename	= $upload_data['file_name'];
            }
            $subData = array(
              //'parent_category_id' => $id,
              'subcategory_name' => $this->input->post('sub_category_name'),
              'image'=> $mainimagefilename,
              'modified_by' => $this->session->userdata('userId'),
              'modified_date' => date('Y-m-d H:i:s'),
              'status' => 0
            );
            $this->subcategory_model->updateSubCategoryData($id,$subData);
            $this->session->set_flashdata('success','Subcategory Updated Successfully');
            redirect('account/category');

          }
        }
      }else{$this->loadThis();}
    }

    public function viewSubCategory($id) {
          $this->global['pageTitle'] = 'Fit4Site : Product Sub Category List';
           $data['subCategoryList'] = $this->subcategory_model->viewSubCategory($id);

           $this->loadViews('product/subcategory/list',$this->global,$data,NULL);
    }

    public function SubCategoryDelete($id)
    {
        $this->subcategory_model->SubCategoryDelete($id);
        $this->session->set_flashdata('success','Subcategory Deleted Successfully!!');
        redirect('account/category');
    }


}

?>
