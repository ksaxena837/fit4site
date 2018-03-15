<?php
class Checkout_model extends CI_Model
{
	function __construct() {
        // Call the Model constructor
        parent::__construct();


        }

       function addcheckout($data)
        {
        $this->db->insert('tbl_checkout',$data);
				return $this->db->insert_id();

        }
		function addpayment($payment,$in,$uid)
        {


					$this->db->set('payment_option',$payment);
				  $this->db->where('checkout_id',$in);
				   $this->db->where('customer_id',$uid);
          		 $this->db->update('tbl_checkout');

        }
		function addcheckoutcart($cid,$in,$uid)
        {
					$arr = array('sale_id'=>$cid);
          $this->db->where('checkout_id',$in);
          $this->db->where('customer_id',$uid);
          $this->db->update('tbl_checkout',$arr);

        }
		public function get_countries()
		{
			$this->db->from("tbl_countries");
			$query = $this->db->get();
			return $query->result();
		}
		public function get_city()
		{
			$this->db->from("tbl_cities");
			$query = $this->db->get();
			return $query->result();
		}
		function getcartdata($uid)
		{
			$query = $this->db->select('tbl_cart.*,tbl_cart_product.*,tbl_products.product_code');
			$query = $this->db->from('tbl_cart');
			$query= $this->db->join('tbl_cart_product','tbl_cart.cart_id = tbl_cart_product.product_cart_id');
			$query= $this->db->join('tbl_products','tbl_products.id = tbl_cart_product.product_id');
			$query = $this->db->where('tbl_cart.userid',$uid);
			$query = $this->db->where('tbl_cart.is_shipped',0);
			$query = $this->db->get();

			return $query->result();
		}

		function addsale($byname,$total1,$createby,$qu)
        {
      $this->db->set('buyer_name',$byname);
			$this->db->set('grand_amount',$total1);
			$this->db->set('created_by',$createby);
			$this->db->set('issue_date',date('Y-m-d'));
			$this->db->set('total_quantity',$qu);
		   	$this->db->set('status','active');
			$this->db->insert('tbl_sales');

        }
        function addsaledetail($insert,$select4)
        {
                $this->db->set('sale_id',$insert);
                $this->db->set('product_code',$select4->product_code);
                $this->db->set('quantity',$select4->quantity);
                $this->db->set('product_price',$select4->product_price);
								$this->db->set('created_by',$select4->created_by);
                $this->db->insert('tbl_sales_detail');
        }
		function insertcart($total_cart)
        {

        $userid	= $this->session->userdata('userId');
				$this->db->set('created_date',date('Y-m-d'));
				$this->db->set('userid',$userid);
				$this->db->set('total_cart',$total_cart);
				$this->db->insert('tbl_cart');



        }
		function insertcartproductdetail($insert_id,$pid,$price,$qty,$created_by,$ip)
			  {
          $this->db->set('product_cart_id',$insert_id);
          $this->db->set('product_id',$pid);
          $this->db->set('product_price',$price);
          $this->db->set('quantity',$qty);
					$this->db->set('created_by',$created_by);
          $this->db->set('ip',$ip);

          $this->db->insert('tbl_cart_product');
        }


}
