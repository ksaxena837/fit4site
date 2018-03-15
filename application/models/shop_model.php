<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Shop_model extends CI_Model
{
  public function latest_product()
  {
      $this->db->select(" * ");
      $this->db->from('tbl_products');
      $this->db->where('product_type', '1');
      $this->db->where('status <>', '1');
      //$this->db->limit('4');
      $query = $this->db->get();
      return $query->result();
  }
  public function popular_product()
  {
      $this->db->select(" * ");
      $this->db->from('tbl_products');
      $this->db->where('product_type', '2');
      $this->db->where('status <>', '1');
      //$this->db->limit('4');
      $query = $this->db->get();
      return $query->result();
  }
  public function feature_product()
  {
      $this->db->select(" * ");
      $this->db->from('tbl_products');
      $this->db->where('product_type', '3');
      $this->db->where('status <>', '1');
      //$this->db->limit('4');
      $query = $this->db->get();
      return $query->result();
  }
  public function get_slider()
  {
      $this->db->select(" * ");
      $this->db->from('tbl_slider_images');
//            $this->db->order_by('rand()');
//            $this->db->limit('3');
      $query = $this->db->get();
      return $query->result();
  }

  public function detail_view_product($id){
  $this -> db -> select(' * ');
  $this -> db -> from('tbl_products');
  $this->db->where('id', $id);
  $query = $this -> db -> get();
  return $query->result();
  }

  public function products_detail($product){
  $this -> db -> select(' * ');
  $this -> db -> from('tbl_products');
  $this->db->where('id', $product);
  $query = $this -> db -> get();
  return $query->result();
  }
  public function Insert_Contact($name,$email,$message){
      $this->db->set('name', $name);
      $this->db->set('email',$email);
      $this->db->set('message',$message);
      $this->db->set('date',date("Y-m-d H:i:s"));
      $this->db->insert('tbl_contact');
  }

  function productDetailsignle($product_id) {
      $this->db->select(" p.*,c.category_name ");
      $this->db->from('tbl_products p');
      $this->db->join('tbl_category c','c.id=p.category_id');
      $this->db->where('p.id',$product_id);
      $query = $this->db->get();
      return $query->result();
  }
  function relatedProduct($post) {
      $this->db->select(" * ");
      $this->db->from('tbl_products');
      $this->db->where('tbl_products.id',$post);
      $query = $this->db->get();
      return $query->result();
  }
  function SingleProuctDetail($product_id) {
      $this->db->select(" * ");
      $this->db->from('tbl_products');
      $this->db->where('id',$product_id);
      $query = $this->db->get();
      return $query->result();
  }

  function productByCategoryId($category_id){

    $this->db->select('*');
    $this->db->from('tbl_products');
    $this->db->where('category_id',$category_id);
    $query = $this->db->get();
    $result = $query->result();
    if(!empty($result)){
      return $result;
    }
  }

}
