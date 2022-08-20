<?php

require("DBCredentials.php");
/**
 *
 */
class Logins extends DBCredentials
{
  private $myconn = "";
  private $myerr = 0;

  function __construct()
  {
    $this->myconn = new mysqli($this->getHost(),$this->getUser(),$this->getPass(),$this->getDb());

    if (mysqli_connect_errno()) {
		
      $this->myerr = mysqli_connect_errno();
    }

  }


  public function checkLogin($user,$pwd){
    $res = array();
    $res['status'] = 0;
	

    if($this->myerr==0 && !empty($this->myconn)){

      if ($stmt = $this->myconn->prepare("SELECT `privilege`,`otp_status`,`status` FROM `st_login` WHERE `sid`=? AND `spass`=?")) {
          $stmt->bind_param("ss",$user,$pwd);
			
           if($stmt->execute()){
		   
            /* bind result variables */
            $stmt->bind_result($privileges,$otpstats,$stat);
			//echo $privileges;
            while ($stmt->fetch()) {
              $privilege = $privileges;
			  $otpstatus = $otpstats;
			  $status=$stat;
			  
            }

            if(!empty($privilege)){
              $res['status'] = $status;
              $res['user'] = $user;
              $res['priv'] = $privileges;
			  $res['otpstatus'] = $otpstatus;
			  
			 // echo  $res['priv'];
            }

           }
           else{
             $res['status'] = 0;
             $res['error'] = "Data Error";
           }
       }
       else{
         $res['status'] = 0;
         $res['error'] = "Query Error";
       }
    }
    else{
      $res['status'] = 0;
      $res['error'] = "Error";
    }

    return $res;
  }

  function __destruct(){
    if(!empty($this->myconn)){
      $this->myconn->close();
    }
  }

}

 ?>
