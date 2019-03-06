<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Categorias extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model('categorias_model');
		$this->load->model('generic_model');
		session_start();
	}

	public function listar(){
		if($_SESSION['logado']){
			$_SESSION['delete'] = '';
			$_SESSION['deleteTopi'] = '';

			$page = '0';
			$result = $this->categorias_model->GET_allCats($page);

			$data['Categorias'] = $result;
			$this->load->view('templates/header');
			$this->load->view('categorias/index', $data);
			$this->load->view('templates/footer');
		}else{
			header("location:".base_url().'logar');
		}
	}

	public function verificaNome($name){
		$result = $this->generic_model->POST(array('name' => $name), 'CatAPI', 'verificaCat');

		if(empty($result)){
			return false;
		}else{
			return true;
		}
	}

	public function add(){

		$this->form_validation->set_rules('nome', 'Email', 'required');

		$name = $this->input->post('nome');

		if($this->verificaNome($name) == false){
			$this->generic_model->POST(array('name' => $name), 'CatAPI', 'add');
		}
		$this->listar();
	}

	public function search(){
		

		if($_SESSION['logado']){
			$page = '0';
			$name = $this->input->post('nome');

			$result = $this->generic_model->POST(array('name' => $name, 'page' => $page), 'CatAPI', 'catByName');

			if(empty($result)){
				$result = $this->categorias_model->GET_allCats($page);
			}

			$data['Categorias'] = $result;
			$this->load->view('templates/header');
			$this->load->view('categorias/index', $data);
			$this->load->view('templates/footer');

		}else{
			header("location:".base_url().'logar');
		}
	}

	public function delete(){

		$id = $this->input->get('id');

		$result = $this->categorias_model->getRows('', $id);
		if($result > 0){
			$_SESSION['delete'] = 'Não foi possível deletar, pois existem dependências';
			$this->search();
		}else{
			$this->generic_model->Delete($id, 'CatAPI', 'delete');
			$this->listar();
		}
	}

	public function categoriaInt(){

		if($_SESSION['logado']){
			$id = $this->input->get('id');

			$result = $this->categorias_model->GET_catById($id);
			$arrayCat = array_slice($result, 0, 1);
			$arrayTopi = array_slice($result, 1);
			$data['Categoria'] = $arrayCat;
			$data['Topicos'] = $arrayTopi;
			
			$this->load->view('templates/header');
			$this->load->view('categorias/categoriaInt', $data);
			$this->load->view('templates/footer');
		}else{
			header("location:".base_url().'logar');
		}
	}

	public function update(){

		$id = $this->input->post('id');
		$name = $this->input->post('nome');
		$this->generic_model->PUT(array('id'=>$id, 'name'=>$name, 'categorias_id' => $cat_id), 'CatAPI', 'updateCat');
		$this->categoriaInt();

	}
}