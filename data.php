
<?php
$a=(int)substr($_SESSION['user'],0,2);
if($a%2!=0)
{
$reg=$a;
}
else
{
$reg=$a-1;
}
//$cr=substr($_SESSION['user'],5,1);
//$br=substr($_SESSION['user'],6,2);
$b=(int)date("y");

$ab =$b-$a;
if($ab==1)
{
	$yr="I";
	}
	else if($ab==2)
	{
		$yr="II";
	}
	else if($ab==3)
	{
		$yr="III";
	}
	else{
		$yr="IV";
	}
$mt=(int)date("m");

//echo $mt.$sem;
$reg = $_SESSION['reg'];
$yr = $_SESSION['yr'];
$sem = $_SESSION['sem'];
$br=$_SESSION['br'];
$cr=$_SESSION['cr'];
?>