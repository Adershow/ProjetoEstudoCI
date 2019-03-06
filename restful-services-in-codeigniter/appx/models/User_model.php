<?php
class User_model extends CI_Model{
	
	function __construct(){
		$this->load->database();
	}

	public function getUserById($id){

		$query = array();
		$this->db->select('id, nome, email, adm');
		$this->db->from('usuario');
		$this->db->where('id', $id);
		$usuario = $this->db->get();

		if($usuario->num_rows() == 1){

			$this->db->select('id, QRC, QRE, QRT, tempo_no_site');
			$this->db->from('historico');
			$this->db->where('usuario_id', $id);
			$historico = $this->db->get();

			if($historico->num_rows() == 1){
				$query = array_merge($usuario->result_array(), $historico->result_array());
				return $query;
			}else{

				$data = array("usuario_id " => $id);
				$this->db->insert('historico', $data);
				$this->db->select('id, QRC, QRE, QRT, tempo_no_site');
				$this->db->from('historico');
				$this->db->where('usuario_id', $id);
				$historico = $this->db->get();
				$query = array_merge($usuario->result_array(), $historico->result_array());
				return $query;
			}
		} 
	}

	public function getUserByName($name = '', $page){

		$pageResult = $page * 10;
		$encoding = mb_internal_encoding(); 
		$nome = mb_strtoupper($name, $encoding);
		$usuario = $this->db->get_where('usuario', array('UCASE(nome)' => $nome), 10, $pageResult);
		return $usuario->result_array();
	}

	public function getUserByEmail($email, $senha){

		$this->db->select('id, nome, email, senha, adm');
		$this->db->from('usuario');
		$this->db->where('email', $email);
		$this->db->where('senha', $senha);
		$usuario = $this->db->get();

		if($usuario->num_rows() == 1){
			return $usuario->result_array();
		}
	}

	public function getallUsers($page){

		$pageResult = $page * 10;
		$this->db->limit(10, $pageResult)->get_compiled_select('usuario', FALSE);
		$query = $this->db->select('id, nome, email, adm')->get_compiled_select();
		$result = $this->db->query($query);

		if($result->num_rows() > 0){
			return $result->result_array();
		}
	}

	public function getallUsersV($email){

		
		$this->db->select('id, nome, email, adm');
		$this->db->from('usuario');
		$this->db->where('email', $email);
		$result = $this->db->get();

		if($result->num_rows() > 0){
			return $result->result_array();
		}else{
			return array();
		}
	}

	public function num_rows($name = ''){

		$this->db->from('usuario');
		if($name != ''){

			$encoding = mb_internal_encoding(); 
			$nome = mb_strtoupper($name, $encoding);
			$this->db->where('UCASE(nome)', $nome);
		}
		$query = $this->db->get();
		$rowcount = $query->num_rows();

		return $rowcount;
	}

	public function delete($id){

		$this->db->where('usuario_id', $id);

		if($this->db->delete('historico')){
			$this->db->where('id', $id);
			$this->db->delete('usuario');
			return true;
		}else{
			return false;
		}
	}

	public function add($data){

		if($this->db->insert('usuario', $data)){
			//$this->db->insert('historico', array('tempo_no_site' => '0', 'usuario_id' => ));
			return true;
		}else{
			return false;
		}
	}

	public function update($id, $data){

		$this->db->where('id', $id);

		if($this->db->update('usuario', $data)){
			return true;
		}else{
			return false;
		}
	}
}															