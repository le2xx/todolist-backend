<?php
include 'mysql.php';
include 'api-status.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Version, Authorization, Content-Type");

	switch ($_SERVER['REQUEST_METHOD']) {
		case 'GET':
			getApi();
			break;
		case 'POST':
			$postData = json_decode(file_get_contents('php://input'), true);
			if ($postData["text"] !== '' || $postData["date"] !== '') { 
				setApi($postData["text"], $postData["date"]);
			}
			break;
		case 'PUT':
			$putData = json_decode(file_get_contents('php://input'), true);
			if ($putData["id"] !== '' || $putData["text"] !== '' || $putData["date"] !== '') { 
				updateApi($putData["id"], $putData["text"], $putData["date"]);
			}
			break;
		case 'DELETE':
			if($_GET["id"]) {
				deleteApi($_GET["id"]);
			}
			break;
		default:
		   apiStatus(1);
	}
	
	function getApi()
	{
		$result = getData();
		$json_result = '';
		
		for ($i =  0; $i < $result->num_rows; $i++) {
			$row = $result->fetch_array(MYSQLI_ASSOC);
			$row_json = json_encode($row, JSON_UNESCAPED_UNICODE);
		
			if ($i == $result->num_rows - 1) {
				$json_result = $json_result . $row_json;
			} else {
				$json_result = $json_result . $row_json . ",\r\n";
			}
		}
		
		echo "{" . "\"todo\":" . "[" . $json_result . "]" . "}";
	}
	
	function setApi($text, $date)
	{
		$result = setData($text, $date);
		if (!$result) {
			apiStatus(2);
			return;
		}
		apiStatus(5);
	}
	
	function updateApi($id, $text, $date)
	{
		$result = updateData($id, $text, $date);
		if (!$result) {
			apiStatus(3);
			return;
		}
		apiStatus(5);
	}
	
	function deleteApi($id)
	{
		$result = deleteData($id);
		if (!$result) {
			apiStatus(4);
			return;
		}
		apiStatus(5);
	}
	
	$connect->close();
?>
