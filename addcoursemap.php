<?php
@session_start();

if(!empty($_POST['regulation'])&&!empty($_POST['branch'])&&!empty($_POST['course'])&&!empty($_POST['year'])&&!empty($_POST['sem']) && !empty($_POST['sub'])                        &&!empty($_POST['fnamem']))
{
	//$b = 5;
	require_once('cgs.php');
	$add = new CGS;
	$val = $add->addFacMap($_POST['regulation'],$_POST['branch'],$_POST['course'],$_POST['year'],$_POST['sem'],$_POST['sub'],$_POST['fnamem']);
	
	if($val==0)
	{
		
		header('location:fac_course.php?msg=anerroroccured');
	}
	else
{
	array_push($_SESSION['fac_sub'],$_POST['sub']);

	header('Location:fac_course.php?msg=success');
}
	
}
else
{
	header('Location:fac_course.php');
}


?>