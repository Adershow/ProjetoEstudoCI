<?php
class Questoes_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function GET_allQuests($page, $topi_id){

		
		$result = file_get_contents('http://localhost/Projeto/restful-services-in-codeigniter/QuestAPI/quests?page='.$page.'&cat_id='.$topi_id, false);

		return json_decode($result, true);
	}

	public function GET_questById($id){

		$result = file_get_contents('http://localhost/Projeto/restful-services-in-codeigniter/QuestAPI/questById?id='.$id, false);

		return json_decode($result, true);
	}

	public function getRows($name = '', $quest_id = ''){

		$result = file_get_contents('http://localhost/Projeto/restful-services-in-codeigniter/QuestAPI/rowCount?name='.$name.'&quest_id='.$quest_id, false);

		return json_decode($result, true);
	}
}