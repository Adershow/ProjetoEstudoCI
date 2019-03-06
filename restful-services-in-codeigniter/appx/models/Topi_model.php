<?php
class Topi_model extends CI_Model{
  
  function __construct(){
    $this->load->database();
  }

  public function getTopiById($id){

    $query = array();
    $this->db->select('id, nome, categorias_id');
    $this->db->from('topicos');
    $this->db->where('id', $id);
    $topicos = $this->db->get();

    if($topicos->num_rows() == 1){

      $this->db->select('id, titulo, tempo, avaliacao, conteudo');
      $this->db->from('questoes');
      $this->db->where('topicos_id', $id);
      $questoes = $this->db->get();

      if($questoes->num_rows() > 0){
        $query = array_merge($topicos->result_array(), $questoes->result_array());
        return $query;
      }else{
        return $topicos->result_array();
      }
    } 
  }

  public function getTopiByNameCat($name = '', $cat_id = '', $page){

    $pageResult = $page * 10;
    $encoding = mb_internal_encoding(); 
    $nome = mb_strtoupper($name, $encoding);
    $topicos = $this->db->get_where('topicos', array('UCASE(nome)' => $nome, 'categorias_id' => $cat_id), 10, $pageResult);
    return $topicos->result_array();
  }

   public function getTopiByName($name = '', $page){

    $pageResult = $page * 10;
    $encoding = mb_internal_encoding(); 
    $nome = mb_strtoupper($name, $encoding);
    $topicos = $this->db->get_where('topicos', array('UCASE(nome)' => $nome), 10, $pageResult);
    return $topicos->result_array();
  }

   public function getTopiByCatName($cat_id, $page){

    $pageResult = $page * 10;
    $encoding = mb_internal_encoding(); 
    $topicos = $this->db->get_where('topicos', array('categorias_id' => $cat_id), 10, $pageResult);
    return $topicos->result_array();
  }

  public function getallTopis($page){

    $pageResult = $page * 10;
    $this->db->limit(10, $pageResult)->get_compiled_select('topicos', FALSE);
    $query = $this->db->select('id, nome')->get_compiled_select();
    $result = $this->db->query($query);

    if($result->num_rows() > 0){
      return $result->result_array();
    }
  }

  public function getallTopisV($name){

    
    $this->db->select('id, nome');
    $this->db->from('topicos');
    $encoding = mb_internal_encoding(); 
    $nome = mb_strtoupper($name, $encoding);
    $this->db->where('UCASE(nome)', $nome);
    $result = $this->db->get();

    if($result->num_rows() > 0){
      return $result->result_array();
    }else{
      return array();
    }
  }

  public function num_rowsTopis($name = ''){
    $this->db->from('topicos');
    if($name != ''){
      $encoding = mb_internal_encoding(); 
      $nome = mb_strtoupper($name, $encoding);
      $this->db->where('UCASE(nome)', $nome);
    }
    $query = $this->db->get();
    $rowcount = $query->num_rows();

    return $rowcount;
  }

  public function num_rows($name = '', $topis_id = ''){

    $this->db->from('questoes');
    if($name != '' and $topis_id != ''){

      $encoding = mb_internal_encoding(); 
      $nome = mb_strtoupper($name, $encoding);
      $this->db->where('UCASE(nome)', $nome);
      $this->db->where('topicos_id', $topis_id);
    }if($topis_id != ''){
      $this->db->where('topicos_id', $topis_id);
    }
    $query = $this->db->get();
    $rowcount = $query->num_rows();

    return $rowcount;
  }

  public function delete($id){

    $this->db->where('id', $id);

    if($this->db->delete('topicos')){
      return true;
    }else{
      return false;
    }
  }

  public function add($data){

    if($this->db->insert('topicos', $data)){
      //$this->db->insert('historico', array('tempo_no_site' => '0', 'usuario_id' => ));
      return true;
    }else{
      return false;
    }
  }

  public function update($id, $data){

    $this->db->where('id', $id);

    if($this->db->update('topicos', $data)){
      return true;
    }else{
      return false;
    }
  }
}                             