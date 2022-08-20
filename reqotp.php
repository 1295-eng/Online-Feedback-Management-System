<?php
if(!empty($_POST['uid']) && !empty($_POST['email']))
{
	$uid = $_POST['uid'];
	$email = $_POST['email'];
	$otp = rand(10000,getrandmax());
	require('cgs.php');
	$cgs_obj = new CGS;
	$stat=0;
	$insres = $cgs_obj->insertOtp($uid,$otp,$stat);
	
	if($insres)
	{
	
$subject = "OTP for JNTUA CEA Student Feedback";
$txt = "Your one time password is ".$otp;
$headers = "From:SDC, JNTUA CEA " . "\r\n" .
mail($email,$subject,$txt,$headers);
		header('Location: index.php');
	}
	else
	{
	echo "Error in sending OTP";
		/*$prev = "student";
		$status = 1;
		$cgs_obj1 = new CGS;
		$insre = $cgs_obj1->insertD($uid,$email,$otp,$prev,$status);
		if($insre)
		{
			header('Location: index.php');
		}*/
	}


}

?>