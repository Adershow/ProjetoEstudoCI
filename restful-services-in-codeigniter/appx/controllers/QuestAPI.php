<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_controller.php';
require APPPATH . '/libraries/Format.php';
use \Restserver\Libraries\Format;

class QuestAPI extends \Restserver\Libraries\REST_Controller{

  public function __construct(){
    parent::__construct();

    $this->load->model('quest_model');
  }

    //API - client sends isbn and on valid isbn book information is sent back
  public function questById_get(){

    $id  = $this->get('id');
    $result = $this->quest_model->getQuestById( $id );

    if($result){
      $this->response($result, 200); 
      exit;
    }
  } 

  public function questBytitulo_post(){

    $titulo = $this->post('titulo');
    $topi_id = $this->post('topi_id');
    $page = $this->post('page');
    switch ($titulo) {
     case '':
     if($topi_id != ''){
      $result = $this->quest_model->getQuestByTopititulo($topi_id, $page);
    }else{
      $result = $this->quest_model->getallQuests($page);
    }
    if($result){
     $this->response($result, 200); 
   }
   break;

   default:
   if($topi_id != ''){
    $result = $this->quest_model->getQuestBytituloTopi($titulo, $topi_id, $page);
  }else{
    $result = $this->quest_model->getQuestBytitulo($titulo, $page);
  }
  if($result){
    $this->response($result, 200); 
  }
  break;
}
}

public function verificaQuest_post(){

  $titulo = $this->post('titulo');
  $result = $this->quest_model->getallQuestsV($titulo);
  $this->response($result, 200); 
}

    //API -  Fetch All books
public function quests_get(){

  $page = $this->get('page');
  $topi_id = $this->get('topi_id');

  switch ($topi_id) {

    case '':
    $result = $this->quest_model->getallQuests($page);
    $this->response($result, 200); 
    break;

    default:
    $result = $this->quest_model->getQuestByTopititulo($page, $topi_id);
    $this->response($result, 200); 
    break;
  }
}

public function rowCount_get(){

  $titulo = $this->get('titulo');
  $quest_id = $this->get('quest_id');
  if($titulo == '' and $quest_id == ''){
    $result = $this->quest_model->num_rowsQuests();
  }if($titulo == ''){
    $result = $this->quest_model->num_rows('', $quest_id);
  }if($quest_id == ''){
    $result = $this->quest_model->num_rowsQuests($titulo);
  }

  $this->response($result, 200);
}

public function add_post(){

  $titulo = $this->post('titulo');
  $conteudo = $this->post('conteudo');
  $imgPath = $this->post('imgPath');
  $topi_id = $this->post('topi_id');

  if($this->post('imgPath') != ''){
    $imgPath = $this->post('imgPath');
    $this->quest_model->add(array('titulo' => $titulo, 'conteudo' => $conteudo, 'imagem' => $imgPath, 'topicos_id' => $topi_id));
  }else{
    $this->quest_model->add(array('titulo' => $titulo, 'conteudo' => $conteudo, 'topicos_id' => $topi_id));
  }
  $this->response("success", 200);  
}

public function updateQuest_put(){

  $id = $this->put('id');
  $titulo = $this->put('titulo');
  $conteudo = $this->put('conteudo');
  $imgPath = $this->put('imgPath');
  $topi_id = $this->put('topi_id');
  $this->quest_model->update($id ,array('titulo' => $titulo, 'conteudo' => $conteudo, 'imagem' => $imgPath, 'topicos_id' => $topi_id));
}

public function delete_delete(){

  $id = $this->delete('id');
  $this->quest_model->delete($id);
}
}