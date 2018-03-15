<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller {

				function __construct()
				{
			        parent::__construct();
			        $this->load->library('session');
			        $this->load->library('cart');
			        $this->load->library('session');
			        $this->load->library('encrypt');
			        $this->load->model('checkout_model');
			        if ($this->session->userdata('userId')== "")
			        {
			            redirect('login');
			        }
			  }

				public function index()
				{
					$page_data['page_title'] = 'Checkout';
					$page_data['page_name'] = 'checkout';
					$this->load->view('frontend/index',$page_data);
				}

				public function placeOrder()
				{
					$payment = $this->input->post('pay_method');
					if(!empty($_POST) && !empty($payment)){

						$data = array(
							'firstname' => $this->input->post('first_name'),
							'lastname'	=> $this->input->post('last_name'),
							'address1' => $this->input->post('address_one'),
							'address2' => $this->input->post('address_two'),
							'phone' => $this->input->post('phone'),
							'country' => $this->input->post('country'),
							'city'	=> $this->input->post('city'),
							'province' => $this->input->post('province'),
							'postcode' => $this->input->post('postcode'),
							'customer_id'  => $this->session->userdata('userId'),
							'payment_option' => $this->input->post('pay_method'),
							'order_date' => date('Y-m-d h:i:s')
						);
							$this->session->set_userdata('first_name');
							$insert_id = $this->checkout_model->addcheckout($data);
							$this->session->set_userdata('checkout_id',$insert_id);

					}

					$total=0;
					$qu=0;
					//add to cart in databas
					if(!empty($this->cart->contents()))
					{
							$total = 0;
							$total_cart=$this->cart->total_items();
							$this->checkout_model->insertcart($total_cart);
						  $insert_id=$this->db->insert_id();
							$checkout_id=$this->session->userdata('checkout_id');
							$user_id = $this->session->userdata('userId');
							$this->checkout_model->addcheckoutcart($insert_id,$checkout_id,$user_id);
							$carts = $this->cart->contents();
							foreach ($carts as $items)
							{
								$ip = $_SERVER['REMOTE_ADDR'];
								$total = $total + (($items['qty']) * ($items['price']));
								$qu = $qu + $items['qty'];
								$created_by = $items['created_by'];
								$this->checkout_model->insertcartproductdetail($insert_id,$items['id'],$items['price'],$items['qty'],$created_by,$ip);
							}
						}
								//add sales detail to database
								$byname=$this->session->userdata('first_name');
								$total1 = $total+5;
								$createby= '0';
								//$user_id = $this->session->userdata('userId');
								$this->checkout_model->addsale($byname,$total1,$createby,$qu);
								$insert=$this->db->insert_id();
								$this->checkout_model->addcheckoutcart($insert,$checkout_id,$user_id);
								$output['cartdetail'] = $this->checkout_model->getcartdata($user_id);
								foreach ($output['cartdetail'] as $select4):
								$this->checkout_model->addsaledetail($insert,$select4);
								endforeach;
								$this->cart->destroy();
								$this->db->set('is_shipped',1);
								$this->db->where('userid',$user_id);
								$this->db->update('tbl_cart');
								redirect('cart');

				}

}
