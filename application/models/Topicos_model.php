<?php
class Topicos_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function GET_allTopis($page, $cat_id){

		
		$result = file_get_contents('http://localhost/Projeto/restful-services-in-codeigniter/TopiAPI/topis?page='.$page.'&cat_id='.$cat_id, false);

		return json_decode($result, true);
	}

	public function GET_topiById($id){

		$result = file_get_contents('http://localhost/Projeto/restful-services-in-codeigniter/TopiAPI/topiById?id='.$id, false);

		return json_decode($result, true);
	}

	public function getRows($name = '', $topis_id = ''){

		$result = file_get_contents('http://localhost/Projeto/restful-services-in-codeigniter/TopiAPI/rowCount?name='.$name.'&topis_id='.$topis_id, false);

		return json_decode($result, true);
	}
}