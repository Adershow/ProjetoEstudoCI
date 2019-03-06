<?php
require APPPATH.'/models/Generic_model.php';
class Users_model extends Generic_model {

	public function __construct(){
		parent::__construct();
	}

	public function GET_allUsers($page){

		
		$result = file_get_contents('http://localhost/Projeto/restful-services-in-codeigniter/UserAPI/users?page='.$page, false);

		return json_decode($result, true);
	}

	public function GET_userById($id){

		$result = file_get_contents('http://localhost/Projeto/restful-services-in-codeigniter/UserAPI/userById?id='.$id, false);

		return json_decode($result, true);
	}

	public function getEmail($email){

		$result = file_get_contents('http://localhost/Projeto/restful-services-in-codeigniter/UserAPI/verificaUsers?email='.$email, false);

		return json_decode($result, true);
	}
}