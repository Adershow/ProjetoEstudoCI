<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_controller.php';
require APPPATH . '/libraries/Format.php';
use \Restserver\Libraries\Format;

class CatApi extends \Restserver\Libraries\REST_Controller{

  public function __construct(){
    parent::__construct();

    $this->load->model('cat_model');
  }

    //API - client sends isbn and on valid isbn book information is sent back
  public function catById_get(){

    $id  = $this->get('id');
    $result = $this->cat_model->getCatById( $id );

    if($result){
      $this->response($result, 200); 
      exit;
    }
  } 

  public function catByName_post(){

    $name = $this->post('name');
    $page = $this->post('page');
    switch ($name) {
      case '':

      $result = $this->cat_model->getallCats($page);
      $this->response($result, 200); 
      break;
      
      default:

      $result = $this->cat_model->getCatByName($name, $page);
      if($result){
        $this->response($result, 200); 
      }
      break;
    }
  }

  public function verificaCat_post(){

    $name = $this->post('name');
    $result = $this->cat_model->getallCatsV($name);
    $this->response($result, 200); 
  }

    //API -  Fetch All books
  public function cats_get(){

    $page = $this->get('page');

    $result = $this->cat_model->getallCats($page);
    $this->response($result, 200); 
  }

  public function rowCount_get(){

    $name = $this->get('name');
    $cat_id = $this->get('cat_id');
    if($name == '' and $cat_id == ''){
      $result = $this->cat_model->num_rowsCat();
    }if($name == ''){
      $result = $this->cat_model->num_rows('', $cat_id);
    }if($cat_id == ''){
      $result = $this->cat_model->num_rowsCat($name, '');
    }
    
    $this->response($result, 200);
  }

  public function add_post(){

    $name = $this->post('name');
    $this->cat_model->add(array('nome' => $name));
    $this->response("success", 200);  
  }

  public function updateCat_put(){

    $id = $this->put('id');
    $name = $this->put('name');
    $this->cat_model->update($id ,array('nome' => $name));
  }

  public function delete_delete(){

    $id = $this->delete('id');
    $this->cat_model->delete($id);
  }
}