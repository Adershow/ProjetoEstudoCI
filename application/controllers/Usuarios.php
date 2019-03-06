<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Usuarios extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model('users_model');
	}

	public function listar(){
		session_start();

		if($_SESSION['logado']){

			$page = '0';
			$result = $this->users_model->GET_allUsers($page);

			$data['Usuarios'] = $result;
			$this->load->view('templates/header');
			$this->load->view('usuarios/index', $data);
			$this->load->view('templates/footer');
		}else{
			header("location:".base_url().'logar');
		}
		
	}

	public function verificaEmail($email){
		$result = $this->users_model->getEmail($email);

		if(empty($result)){
			return false;
		}else{
			return true;
		}
	}

	public function add(){

		$this->form_validation->set_rules('nome', 'Email', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('senha', 'Senha', 'required');

		$name = $this->input->post('nome');
		$email = $this->input->post('email');
		$senha = md5($this->input->post('senha'));

		if($this->verificaEmail($email) == false){
			$this->users_model->POST(array('name' => $name, 'email' => $email, 'senha' => $senha, 'adm' => '1'), 'UserAPI', 'add');
		}
		$this->listar();
	}

	public function search(){
		session_start();

		if($_SESSION['logado']){
			$page = '0';
			$name = $this->input->post('nome');

			$result = $this->users_model->POST(array('name' => $name, 'page' => $page), 'UserAPI', 'userByName');

			if(empty($result)){
				$result = $this->users_model->GET_allUsers($page);
			}

			print_r($result);

			$data['Usuarios'] = $result;
			$this->load->view('templates/header');
			$this->load->view('usuarios/index', $data);
			$this->load->view('templates/footer');

			
		}else{
			header("location:".base_url().'logar');
		}
	}

	public function delete(){

		$id = $this->input->get('id');
		$this->users_model->Delete($id, 'UserAPI', 'delete');
		$this->listar();
	}

	public function usuarioInt(){
		session_start();

		if($_SESSION['logado']){
			$id = $this->input->get('id');

			$result = $this->users_model->GET_userById($id);
			$arrayUser = array_slice($result, 0, 1);
			$arrayHist = array_slice($result, 1);
			$data['Usuario'] = $arrayUser;
			$data['Historico'] = $arrayHist;
			
			$this->load->view('templates/header');
			$this->load->view('usuarios/usuarioInt', $data);
			$this->load->view('templates/footer');
		}else{
			header("location:".base_url().'logar');
		}
	}

	public function update(){

		$id = $this->input->post('id');
		$name = $this->input->post('nome');
		$email = $this->input->post('email');
		$senha = $this->input->post('senha');
		if($this->input->post('adm') != 1){
			$this->users_model->PUT(array('id'=>$id, 'email'=>$email, 'name'=>$name, 'adm'=>'0', 'senha'=>$senha), 'UserAPI', 'updateUser');
		}else{
			$this->users_model->PUT(array('id'=>$id, 'email'=>$email, 'name'=>$name, 'adm'=>'1', 'senha'=>$senha), 'UserAPI', 'updateUser');
		}
		$this->listar();

	}
}
