<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

        public function __construct()
	{
            parent::__construct();
            //load model
            $this->load->model('shop_model');
            $this->load->model('product_model');
            $this->load->library('cart');
            $this->load->helper('url');
            $this->load->helper('form');
            $this->load->library('session');
            $this->load->library('encrypt');
            $this->cart->product_name_rules = '[:print:]';
        }


        public function index()
        {
          $page_data['page_title'] = 'Cart';
          $page_data['page_name'] = 'cart';
          $this->load->view('frontend/index',$page_data);
        }

            function add()
            {
                $insert_data = array(
                        'id' => $this->input->post('id'),
                        'name' => $this->input->post('name'),
                        'price' => $this->input->post('price'),
                        'qty' => $this->input->post('qty'),
                        'image' => $this->input->post('image'),
                        'created_by' => $this->input->post('created_by')

                );
                $this->cart->insert($insert_data);
                redirect('cart');
            }
            function remove($rowid) {
          		if ($rowid==="all"){
                	$this->cart->destroy();
          		}else{
                  $data = array(
          				'rowid'   => $rowid,
          				'qty'     => 0
          			);
                $this->cart->update($data);
          		}
                redirect('cart');
          	}

        function update_cart(){
            // Recieve post values,calcute them and update
            $cart_info =  $_POST['cart'] ;
            foreach( $cart_info as $id => $cart)
            {
                $rowid = $cart['rowid'];
                $price = $cart['price'];
                $amount = $price * $cart['qty'];
                $qty = $cart['qty'];

                    $data = array(
                            'rowid'   => $rowid,
                            'price'   => $price,
                            'amount' =>  $amount,
                            'qty'     => $qty
                    );

                    $this->cart->update($data);
            }
            redirect('cart');
	}


}
