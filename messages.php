<?php 
include('connect.php');
@session_start();
switch($_GET['action']){
	
	case "sendMessage":
	
	$query = $connect->prepare("INSERT INTO messages SET user=?, message=?");
	$run = $query->execute([$_SESSION['username'], $_REQUEST['message']]);
	
	if ($run) {
		echo 1;
		exit;	
	}

	break;
	case "getMessages":
	
	$query = $connect->prepare("select * from messages order by id asc");
	
	$run = $query->execute([$_SESSION['username']]);

	$rs = $query->fetchAll(PDO::FETCH_OBJ);
	$chat ='';
	foreach ($rs as $message) {
		
		if ($_SESSION['username'] == $message->user) {
			$chat .='<div class="box" ><div class="alert alert-success" style="width: 250px;min-height:100px;word-wrap:break-word;float:right;"><strong>'.strtoupper($message->user).' : </strong>'.$message->message.'<span></span></div></div>';
		}
		else
		{
			$chat .='<div class="box" ><div class="alert alert-primary" style="width: 250px;min-height:100px;word-wrap:break-word;"><strong>'.strtoupper($message->user).' : </strong>'.$message->message.'</div></div>';
		}
	}
	
	echo $chat;
	
	break;
	
	
}

?>
