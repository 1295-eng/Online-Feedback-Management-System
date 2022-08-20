<?php
if(!empty($_POST['branch'])&&!empty($_POST['fname'])&&!empty($_POST['br_code'])&&!empty($_POST['fpass'])&&!empty($_POST['privilege'])&&!empty($_POST['email']))
{
	//$b = 5;
	require('cgs.php');
	$add = new CGS;
	$val = $add->addFac($_POST['branch'],$_POST['fname'],$_POST['br_code'],$_POST['fpass'],$_POST['privilege'],$_POST['email']);
	if($val==0)
	{	
		header('location:addfac.php?msg=anerroroccured');
	}
	else
{
	header('Location:addfac.php?msg=success');
}
	
}
else
{
	header('Location:addfac.php');
}


?>