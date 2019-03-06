<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH.'/controllers/Categorias.php';
class Topicos extends Categorias{
	
	function __construct(){
		parent::__construct();
		$this->load->model('topicos_model');
	}

	public function search(){
		if($_SESSION['logado']){
			$page = '0';
			$name = $this->input->post('nome');
			$cat_id = $this->input->post('cat_id');

			$result = $this->generic_model->POST(array('name' => $name, 'page' => $page, 'cat_id' => $cat_id), 'TopiAPI', 'topiByName');
			$resultado = $this->categorias_model->GET_catById($cat_id);
			$arrayCat = array_slice($resultado, 0, 1);
			$data['Categoria'] = $arrayCat;

			if(empty($result)){
				$result = $this->topicos_model->GET_allTopis($page, $cat_id);
			}

			$data['Topicos'] = $result;
			$this->load->view('templates/header');
			$this->load->view('categorias/categoriaInt', $data);
			$this->load->view('templates/footer');
		}else{
			header("location:".base_url().'logar');
		}
	}

	public function verificaNome($name){
		$result = $this->generic_model->POST(array('name' => $name), 'TopiAPI', 'verificaTopi');

		if(empty($result)){
			return false;
		}else{
			return true;
		}
	}

	public function add(){
		if($_SESSION['logado']){

			$name = $this->input->post('nomeAdd');
			$cat_id = $this->input->post('cat_id');

			if($this->verificaNome($name) == false){
				$this->generic_model->POST(array('name' => $name, 'cat_id' => $cat_id), 'TopiAPI', 'add');
			}
		}else{
			header("location:".base_url().'logar');
		}

		$this->search();
	}

	public function delete(){

		$id = $this->input->get('idTopi');

		$result = $this->topicos_model->getRows('', $id);
		if($result > 0){
			$_SESSION['deleteTopi'] = 'Não foi possível deletar, pois existem dependências';
			$this->categoriaInt();
		}else{
			$this->generic_model->Delete($id, 'TopiAPI', 'delete');
			$this->categoriaInt();
		}
	}

	public function topicoInt(){

		if($_SESSION['logado']){
			$id = $this->input->get('id');

			$result = $this->topicos_model->GET_topiById($id);
			$arrayTopi = array_slice($result, 0, 1);
			$arrayQuest = array_slice($result, 1);
			$data['Topicos'] = $arrayTopi;
			$data['Questoes'] = $arrayQuest;
			
			$this->load->view('templates/header');
			$this->load->view('categorias/topicosInt', $data);
			$this->load->view('templates/footer');
		}else{
			header("location:".base_url().'logar');
		}
	}

	public function update(){

		$id = $this->input->post('id');
		$name = $this->input->post('nome');
		$cat_id = $this->input->post('cat_id');
		$this->generic_model->PUT(array('id'=>$id, 'name'=>$name, 'cat_id' => $cat_id), 'TopiAPI', 'updateTopi');
		$this->search();

	}
}