<?php
@session_start();

if(!empty($_POST['sid']) && !empty($_POST['pwd'])){

  $act_user = strtoupper($_POST['sid']);
  $act_pwd = strtoupper($_POST['pwd']);
  
	$_SESSION['user'] = $act_user;
  //require_once("logins.php");
 	require_once('cgs.php');
  	$login = new CGS;
  	$res = $login->checkLogin($act_user,$act_pwd);

	if(!empty($res['reg'])){
		
		$obj1=new CGS;
		$_SESSION['reg'] = $res['reg'];
		$cr = $res['cr_code'];
		$br = $res['br_code'];
		$_SESSION['br'] = $br;
		$_SESSION['cr'] = $cr;
		$_SESSION['yr'] = $res['yr'];
		$_SESSION['sem'] = $res['sem'];
		
		$res1=$obj1->getActivation($_SESSION['reg'],$_SESSION['cr'],$_SESSION['br'],$_SESSION['yr'],$_SESSION['sem']);
		
	  // $obj2=new CGS;
			
		//!empty($res['status']) && !empty($res['otpstatus']) && $res['otpstatus']==1 && $res['status']==1 && !empty($res['priv'])
		/*if($res['status']==0)
		 {
		 header('Location:form1.php');
		 
		 }
		 else{*/

		date_default_timezone_set("Asia/Kolkata");
		$today = date("Y-m-d\TH:i",time());
		//alert($today);
		 //echo $res['feedbackstatus'];
		 //alert($res1['fd']);

		 if(empty($res1['status']) || $res1['status']==0){
			echo '<script type="text/javascript">alert("Feedback is NOT active for your class..!"); document.location.href = "index.php";</script>';
		 }
		 elseif($res1['status']==1){
			require_once('data.php');

				$_SESSION['user'] = $act_user;
				$_SESSION['priv'] = $res['priv'];
				$_SESSION['yes_sub'] = array();
				$res2=$obj1->getFeedsSubmitted($_SESSION['user'],$res1['feed_id']);
				if(!empty($res2['subjects']) && count($res2['subjects'])>0){
					$_SESSION['yes_sub'] = $res2['subjects'];
				}
				$_SESSION['count'] = 0;				
				if(!empty($res1['fd']) && !empty($res1['td']) && $today>=$res1['fd'] && $today<=$res1['td']){
					  if($res['otpstatus']=='1' && $res['status']=='1'){

						
header('Location: form.php');
					  }else if($res['otpstatus']=='0' && $res['status']=='1'){
						header('Location: chngpwd.php?id=initial');
					  }else{
						session_unset();
						echo '<script type="text/javascript">alert("Student Status Invalidated..!"); document.location.href = "index.php";</script>';
					  }  
				}else{
					session_unset();
					if(!empty($res1['fd']) && $today<=$res1['fd']){
						echo '<script type="text/javascript">alert("Feedback NOT Started..!"); document.location.href = "index.php";</script>';
					}
					else if(!empty($res1['td']) && $today>=$res1['td']){
						echo '<script type="text/javascript">alert("Feedback Time Expired..!"); document.location.href = "index.php";</script>';
					}
					else{
						header('Location: ./');
					}
				}

		 }
		 else{  	
			session_unset();
			header('Location: ./'); /*unexpected behavior*/
		 }
	}
	else{
		echo '<script type="text/javascript">alert("Invalid Username or Password..!"); document.location.href = "index.php";</script>';
	}

}
else{
  header('Location: ./');
}

?>