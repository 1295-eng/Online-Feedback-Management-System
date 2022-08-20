<?php
	require_once('cgs.php');
	
	$obj= new CGS();
	
	if(!empty($_POST['regulation'])&&!empty($_POST['branch'])&&!empty($_POST['course'])&&!empty($_POST['year'])&&!empty($_POST['sem'])){
		
		$res = $obj->getList1($_POST['regulation'],$_POST['course'],$_POST['branch'],$_POST['year'],$_POST['sem']);
		
		echo $res;
	}
?>