<?php
if(!empty($_POST['cname'])&&!empty($_POST['crcode'])&&!empty($_POST['reg'])&&!empty($_POST['year'])&&!empty($_POST['sem']))
{
	$b = 5;
	require('cgs.php');
	$add = new CGS;
	$val = $add->addCourse($_POST['cname'],$_POST['crcode'],$_POST['reg'],$_POST['year'],$_POST['sem']);
	echo $val;
	if($val==0)
	{
		
		header('location:addcourse.php?msg=anerroroccured');
	}
	else
{
	header('Location:addcourse.php?msg=success');
}
	
}
else
{
	header('Location:addcourse.php');
}


?>