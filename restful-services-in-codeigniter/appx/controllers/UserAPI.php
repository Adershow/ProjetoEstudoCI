<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_controller.php';
require APPPATH . '/libraries/Format.php';
use \Restserver\Libraries\Format;

class UserApi extends \Restserver\Libraries\REST_Controller{

  public function __construct(){
    parent::__construct();

    $this->load->model('user_model');
  }

    //API - client sends isbn and on valid isbn book information is sent back
  public function userById_get(){

    $id  = $this->get('id');
    $result = $this->user_model->getUserById( $id );

    if($result){

      $this->response($result, 200); 
      exit;

    }
  } 

  public function userByName_post(){

    $name = $this->post('name');
    $page = $this->post('page');
    switch ($name) {
      case '':

      $result = $this->user_model->getallUsers($page);
      $this->response($result, 200); 
      break;
      
      default:

      $result = $this->user_model->getUserByName($name, $page);
      if($result){
        $this->response($result, 200); 
      }
      break;
    }
  }

  public function verificaUsers_get(){

    $email = $this->get('email');
    $result = $this->user_model->getallUsersV($email);
    $this->response($result, 200); 
  }

    //API -  Fetch All books
  public function users_get(){

    $page = $this->get('page');

    $result = $this->user_model->getallUsers($page);
    $this->response($result, 200); 
  }

  public function rowCount_get(){

    $name = $this->get('name');
    if($name == ''){
      $result = $this->user_model->num_rows();
    }else{
      $result = $this->user_model->num_rows($name);
    }
    
    $this->response($result, 200);
  }

  public function add_post(){

    $name = $this->post('name');
    $email = $this->post('email');
    $senha = $this->post('senha');
    $adm = $this->post('adm');
    $this->user_model->add(array('nome' => $name, 'email'=> $email, 'senha'=>$senha, 'adm'=> $adm));
    $this->response("success", 200);  
  }

  public function updateUser_put(){

    $id = $this->put('id');
    $name = $this->put('name');
    $email = $this->put('email');
    $adm = $this->put('adm');
    if(!empty($this->put('senha'))){
      $senha = $this->put('senha');
      $this->user_model->update($id ,array('nome' => $name, 'email'=> $email, 'senha'=> md5($senha), 'adm' => $adm));
    }else{
      $this->user_model->update($id ,array('nome' => $name, 'email'=> $email, 'adm' => $adm));
    }
  }

  public function delete_delete(){

    $id = $this->delete('id');
    $this->user_model->delete($id);
  }

  public function logar_post(){
    $email = $this->post('email');
    $senha = $this->post('senha');

    $result = $this->user_model->getUserByEmail($email, $senha);
    $this->response($result, 200);
  }
}