<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_controller.php';
require APPPATH . '/libraries/Format.php';
use \Restserver\Libraries\Format;

class TopiApi extends \Restserver\Libraries\REST_Controller{

  public function __construct(){
    parent::__construct();

    $this->load->model('topi_model');
  }

    //API - client sends isbn and on valid isbn book information is sent back
  public function topiById_get(){

    $id  = $this->get('id');
    $result = $this->topi_model->getTopiById( $id );

    if($result){
      $this->response($result, 200); 
      exit;
    }
  } 

  public function topiByName_post(){

    $name = $this->post('name');
    $cat_id = $this->post('cat_id');
    $page = $this->post('page');
       switch ($name) {
       case '':
       if($cat_id != ''){
          $result = $this->topi_model->getTopiByCatName($cat_id, $page);
       }else{
        $result = $this->topi_model->getallTopis($page);
       }
       if($result){
       $this->response($result, 200); 
      }
       break;

       default:
       if($cat_id != ''){
        $result = $this->topi_model->getTopiByNameCat($name, $cat_id, $page);
      }else{
      $result = $this->topi_model->getTopiByName($name, $page);
      }
      if($result){
        $this->response($result, 200); 
      }
      break;
      }
  }

  public function verificaTopi_post(){

    $name = $this->post('name');
    $result = $this->topi_model->getallTopisV($name);
    $this->response($result, 200); 
  }

    //API -  Fetch All books
  public function topis_get(){

    $page = $this->get('page');
    $cat_id = $this->get('cat_id');

    switch ($cat_id) {

      case '':
      $result = $this->topi_model->getallTopis($page);
      $this->response($result, 200); 
      break;

      default:
      $result = $this->topi_model->getTopiByCatName($page, $cat_id);
      $this->response($result, 200); 
      break;
    }
  }

  public function rowCount_get(){

    $name = $this->get('name');
    $topis_id = $this->get('topis_id');
    if($name == '' and $topis_id == ''){
      $result = $this->topi_model->num_rowsTopis();
    }if($name == ''){
      $result = $this->topi_model->num_rows('', $topis_id);
    }if($topis_id == ''){
      $result = $this->topi_model->num_rowsTopis($name);
    }

    $this->response($result, 200);
  }

  public function add_post(){

    $name = $this->post('name');
    $cat_id = $this->post('cat_id');
    $this->topi_model->add(array('nome' => $name, 'categorias_id' => $cat_id));
    $this->response("success", 200);  
  }

  public function updateTopi_put(){

    $id = $this->put('id');
    $name = $this->put('name');
    $cat_id = $this->put('cat_id');
    $this->topi_model->update($id ,array('nome' => $name, 'categorias_id' => $cat_id));
  }

  public function delete_delete(){

    $id = $this->delete('id');
    $this->topi_model->delete($id);
  }
}