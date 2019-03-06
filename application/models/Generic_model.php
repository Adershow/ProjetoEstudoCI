<?php
class Generic_model extends CI_Model {

	public function __construct(){
        parent::__construct();
    }
    
	public function POST($data = array(), $controller, $metodo){

		$postdata = http_build_query(
			$data
		);

		$opts = array('http' =>
			array(
				'method'  => 'POST',
				'header'  => 'Content-type: application/x-www-form-urlencoded',
				'content' => $postdata
			)
		);

		$context  = stream_context_create($opts);

		$result = file_get_contents('http://localhost/Projeto/restful-services-in-codeigniter/'.$controller.'/'.$metodo, false, $context);

		return json_decode($result, true);
	}

	public function Delete($id, $controller, $metodo){

		$postdata = http_build_query(
			array(
				'id' => "$id",
			)
		);

		$opts = array('http' =>
			array(
				'method'  => 'DELETE',
				'header'  => 'Content-type: application/x-www-form-urlencoded',
				'content' => $postdata
			)
		);

		$context  = stream_context_create($opts);

		$result = file_get_contents('http://localhost/Projeto/restful-services-in-codeigniter/'.$controller.'/'.$metodo, false, $context);
	}

	public function PUT($data = array(), $controller, $metodo){

		$postdata = http_build_query(
			$data
		);

		$opts = array('http' =>
			array(
				'method'  => 'PUT',
				'header'  => 'Content-type: application/x-www-form-urlencoded',
				'content' => $postdata
			)
		);

		$context  = stream_context_create($opts);

		$result = file_get_contents('http://localhost/Projeto/restful-services-in-codeigniter/'.$controller.'/'.$metodo, false, $context);
	}
}