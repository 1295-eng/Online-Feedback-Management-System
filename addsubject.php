<?php
@session_start();

if(!empty($_POST['regulation'])&&!empty($_POST['branch'])&&!empty($_POST['course'])&&!empty($_POST['year'])&&!empty($_POST['sem']) && !empty($_POST['sub']))
{
	//$b = 5;
	require_once('cgs.php');
	$add = new CGS;
	$br = explode('_',$_POST['course']);
	$val = $add->addSub($_POST['regulation'],$br[0],$br[1],$_POST['branch'],$_POST['year'],$_POST['sem'],$_POST['sub']);
	
	if($val==0)
	{		
		header('location:subjects.php?msg=anerroroccured');
	}
	else
	{

	header('Location:subjects.php?msg=success');
	}
	
}
else
{
	header('Location:subjects.php');
}


?>