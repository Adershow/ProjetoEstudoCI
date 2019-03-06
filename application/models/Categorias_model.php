<?php
class Categorias_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function GET_allCats($page){

		
		$result = file_get_contents('http://localhost/Projeto/restful-services-in-codeigniter/CatAPI/cats?page='.$page, false);

		return json_decode($result, true);
	}

	public function GET_catById($id){

		$result = file_get_contents('http://localhost/Projeto/restful-services-in-codeigniter/CatAPI/catById?id='.$id, false);

		return json_decode($result, true);
	}

	public function  getRows($name = '', $cat_id = ''){

		$result = file_get_contents('http://localhost/Projeto/restful-services-in-codeigniter/CatAPI/rowCount?name='.$name.'&cat_id='.$cat_id, false);

		return json_decode($result, true);
	}
}