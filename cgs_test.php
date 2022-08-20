
<?php

require("DBCredentials.php");
/**
 *
 */
class CGS extends DBCredentials
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

      if ($stmt = $this->myconn->prepare("SELECT `privilege`,`otp_status`,`status`,`feedback_status` FROM `st_login` WHERE `sid`=? AND `spass`=?")) {
          $stmt->bind_param("ss",$user,$pwd);
			
           if($stmt->execute()){
		   
            /* bind result variables */
            $stmt->bind_result($privileges,$otpstats,$stat,$feeds);
			//echo $privileges;
            while ($stmt->fetch()) {
              $privilege = $privileges;
			  $otpstatus = $otpstats;
			  $status=$stat;
			  $feedstat=$feeds;
			  
            }

            if(!empty($privilege)){
              $res['status'] = $status;
              $res['user'] = $user;
              $res['priv'] = $privileges;
			  $res['otpstatus'] = $otpstatus;
			  $res['feedbackstatus']=$feedstat;
			  
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
  
   public function getFdetails($fname,$sub,$br1,$yr1,$sm,$regu){
    $res = array();
    $res['status'] = 0;

    if($this->myerr==0 && !empty($this->myconn)){
      $query = "SELECT  `qs1`, `qs2`, `qs3`, `qs4`, `qs5`, `qs6`, `qs7`, `qs8`, `qs9`, `qs10`, `qs11`, `qs12`, `qs13`, `qs14`, `count` FROM `ques` WHERE `fid`=? AND `sid`=? AND `br_code`=? AND `year`=? AND `sem`=? AND `regulation`=?";
      if ($stmt = $this->myconn->prepare($query)) {
          $stmt->bind_param("ssssss",$fname,$sub,$br1,$yr1,$sm,$regu);

           if($stmt->execute()){
            /* bind result variables */
            $stmt->bind_result($q1,$q2,$q3,$q4,$q5,$q6,$q7,$q8,$q9,$q10,$q11,$q12,$q13,$q14,$c);
            while ($stmt->fetch()) {
                $res['qs1']=$q1;
				$res['qs2']=$q2;
				$res['qs3']=$q3;
				$res['qs4']=$q4;
				$res['qs5']=$q5;
				$res['qs6']=$q6;
				$res['qs7']=$q7;
				$res['qs8']=$q8;
				$res['qs9']=$q9;
				$res['qs10']=$q10;
				$res['qs11']=$q11;
				$res['qs12']=$q12;
				$res['qs13']=$q13;
				$res['qs14']=$q14;
				$res['count']=$c;
                $res['status']=1;
            }/*while loop close*/
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
  
  
  
  
  
public function getBdetails($br){
if($this->myerr==0 && !empty($this->myconn)){
$query="SELECT `branch` FROM `subjects` WHERE `br_code`=?";
if ($stmt = $this->myconn->prepare($query)) {
          $stmt->bind_param("s",$br);
		 if($stmt->execute()){  
     $stmt->bind_result($bran);
 while ($stmt->fetch()) {
    $branch=$bran;
	}
	}

}
}
return $branch;
  
  }
  
public function getActivation($reg,$br,$yr,$sem){
    $res1 = array();
    $res1['status'] = 0;

    if($this->myerr==0 && !empty($this->myconn)){
      $query = "SELECT `from_date`,`to_date` FROM `activation` WHERE `regulation`=? AND `branch`=? AND `year`=? And `sem`=?";
	 
      if ($stmt = $this->myconn->prepare($query)) {
          $stmt->bind_param("ssss",$reg,$br,$yr,$sem);

           if($stmt->execute()){
            /* bind result variables */
            $stmt->bind_result($fd,$td);
            while ($stmt->fetch()) {
              	$res1['fd']=$fd;
				$res1['td']=$td;
				              
            }/*while loop close*/
           }
		   
           else{
             $res1['status'] = 0;
             $res1['error'] = "Data Error";
           }
       }
       else{
         $res1['status'] = 0;
         $res1['error'] = "Query Error";
       }
    }

    else{
      $res1['status'] = 0;
      $res1['error'] = "Error";
    }


    return $res1;
  }
  
  
  public function selectd($fac,$sub){
    $res = array();
    $res['status'] = 0;


    if($this->myerr==0 && !empty($this->myconn)){
      $query = "SELECT  `qs1`, `qs2`, `qs3`, `qs4`, `qs5`, `qs6`, `qs7`, `qs8`, `qs9`, `qs10`, `qs11`, `qs12`, `qs13`, `qs14`, `avg`, `count` FROM `ques` WHERE `fid`=? AND `sid`=?";
      if ($stmt = $this->myconn->prepare($query)) {
          $stmt->bind_param("ss",$fac,$sub);

           if($stmt->execute()){
            /* bind result variables */
            $stmt->bind_result($q1,$q2,$q3,$q4,$q5,$q6,$q7,$q8,$q9,$q10,$q11,$q12,$q13,$q14,$avg,$c);
            while ($stmt->fetch()) {
                $res['qs1']=$q1;
				$res['qs2']=$q2;
				$res['qs3']=$q3;
				$res['qs4']=$q4;
				$res['qs5']=$q5;
				$res['qs6']=$q6;
				$res['qs7']=$q7;
				$res['qs8']=$q8;
				$res['qs9']=$q9;
				$res['qs10']=$q10;
				$res['qs11']=$q11;
				$res['qs12']=$q12;
				$res['qs13']=$q13;
				$res['qs14']=$q14;
				$res['avg'] = $avg;
				$res['count']=$c;
			   $res['status'] = 1;
              
            }/*while loop close*/
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

  
  public function getF($br){
    $faculty = array();
    if($this->myerr==0 && !empty($this->myconn)){
      if ($stmt = $this->myconn->prepare("SELECT   DISTINCT `fname` FROM `fac_login` WHERE `br_code`=?")) {
		  $stmt->bind_param("s",$br);
           if($stmt->execute()){
            $stmt->bind_result($facs);
            $i = 0;
            while ($stmt->fetch()) {
              $faculty[$i] = $facs;
              $i++;
            }
           }
       }
    }
    return $faculty;
  }
  public function getFaculty($br){
    $res = array();
    if($this->myerr==0 && !empty($this->myconn)){
      if ($stmt = $this->myconn->prepare("SELECT  `fid`,`avg`  FROM `ques` WHERE `br_code`=?")) {
		  $stmt->bind_param("s",$br);
           if($stmt->execute()){
            $stmt->bind_result($facs,$score);
           // $i = 0;
            while ($stmt->fetch()) {
              $res['fid'] = $facs;
			  $res['avg']=$score;
             
            }
           }
       }
    }
    return $res;
  }
    public function getF2($reg,$br,$yr,$sem){
    $faculty = array();
    if($this->myerr==0 && !empty($this->myconn)){
      if ($stmt = $this->myconn->prepare("SELECT  DISTINCT`fname` FROM `fac_course` WHERE `regulation`=? AND `br_code`=? AND `year`=? AND `sem`=?")) {
		  $stmt->bind_param("ssss",$reg,$br,$yr,$sem);
           if($stmt->execute()){
            $stmt->bind_result($facs);
            $i = 0;
            while ($stmt->fetch()) {
              $faculty[$i] = $facs;
              $i++;
            }
           }
       }
    }
    return $faculty;
  }
  public function getSub($reg,$br,$yr,$sem,$fname)
  {
 $subjects=array();
  if($this->myerr==0 && !empty($this->myconn)){
  $query="SELECT `subject` FROM `fac_course` WHERE `regulation`=? AND `br_code`=? AND `year`=? AND `sem`=? `fname`=?";
   if ($stmt = $this->myconn->prepare($query)) {
   $stmt->bind_param("sssss",$reg,$br,$yr,$sem,$fname);
   if($stmt->execute()){
    $stmt->bind_result($subs);
            $i = 0;
            while ($stmt->fetch()) {
              $subjects[$i] = $subs;
              $i++;
			  }
   }
   
   }
   
  
  }
 return $subjects;
 
  }
  
   public function getC($reg){
    $course = array();
    if($this->myerr==0 && !empty($this->myconn)){
      if ($stmt = $this->myconn->prepare("SELECT  `cname` FROM `course` WHERE `regulation`=?")) {
		  $stmt->bind_param("s",$reg);
           if($stmt->execute()){
            $stmt->bind_result($regs);
            $i = 0;
            while ($stmt->fetch()) {
              $course[$i] = $regs;
              $i++;
            }
           }
       }
    }
    return $course;
  }
  public function getReg(){
   $regulation = array();
    if($this->myerr==0 && !empty($this->myconn)){
	if($stmt = $this->myconn->prepare("SELECT DISTINCT `regulation` FROM `course`")){
      if($stmt->execute()){
	   $stmt->bind_result($regs);
	   $i=0;
	   while($stmt->fetch()){
	   $regulation[$i]=$regs;
	   $i++;
	   }
	   }
	   }
   }
   return $regulation;
   }
  public function getReg1(){
   $regulation = array();
    if($this->myerr==0 && !empty($this->myconn)){
	if($stmt = $this->myconn->prepare("SELECT DISTINCT `regulation` FROM `subjects`")){
      if($stmt->execute()){
	   $stmt->bind_result($regs);
	   $i=0;
	   while($stmt->fetch()){
	   $regulation[$i]=$regs;
	   $i++;
	   }
	   }
	   }
   }
   return $regulation;
   }
   
   public function getbr($fac){
    $res = array();
    if($this->myerr==0 && !empty($this->myconn)){
      if ($stmt = $this->myconn->prepare("SELECT  `br_code`, `branch` FROM `fac_login` WHERE `fname`=?")) {
		  $stmt->bind_param("s",$fac);
           if($stmt->execute()){
            $stmt->bind_result($brc,$dpt);
            $i = 0;
            while ($stmt->fetch()) {
              $res['brcode'] = $brc;
			  $res['dprt'] = $dpt;
            }
           }
       }
    }
    return $res;
  }
  //public function get
  
  public function getdep($user){
  //$res=array();
   if($this->myerr==0 && !empty($this->myconn)){
       if($stmt = $this->myconn->prepare("SELECT  `branch` FROM `fac_login` WHERE `fname`=?")){
	    $stmt->bind_param("s",$user);
            if($stmt->execute()){
             $stmt->bind_result($dep);
             // $i = 0; 
             while($stmt->fetch()){
                  $res = $dep;
				 
               }
            }
         } 
     }
  return $res;
  }
  
  
  public function getList($fac){
    $res="<option>--Select--</option>";
    if($this->myerr==0 && !empty($this->myconn)){
      if ($stmt = $this->myconn->prepare("SELECT  DISTINCT `sid` FROM `ques` WHERE `fid`=?")) {
		  $stmt->bind_param("s",$fac);
           if($stmt->execute()){
            $stmt->bind_result($sub);
            $i = 0;
            while ($stmt->fetch()) {
             $res.= "<option value='".$sub ."'>".$sub."</option>";
            }
           }
       }
    }
    return $res;
  }
 public function getList2($reg,$br,$yr,$sem,$fac){
    $res="<option>--Select--</option>";
    if($this->myerr==0 && !empty($this->myconn)){
      if ($stmt = $this->myconn->prepare("SELECT  `subject` FROM `fac_course` WHERE `regulation`=? AND `br_code`=? AND `year`=? AND `sem`=? AND `fname`=?")) {
		  $stmt->bind_param("sssss",$reg,$br,$yr,$sem,$fac);
           if($stmt->execute()){
            $stmt->bind_result($sub);
            $i = 0;
            while ($stmt->fetch()) {
             $res.= "<option value='".$sub ."'>".$sub."</option>";
            }
           }
       }
    }
    return $res;
  }
  
   
  
 public function getList1($reg,$branch,$year,$sem){
    $res="<option>--Select--</option>";
    if($this->myerr==0 && !empty($this->myconn)){
      if ($stmt = $this->myconn->prepare("SELECT  `s1`,`s2`,`s3`,`s4`,`s5`,`s6` FROM `subjects` WHERE `regulation`=? AND `branch`=? AND `year`=? AND `sem`=?")) {
		  $stmt->bind_param("ssss",$reg,$branch,$year,$sem);
		    if($stmt->execute()){
            $stmt->bind_result($sub1,$sub2,$sub3,$sub4,$sub5,$sub6);
            $i = 0;
            while ($stmt->fetch()) {
            $res.= "<option value='".$sub1 ."'>".$sub1."</option>";
            $res.= "<option value='".$sub2 ."'>".$sub2."</option>";
            $res.= "<option value='".$sub3 ."'>".$sub3."</option>";
            $res.= "<option value='".$sub4 ."'>".$sub4."</option>";
            $res.= "<option value='".$sub5 ."'>".$sub5."</option>";
            $res.= "<option value='".$sub6 ."'>".$sub6."</option>";
            }
           }
       }
    }
    return $res;
  }

 public function getF1($branch){
    $res="<option>--select--</option>";
    if($this->myerr==0 && !empty($this->myconn)){
	$query1="SELECT `br_code` FROM `fac_login` WHERE `branch`=?";
   if ($stmt1 = $this->myconn->prepare($query1)) {
	  $stmt1->bind_param("s",$branch);
	  if($stmt1->execute()){
	  $stmt1->bind_result($brc);
	  while($stmt1->fetch()){
	  $brc1=$brc;
	  }
	  }
	  }
	  
      if ($stmt = $this->myconn->prepare("SELECT  DISTINCT `fname` FROM `fac_login` WHERE `br_code`=?")) {
		  $stmt->bind_param("s",$brc1);
           if($stmt->execute()){
            $stmt->bind_result($fac);
            $i = 0;
            while ($stmt->fetch()) {
             $res.= "<option value='".$fac ."'>".$fac."</option>";
            }
           }
       }
    }
    return $res;
  }
  public function activation($reg,$dep,$yr,$sem,$fdate,$tdate)
  {
  //echo "hi";
   $res = 0;
   if($this->myerr==0 && !empty($this->myconn)){
   $query1="SELECT `br_code` FROM `subjects` WHERE `branch`=?";
   if ($stmt1 = $this->myconn->prepare($query1)) {
	  $stmt1->bind_param("s",$dep);
	  if($stmt1->execute()){
	  $stmt1->bind_result($brc);
	  while($stmt1->fetch()){
	  $brc1=$brc;
	  }
	  }
	  }
	  
   $query="INSERT INTO `activation` (`regulation`,`branch`,`year`,`sem`,`from_date`,`to_date`) VALUES(?,?,?,?,?,?)";
      if ($stmt = $this->myconn->prepare($query)) {
	  $stmt->bind_param("ssssss",$reg,$brc,$yr,$sem,$fdate,$tdate);
	  if($stmt->execute()){
			   if($this->myconn->affected_rows){
			   $query2="UPDATE `st_login` SET `feedback_status`='1' WHERE `regulation`=? AND `year`=? AND `sem`=? AND `br_code`=?";
	          if ($stmt2 = $this->myconn->prepare($query2)) {
	          $stmt2->bind_param("ssss",$reg,$yr,$sem,$brc1);
	           if($stmt2->execute()){
	 	         if($this->myconn->affected_rows){
	           $res = 1;
	               }
	             }
	         }
			}
		}	
	  
	  }
  
  }
  return $res;
  }
  
  public function addFacMap($reg,$bran,$yr,$se,$su,$fna)
  {
     $branch=$bran;
	 $val=0;
  if($this->myerr==0 && !empty($this->myconn)){
  $query1="SELECT `br_code` FROM `subjects` WHERE `branch`=?";
   if($stmt1=$this->myconn->prepare($query1)){
      $stmt1->bind_param("s",$bran);
	   if($stmt1->execute()){
	 $stmt1->bind_result($brc);
	  while($stmt1->fetch()){
	  $brc1=$brc;
	  }
	  }
	  }
	  //echo $brc;
	  $query="INSERT INTO `fac_course` (`regulation`,`branch`,`br_code`,`year`,`sem`,`subject`,`fname`) VALUES (?,?,?,?,?,?,?)";
    if($stmt=$this->myconn->prepare($query)){
      $stmt->bind_param("sssssss",$reg,$branch,$brc,$yr,$se,$su,$fna);
	  if($stmt->execute()){
		if($this->myconn->affected_rows){
		$val=1;
      }
      }
    }
}
//echo $val;
return $val;
  }
  
  public function getTime($reg,$dep,$yr,$sem)
  {
  $time=array();
  if($this->myerr==0 && !empty($this->myconn)){
     $query="SELECT `from_date`,`to_date` FROM `activation` WHERE `regulation`=? AND `branch`=? AND `year`=? AND `sem`=?";
	  if ($stmt = $this->myconn->prepare($query)) {
	  $stmt->bind_param("ssss",$reg,$dep,$yr,$sem);
	  if($stmt->execute()){
	   $stmt->bind_result($from,$to);
	   while($stmt->fetch()){
	   $time['from']=$from;
	   $time['to']=$to;
	      }
	    }
	   }
	  }
  return $time;
  }
  public function updatefDetails($tid,$subid,$q11,$q21,$q31,$q41,$q51,$q61,$q71,$q81,$q91,$q101,$q111,$q121,$q131,$q141,$avg,$ct){
    $insres = 0;
	
    if($this->myerr==0 && !empty($this->myconn)){
     
      if ($stmt = $this->myconn->prepare("UPDATE `feedback`.`ques` SET `qs1`=$q11,`qs2`=$q21,`qs3`=$q31,`qs4`=$q41,`qs5`=$q51,`qs6`=$q61,`qs7`=$q71,`qs8`=$q81,`qs9`=$q91,`qs10`=$q101,`qs11`=$q111,`qs12`=$q121,`qs13`=$q131,`qs14`=$q141,`avg`='$avg'`count`='$ct' WHERE `fid`=? AND `sid`= ?")) {
          
		 $stmt->bind_param("ss",$tid,$subid);

           if($stmt->execute()){
             $insres = 1;
           }
       }
    }
    return $insres;
  }

public function updateData($tid,$br,$yr1,$sm,$regu,$subid,$q11,$q21,$q31,$q41,$q51,$q61,$q71,$q81,$q91,$q101,$q111,$q121,$q131,$q141,$avg,$ct){
    $insres = 0;
    if($this->myerr==0 && !empty($this->myconn)){
      $query = "UPDATE `ques` SET `qs1`=?,`qs2`=?,`qs3`=?,`qs4`=?,`qs5`=?,`qs6`=?,`qs7`=?,`qs8`=?,`qs9`=?,`qs10`=?,`qs11`=?,`qs12`=?,`qs13`=?,`qs14`=?,`avg`=?,`count`=? WHERE `fid`=?  AND `br_code`=? AND `year`=? AND `sem`=? AND `regulation`=? AND `Sid`=?" ;
      if ($stmt = $this->myconn->prepare($query)) {
          $stmt->bind_param("ssssssssssssssssssssss",$q11,$q21,$q31,$q41,$q51,$q61,$q71,$q81,$q91,$q101,$q111,$q121,$q131,$q141,$avg,$ct,$tid,$br,$yr1,$sm,$regu,$subid);

           if($stmt->execute()){
			   if($this->myconn->affected_rows){
				$insres = 1;
			   }
           }
       }
    }
    return $insres;
	
  }
  
  
 /* public function 
 Data($tid,$subid,$q11,$q21,$q31,$q41,$q51,$q61,$q71,$q81,$q91,$q101,$q111,$q121,$q131,$q141,$avg,$ct){
    $insres = 0;
	 
    if($this->myerr==0 && !empty($this->myconn)){
		
      $query = "INSERT INTO `ques`(`fid`, `sid`, `qs1`, `qs2`, `qs3`, `qs4`, `qs5`, `qs6`, `qs7`, `qs8`, `qs9`, `qs10`, `qs11`, `qs12`, `qs13`, `qs14`, `avg`, `count`) VALUES ($tid,$subid,$q11,$q21,$q31,$q41,$q51,$q61,$q71,$q81,$q91,$q101,$q111,$q121,$q131,$q141,$avg,$ct)";
      if ($stmt = $this->myconn->prepare($query)) {
          
         
           if($stmt->execute()){
			   if($this->myconn->affected_rows){
				$insres = 1;
			   }
           }
       }
    }
    return $insres;
  }*/
  
   public function insertData($tid,$br1,$yr1,$sm,$regu,$subid,$q11,$q21,$q31,$q41,$q51,$q61,$q71,$q81,$q91,$q101,$q111,$q121,$q131,$q141,$avg,$ct){
    $insres = 0;
    if($this->myerr==0 && !empty($this->myconn)){
   
      $query = "INSERT INTO `ques`(`fid`,`br_code`,`year`,`sem`,`regulation`,`sid`, `qs1`, `qs2`, `qs3`, `qs4`, `qs5`, `qs6`, `qs7`, `qs8`, `qs9`, `qs10`, `qs11`, `qs12`, `qs13`, `qs14`, `avg`, `count`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
      if ($stmt = $this->myconn->prepare($query)) {
          $stmt->bind_param("ssssssssssssssssssssss",$tid,$br1,$yr1,$sm,$regu,$subid,$q11,$q21,$q31,$q41,$q51,$q61,$q71,$q81,$q91,$q101,$q111,$q121,$q131,$q141,$avg,$ct);

           if($stmt->execute()){
			   if($this->myconn->affected_rows){
				$insres = 1;
			   }
           }
       }
    }
    return $insres;
  }
  
  
  public function insertOtp($uid,$otp,$stat){
    $insres = 0;
    if($this->myerr==0 && !empty($this->myconn)){
  // echo "hi"(this is printing);
      $query = "UPDATE `st_login` SET `spass`=?,`otp_status`=? WHERE `sid`=?";
      if ($stmt = $this->myconn->prepare($query)) {
          $stmt->bind_param("sss",$otp,$stat,$uid);

           if($stmt->execute()){
			   if($this->myconn->affected_rows){
				$insres = 1;
				 return $insres;
			  }
			  else{
		 // echo "hi"(this is not printing);
		   			 $query = "UPDATE `fac_login` SET `fpass`=?,`otp_status`=? WHERE `fname`=?";
              if ($stmt = $this->myconn->prepare($query)) {
          $stmt->bind_param("sss",$otp,$stat,$uid);

           if($stmt->execute()){
			   if($this->myconn->affected_rows){
				$insres = 2;
				return $insres;
				 }
				 
			  
           }
		   }
		   }
		   }
		   
       }
	  
    }
  //  return $insres;
  }
  
   public function insertcmnt($fname,$sub,$st,$cmt){
    $ins = 0;
    if($this->myerr==0 && !empty($this->myconn)){
   
      $query = "INSERT INTO `comments`(`fname`, `subject`, `stid`, `cmnt`) VALUES (?,?,?,?)";
      if ($stmt = $this->myconn->prepare($query)) {
          $stmt->bind_param("ssss",$fname,$sub,$st,$cmt);

           if($stmt->execute()){
			   if($this->myconn->affected_rows){
				$ins = 1;
			   }
           }
       }
    }
    return $ins;
  }
  
 /* public function insertD($uid,$email,$otp,$prev,$status){
    $insre = 0;
    if($this->myerr==0 && !empty($this->myconn)){
    
      $query = "INSERT INTO `st_login`(`sid`, `email`, `spass`, `privilege`, `status`) VALUES (?,?,?,?,?)";
      if ($stmt = $this->myconn->prepare($query)) {
		 
          $stmt->bind_param("sssss",$uid,$email,$otp,$prev,$status);

           if($stmt->execute()){
			   if($this->myconn->affected_rows){
				$insre = 1;
			   }
           }
       }
    }
    return $insre;
  }*/
  
  public function delPass($user)
  {
	  
	  $insres=0;
	  $val = "0";
	  if($this->myerr==0 && !empty($this->myconn))
	  {
		  
		  $query = "UPDATE `st_login` SET `feedback_status`=0 WHERE `sid`=?";
		  if($stmt = $this->myconn->prepare($query))
		  {
			  
			  $stmt->bind_param("s",$user);
			  if($stmt->execute())
			  {
				 if($this->myconn->affected_rows){
				$insres = 1;
			   } 
			  }
		  }
	  }
	  return $insres;
  }
  public function getFeed($user)
  {
   if($this->myerr==0 && !empty($this->myconn))
	  {
 $query="SELECT `feedback_status` FROM `st_login` WHERE `sid`=?";
     if($stmt = $this->myconn->prepare($query))
		  {
		   $stmt->bind_param("s",$user);
		   if($stmt->execute())
			  {
			  $stmt->bind_result($res1);
			  while($stmt->fetch()){
			  $res=$res1;
			  }
			  }
		  }
 
  }
  return $res;
 }
  
  public function updateStudent($user)
  {
    $insres=0;
    if($this->myerr==0 && !empty($this->myconn))
	  {
	  $query="UPDATE `st_login` SET `feedback_status`='1' WHERE `sid`=?";
	  if($stmt = $this->myconn->prepare($query))
		  {
		  $stmt->bind_param("s",$user);
			  if($stmt->execute())
			  {
			  if($this->myconn->affected_rows){
				$insres = 1;
			  
			  }
		  
		  }
	  }
  }
  return $insres;
  }
  
  public function addFac($branch,$fname,$br_code,$fpass,$privilege,$email)
  {
	 $val=0;
  if($this->myerr==0 && !empty($this->myconn)){
    if($stmt=$this->myconn->prepare("INSERT INTO `fac_login`(`branch`, `fname`,`br_code`,`fpass`,`privilege`,`email`) VALUES (?,?,?,?,?,?)")){
      $stmt->bind_param("ssssss",$branch,$fname,$br_code,$fpass,$privilege,$email);
	  		  

      if($stmt->execute()){
		  
        $val=1;
      }
    }
}
return $val;
  }
  public function addCourse($cname,$crcode,$reg,$year,$sem)
  {
	 $val=0;
  if($this->myerr==0 && !empty($this->myconn)){
    if($stmt=$this->myconn->prepare("INSERT INTO `course`(`crcode`, `cname`,`regulation`,`year`,`sem`) VALUES (?,?,?,?,?)")){
      $stmt->bind_param("sssss",$crcode,$cname,$reg,$year,$sem);
	  		  

      if($stmt->execute()){
		  
        $val=1;
      }
    }
}
return $val;
  }
  public function delFac($fac)
  {
	 $val=0;
  if($this->myerr==0 && !empty($this->myconn)){
    if($stmt=$this->myconn->prepare("DELETE FROM `fac_login` WHERE `fname`=?")){
      $stmt->bind_param("s",$fac);
	  		  

      if($stmt->execute()){
		  
        $val=1;
      }
    }
}
return $val;
  }
   public function delCourse($cname)
  {
	 $val=0;
  if($this->myerr==0 && !empty($this->myconn)){
    if($stmt=$this->myconn->prepare("DELETE FROM `course` WHERE `cname`=?")){
      $stmt->bind_param("s",$cname);
	  		  

      if($stmt->execute()){
		  
        $val=1;
      }
    }
}
return $val;
  }
  
  
  public function chngpwd($user,$pwd){
  $res=0;
  if($this->myerr==0 && !empty($this->myconn)){
    if($stmt=$this->myconn->prepare("UPDATE `fac_login` SET `fpass`=? WHERE `fname`=?")){
      $stmt->bind_param("ss",$pwd,$user);
      if($stmt->execute()){
        $res=1;
      }
    }
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
