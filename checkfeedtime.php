<?php
@session_start();
if(!empty($_SESSION['user']) && !empty($_SESSION['priv']))
{
	date_default_timezone_set("Asia/Kolkata");
	$today = date("Y-m-d\TH:i",time());

}
else {
  header('Location: index.php');
}

function 
?>