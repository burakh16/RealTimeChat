<?php

session_start();
$host = "localhost";  
$username = "root";  
$password = "";  
$database = "chat";   
try  
{  
	$connect = new PDO("mysql:host=$host; dbname=$database", $username, $password);  
}catch(PDOException $e){
	echo $e->getMessage();
}

?>
