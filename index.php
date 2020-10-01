<?php
	$user = "root";
	$pass = "";
	$host = "localhost";

	$connection = mysqli_connect($host, $user, $pass);
    	$datab = "helpusercasa";
    	$db = mysqli_select_db($connection,$datab);

	$method = $_SERVER['REQUEST_METHOD'];

	if($method == "POST")
	{
		$requestBody = file_get_contents('php://input');
		$json = json_decode($requestBody);

		$text = $json->result->parameters->text;

		switch ($text) 
		{
			case 'Requisitos para darse de alta en el portal':
					$speech =  "Favor de enviar su infomación en la platilla de correo electronico adjunto para su alta en el portal, gracias"
				break;
			
			default:
				 $speech = "Lo siento no comprendo su solicitud"
				break;
		}

		$response = new \stdClass();
		$response->speech=$speech;
		$response->displayText = $speech;
		$response->source = "webhook";
		echo json_encode($response);
	}
	else
	{
		echo "Method not allowed";
	}
 
?>
