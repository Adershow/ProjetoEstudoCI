<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Logar extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model('users_model');
	}

	public function index(){
		$this->load->view('login');
	}

	public function login(){

		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('senha', 'Senha', 'required');

		if($this->form_validation->run() === false){
			$this->load->view('login');
		}else{
			$result = $this->users_model->POST(array('email' => $this->input->post('email'), 'senha' => md5($this->input->post('senha'))), 'UserAPI', 'logar');
			if(empty($result)){
				$data['permissao'] = 'Senha ou Email incorretos';
				header("location:".base_url().'logar');
			}
			foreach ($result as $key) {
				if($key['adm'] != '1'){
					$data['permissao'] = 'Não tem privilégios de adm';
					$this->load->view('login', $data);
				}else{
					session_start();
					$_SESSION['logado'] = $key['nome'];
					$_SESSION['email'] = $key['email'];
					header("location:".base_url().'home');
				}
			}
			
		}
	}

	public function deslogar(){
		session_start();
		session_destroy();

		header("location:".base_url().'logar');
	}
}