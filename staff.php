<?php
@session_start();

if(!empty($_POST['sname']) && !empty($_POST['spwd']) ){

  $act_user = $_POST['sname'];
  $act_pwd = $_POST['spwd'];
  /* */

  require_once("slogins.php");

  $login = new Logins();
  $res = $login->checkLogin($act_user,$act_pwd);
  
//!empty($res['status']) && $res['status']==1 && !empty($res['priv'])	
  if($res['otpstatus']==1 && $res['status']==1 ){
  //if($res['otpstatus']==1 ){
    $_SESSION['user'] = $res['fname']; //$act_user;
    $_SESSION['priv'] = $res['priv'];
	if($res['priv']=="admin"){
		$_SESSION['priv'] = "hod";
	}
	$_SESSION['br_code']=  $res['br_code'];
	$_SESSION['branch']=  $res['branch'];
	//echo $_SESSION['priv'];
	$_SESSION['br'] = $res['br_code'];
	if($res['priv']=='hod' || $res['priv']=='admin')
	{
		 $_SESSION['fac_sub'] = array(); 
    header('Location: admin.php');
	}
	else {
	header('Location: staff1.php');
	}
	
  }
   else if($res['otpstatus']==0 && $res['status']==1){
    $_SESSION['user'] = $res['fname']; //$act_user;
    $_SESSION['priv'] = $res['priv'];
	$_SESSION['br_code']=  $res['br_code'];
	$_SESSION['branch']=  $res['branch'];
	//$_SESSION['count'] = $res['count'];
	
    header('Location: chngpwd.php');
  }
  //}
  
  else{
  	/*echo "<script>";
	echo " alert('Import has successfully Done.');      
        window.location.href='".site_url('home')."';
      </script>";*/
  	header('Location: loginerror.php');
  }

}

else{
  
  header('Location: ./');
}



?>
