<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Questoes extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model('questoes_model');
		$this->load->model('topicos_model');
		$this->load->model('generic_model');
		session_start();
	}

	public function listar(){
		$_SESSION['deleteQuest'] = '';
		if($_SESSION['logado']){

			$page = '0';
			$result = $this->questoes_model->GET_allQuests($page, '');
			$topicos = $this->topicos_model->GET_allTopis($page, '');

			$data['Questoes'] = $result;
			$data['Topicos'] = $topicos;
			$this->load->view('templates/header');
			$this->load->view('questoes/index', $data);
			$this->load->view('templates/footer');
		}else{
			header("location:".base_url().'logar');
		}
	}

	public function search(){

		if($_SESSION['logado']){
			$page = '0';
			$name = $this->input->post('titulo');

			$result = $this->generic_model->POST(array('titulo' => $name, 'page' => $page), 'QuestAPI', 'questBytitulo');

			if(empty($result)){
				$result = $this->questoes_model->GET_allTopis($page, '');
			}

			$topicos = $this->topicos_model->GET_allTopis($page, '');

			$data['Questoes'] = $result;
			$data['Topicos'] = $topicos;
			$this->load->view('templates/header');
			$this->load->view('questoes/index', $data);
			$this->load->view('templates/footer');

			
		}else{
			header("location:".base_url().'logar');
		}
	}

	public function delete(){
		$id = $this->input->get('id');

		$result = $this->questoes_model->getRows('', $id);
		if($result > 0){
			$_SESSION['deleteQuest'] = 'Não foi possível deletar, pois existem dependências';
			$this->search();
		}else{
			$this->generic_model->Delete($id, 'QuestAPI', 'delete');
			$this->listar();
		}
	}

	public function add(){
		
	}

	
}