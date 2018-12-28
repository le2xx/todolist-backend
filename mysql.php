<?php
	include 'config.php';
	$connect = new MySQLi($HOST, $USER, $PASS, $BASE) or die(mysqli_error());
	
	function getData()
	{
		global $connect;
		return $result = $connect->query("SELECT * FROM todo");
	}
	
	function setData($text, $date)
	{
		global $connect;
		return $result = $connect->query("INSERT INTO todo (text, date) VALUES ('$text', '$date')");

	}
	
	function updateData($id, $text, $date)
	{
		global $connect;
		$result = $connect->query("UPDATE  todo SET text = '$text', date = '$date' WHERE id = '$id'");
		return $result;
	}
	
	function deleteData($id)
	{
		global $connect;
		$result = $connect->query("DELETE FROM todo WHERE id = '$id'");
		return $result;

	}
	
	// $connect->close();
?>
