<?php
class Quest_model extends CI_Model{
  
  function __construct(){
    $this->load->database();
  }

  public function getQuestById($id){

    $query = array();
    $this->db->select('id, titulo, conteudo, tempo, avaliacao, imagem');
    $this->db->from('questoes');
    $this->db->where('id', $id);
    $topicos = $this->db->get();

    if($topicos->num_rows() == 1){

      $this->db->select('id, conteudo, imagem, certa');
      $this->db->from('respostas');
      $this->db->where('questoes_id', $id);
      $questoes = $this->db->get();

      if($questoes->num_rows() > 0){
        $query = array_merge($topicos->result_array(), $questoes->result_array());
        return $query;
      }else{
        return $topicos->result_array();
      }
    } 
  }

  public function getQuestBytituloTopi($titulo = '', $topi_id = '', $page){

    $pageResult = $page * 10;
    $encoding = mb_internal_encoding(); 
    $titulo = mb_strtoupper($titulo, $encoding);
    $topicos = $this->db->get_where('questoes', array('UCASE(titulo)' => $titulo, 'topicos_id' => $topi_id), 10, $pageResult);
    return $topicos->result_array();
  }

   public function getQuestBytitulo($titulo = '', $page){

    $pageResult = $page * 10;
    $encoding = mb_internal_encoding(); 
    $titulo = mb_strtoupper($titulo, $encoding);
    $topicos = $this->db->get_where('questoes', array('UCASE(titulo)' => $titulo), 10, $pageResult);
    return $topicos->result_array();
  }

   public function getQuestByTopititulo($topi_id, $page){

    $pageResult = $page * 10;
    $encoding = mb_internal_encoding(); 
    $topicos = $this->db->get_where('questoes', array('topicos_id' => $topi_id), 10, $pageResult);
    return $topicos->result_array();
  }

  public function getallQuests($page){

    $pageResult = $page * 10;
    $this->db->limit(10, $pageResult)->get_compiled_select('questoes', FALSE);
    $query = $this->db->select('id, titulo, tempo, avaliacao, topicos_id')->get_compiled_select();
    $result = $this->db->query($query);

    if($result->num_rows() > 0){
      return $result->result_array();
    }
  }

  public function getallQuestsV($titulo){

    $this->db->select('id, titulo');
    $this->db->from('questoes');
    $encoding = mb_internal_encoding(); 
    $titulo = mb_strtoupper($titulo, $encoding);
    $this->db->where('UCASE(titulo)', $titulo);
    $result = $this->db->get();

    if($result->num_rows() > 0){
      return $result->result_array();
    }else{
      return array();
    }
  }

   public function num_rowsTopis($titulo = ''){
    $this->db->from('questoes');
    if($titulo != ''){
      $encoding = mb_internal_encoding(); 
      $title = mb_strtoupper($titulo, $encoding);
      $this->db->where('UCASE(titulo)', $title);
    }
    $query = $this->db->get();
    $rowcount = $query->num_rows();

    return $rowcount;
  }

  public function num_rows($titulo = '', $quest_id = ''){

    $this->db->from('respostas');
    if($titulo != '' and $quest_id != ''){

      $encoding = mb_internal_encoding(); 
      $title = mb_strtoupper($titulo, $encoding);
      $this->db->where('UCASE(titulo)', $title);
      $this->db->where('questoes_id', $quest_id);
    }if($quest_id != ''){
      $this->db->where('questoes_id', $quest_id);
    }
    $query = $this->db->get();
    $rowcount = $query->num_rows();

    return $rowcount;
  }

  public function delete($id){

    $this->db->where('id', $id);

    if($this->db->delete('questoes')){
      return true;
    }else{
      return false;
    }
  }

  public function add($data){

    if($this->db->insert('questoes', $data)){
      return true;
    }else{
      return false;
    }
  }

  public function update($id, $data){

    $this->db->where('id', $id);

    if($this->db->update('questoes', $data)){
      return true;
    }else{
      return false;
    }
  }
}                             