<?php
function getDB(){
	global $db;
	if(!isset($db)){
		//DO NOT COMMIT PRIVATE CREDENTIALS TO A REPOSITORY EVER
		require(__DIR__."/config.php");
		$conn_string = "mysql:host=$dbhost;dbname=$dbdatabase;charset=utf8mb4";
		$db = new PDO($conn_string, $dbusername, $dbpassword);
	}
	return $db;
}
?>
