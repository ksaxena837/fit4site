<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/BaseController.php';
class Sale extends BaseController {

  public function __construct()
	{
        parent::__construct();
        $this->load->model('sale_model');
        $this->load->model('category_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('product_model');
        $this->load->model('user_model');
        $this->isLoggedIn();
	}




      public function index()
        {
          if($this->isSuplier()=='true'){
           $suplierId = $this->session->userdata('userId');
          //{die('here');
           if(!empty($_POST))
        		{
        			$buyer_name = $this->input->post('buyer_name');
        			$start_date = $this->input->post('start_date');
        			$end_date = $this->input->post('end_date');
        			$created_name = $this->input->post('created_name');
              //$allRecord = $this->sale_model->getAllHistoryRecord($buyer_name,$start_date,$end_date,$created_name);
              $allRecord = $this->sale_model->getOrdersBySuplierId($suplierId);
            //  pre($allRecord); die;
        			$output['sale_list'] = $allRecord;
        			$output['start_date'] = $start_date;
        			$output['end_date'] = $end_date;
              $output['Buyer_Name'] = $this->sale_model->Buyer_Name();
        			$output['created_names'] = $created_name;
        			$output['buyername'] = $buyer_name;
              $this->global['pageTitle'] = 'Fit4Site : Sales Report';
              $this->loadViews('sale/sale_list1',$this->global, $output , NULL);
        		}else {
                $output['Buyer_Name'] = $this->sale_model->Buyer_Name();
                //$output['sale_list'] = $this->sale_model->get_list();
                $this->global['pageTitle'] = 'Fit4Site : Sales Report';
                $allRecord = $this->sale_model->getOrdersBySuplierId($suplierId);
                $output['sale_list'] = $allRecord;
                //pre($allRecord); die;
                $this->loadViews('sale/sale_list1',$this->global, $output , NULL);
            }
         }else{
          //  die('htere');
            $this->loadThis();
         }



        }



        public function shipped()
        {
               if(!empty($_POST))
            		{
            			$buyer_name = $this->input->post('buyer_name');
            			$start_date = $this->input->post('start_date');
            			$end_date = $this->input->post('end_date');
            			$created_name = $this->input->post('created_name');
                  $allRecord = $this->sale_model->getAllHistoryRecordStatus($buyer_name,$start_date,$end_date,$created_name);
            			$output['sale_list'] = $allRecord;
            			$output['start_date'] = $start_date;
            			$output['end_date'] = $end_date;
                  $output['Buyer_Name'] = $this->sale_model->Buyer_Name_Status();
            			$output['created_names'] = $created_name;
            			$output['buyername'] = $buyer_name;
                  $this->global['pageTitle'] = 'Fit4Site : Product Shipped Report';
                  $this->loadViews('sale/shipped',$this->global,$output,NULL);
            		}
                else
                {

                    $output['Buyer_Name'] = $this->sale_model->Buyer_Name_Status();
                    $output['sale_list'] = $this->sale_model->shipped();
                      $this->global['pageTitle'] = 'Fit4Site : Product Shipped Report';
                    $this->loadViews('sale/shipped',$this->global,$output,NULL);
                }

        }

        public function SaleDetail($id)
        {

            $output['sale_detail'] = $this->sale_model->SaleDetail($id);
            $output['sale_address_detail'] = $this->sale_model->Address_Detail($id);
            $output['deliver_sale'] = $this->sale_model->Deliver_Sale($id);
            $this->global['pageTitle'] = 'Fit4Site : Sales Report';
           //pre($output['deliver_sale']); die;
            $this->loadViews('sale/details',$this->global,$output,NULL);
        }
        public function SaleStatus($id)
        {
            $output['deliver_sale'] = $this->sale_model->SaleStatus($id);
            $this->session->set_flashdata('SUCCESSMSG','Order Successfully Placed!!');
            redirect('sate/saleDetail/'.$id);
        }



}
