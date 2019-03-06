<?php
class Cat_model extends CI_Model{
	
	function __construct(){
		$this->load->database();
	}

	public function getCatById($id){

		$query = array();
		$this->db->select('id, nome');
		$this->db->from('categorias');
		$this->db->where('id', $id);
		$categoria = $this->db->get();

		if($categoria->num_rows() == 1){

			$this->db->select('id, nome');
			$this->db->from('topicos');
			$this->db->where('categorias_id', $id);
			$topico = $this->db->get();

			if($topico->num_rows() > 0){
				$query = array_merge($categoria->result_array(), $topico->result_array());
				return $query;
			}else{
				return $categoria->result_array();
			}
		} 
	}

	public function getCatByName($name = '', $page){

		$pageResult = $page * 10;
		$encoding = mb_internal_encoding(); 
		$nome = mb_strtoupper($name, $encoding);
		$categoria = $this->db->get_where('categorias', array('UCASE(nome)' => $nome), 10, $pageResult);
		return $categoria->result_array();
	}

	public function getallCats($page){

		$pageResult = $page * 10;
		$this->db->limit(10, $pageResult)->get_compiled_select('categorias', FALSE);
		$query = $this->db->select('id, nome')->get_compiled_select();
		$result = $this->db->query($query);

		if($result->num_rows() > 0){
			return $result->result_array();
		}
	}

	public function getallCatsV($name){

		
		$this->db->select('id, nome');
		$this->db->from('categorias');
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

	public function num_rowsCat($name = ''){
		$this->db->from('categorias');
		if($name != ''){
			$encoding = mb_internal_encoding(); 
			$nome = mb_strtoupper($name, $encoding);
			$this->db->where('UCASE(nome)', $nome);
		}
		$query = $this->db->get();
		$rowcount = $query->num_rows();

		return $rowcount;
	}

	public function num_rows($name = '', $cat_id = ''){

		$this->db->from('topicos');
		if($name != '' and $cat_id != ''){

			$encoding = mb_internal_encoding(); 
			$nome = mb_strtoupper($name, $encoding);
			$this->db->where('UCASE(nome)', $nome);
			$this->db->where('categorias_id', $cat_id);
		}if($cat_id != ''){
			$this->db->where('categorias_id', $cat_id);
		}
		$query = $this->db->get();
		$rowcount = $query->num_rows();

		return $rowcount;
	}

	public function delete($id){

		$this->db->where('id', $id);

		if($this->db->delete('categorias')){
			return true;
		}else{
			return false;
		}
	}

	public function add($data){

		if($this->db->insert('categorias', $data)){
			//$this->db->insert('historico', array('tempo_no_site' => '0', 'usuario_id' => ));
			return true;
		}else{
			return false;
		}
	}

	public function update($id, $data){

		$this->db->where('id', $id);

		if($this->db->update('categorias', $data)){
			return true;
		}else{
			return false;
		}
	}
}															