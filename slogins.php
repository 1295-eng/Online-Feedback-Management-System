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

      if ($stmt = $this->myconn->prepare("SELECT `privilege`,`br_code`, `branch`, `fname`, `otp_status` FROM `fac_login` WHERE `fuser`=? and `fpass`=?")) {
          $stmt->bind_param("ss",$user,$pwd);

           if($stmt->execute()){
            /* bind result variables */
            $stmt->bind_result($privileges,$brcode,$brnchs,$fnames, $optstats);
            while ($stmt->fetch()) {
              $privilege = $privileges;
			  $otpstatus=$optstats;
			  $br_code=$brcode;
			  $fname = $fnames;
            }

            if(!empty($privilege)){
              $res['status'] = 1;
              $res['user'] = $user;
			  $res['fname'] = $fname;
              $res['priv'] = $privilege;
			  $res['br_code']=$br_code;
			  $res['branch'] = $brnchs;
			  $res['otpstatus']=$otpstatus;
            }
           //echo $res['otpstatus'];
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
    echo $res;
    return $res;
  }

  function __destruct(){
    if(!empty($this->myconn)){
      $this->myconn->close();
    }
  }

}

 ?>
