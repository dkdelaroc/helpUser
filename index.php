<?php 

	$user = "root";
	$pass = "";
	$host = "localhost";

	$connection = mysqli_connect($host, $user, $pass);

    	$datab = "helpusercasa";
    	$db = mysqli_select_db($connection,$datab);

	$sql = "SELECT documentoPreguntaCasa FROM preguntascasa WHERE idPreguntacasa = 1";
	$result = $connection->query($sql);
	while($row = $result->fetch_assoc()) 
	{
		$doc = $row["documentoPreguntaCasa"];
 	 }

$method = $_SERVER['REQUEST_METHOD'];

if($method == 'POST'){
	$requestBody = file_get_contents('php://input');
	$json = json_decode($requestBody);

	$text = $json->result->parameters->text;

	switch ($text) {
		case 'alta':
			$speech = "Favor de enviar su infomación en la platilla de correo electronico adjunto para su alta en el portal, gracias";
			break;

		case 'bye':
			$speech = "Bye, good night";
			break;

		case 'anything':
			$speech = "Yes, you can type anything here.";
			break;
		
		default:
			$speech = "Sorry, I didnt get that. Please ask me something else.";
			break;
	}

	$response = new \stdClass();
	$response->speech = $speech;
	$response->displayText = $speech;
	$response->source = "webhook";
	echo json_encode($response);
}
else
{
	echo "Method not allowed";
}

?>
