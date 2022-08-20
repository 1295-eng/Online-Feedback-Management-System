<?php
	date_default_timezone_set("Asia/Kolkata");
	
	require_once("DBCredentials.php");
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
				
				if ($stmt = $this->myconn->prepare("SELECT `privilege`, `cr_code`, `regulation`, `year`, `sem`, `br_code`, `otp_status`,`status`,`feedback_status` FROM `st_login` WHERE `sid`=? AND `spass`=?")) {
					$stmt->bind_param("ss",$user,$pwd);
					
					if($stmt->execute()){
						
						/* bind result variables */
						$stmt->bind_result($privileges,$crcodes,$regs,$yrs,$sems,$brcodes,$otpstats,$stat,$feeds);
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
							$res['cr_code'] = $crcodes;
							$res['reg'] = $regs;
							$res['yr'] = $yrs;
							$res['sem'] = $sems;
							$res['br_code'] = $brcodes;
							
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
		
		public function getFdetails($fname,$sub,$br1,$yr1,$sm,$regu,$course,$feed_id){
			$res = array();
			$res['status'] = 0;
			
			if($this->myerr==0 && !empty($this->myconn)){
				$query = "SELECT  `qs1`, `qs2`, `qs3`, `qs4`, `qs5`, `qs6`, `qs7`, `qs8`, `qs9`, `qs10`, `qs11`, `qs12`, `qs13`, `qs14`, `count` FROM `ques` WHERE `fid`=? AND `sid`=? AND `br_code`=? AND `year`=? AND `sem`=? AND `regulation`=? AND `cr_code`=? and feed_id=?";
				if ($stmt = $this->myconn->prepare($query)) {
					$stmt->bind_param("sssssssd",$fname,$sub,$br1,$yr1,$sm,$regu,$course,$feed_id);
					
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
				$query="SELECT `branch` FROM `subjects_2` WHERE `br_code`=?";
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
		
		public function getActivation($reg,$cr,$br,$yr,$sem){
			$res1 = array();
			$res1['status'] = 0;
			
			if($this->myerr==0 && !empty($this->myconn)){
				$query = "SELECT `id`, `from_date`,`to_date` FROM `activation` WHERE `regulation`=? AND `cr_code`=? AND `branch`=? AND `year`=? And `sem`=?";
				
				if ($stmt = $this->myconn->prepare($query)) {
					$stmt->bind_param("sssss",$reg,$cr,$br,$yr,$sem);
					
					if($stmt->execute()){
						/* bind result variables */
						$stmt->bind_result($id, $fd, $td);
						
						while ($stmt->fetch()) {
							$res1['fd']=$fd;
							$res1['td']=$td;
							$res1['feed_id']=$id;				
							$res1['status'] = 1;				              
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
		
		
		public function getFeedsSelectTag($reg,$cr,$br,$yr,$sem){
			$res="<option value=''>--Select--</option>";
			if($this->myerr==0 && !empty($this->myconn)){
				$query = "SELECT `id`, `from_date`,`to_date` FROM `activation` WHERE `regulation`=? AND `cr_code`=? AND `branch`=? AND `year`=? And `sem`=? order by from_date desc";
				
				if ($stmt = $this->myconn->prepare($query)) {
					$stmt->bind_param("sssss",$reg,$cr,$br,$yr,$sem);
					
					if($stmt->execute()){
						/* bind result variables */
						$stmt->bind_result($id, $fd, $td);
						
						while ($stmt->fetch()) {
							$fd = date('d-m-Y',strtotime($fd));
							$td = date('d-m-Y',strtotime($td));
							$temp = $id.'_'.$fd.'_'.$td;
							$res.= "<option value='".$temp."'>".$fd." - ".$td."</option>";
						}/*while loop close*/
						
					}
				}
			}
			return $res;
		}
		
		
		public function getActivationByBrCode($br){
			$res1 = array();
			$res1['status'] = 0;
			
			if($this->myerr==0 && !empty($this->myconn)){
				$query = "SELECT `id`, `regulation`, `cr_code`, `year`, `sem`, `from_date`, `to_date` FROM `activation` WHERE `branch`=? order by `from_date`";
				
				if ($stmt = $this->myconn->prepare($query)) {
					$stmt->bind_param("s",$br);
					
					if($stmt->execute()){
						/* bind result variables */
						$stmt->bind_result($id, $reg, $cr, $yr, $sem, $fd, $td);
						
						$i = 0;
						while ($stmt->fetch()) {
							$res1[$i]['fd']=$fd;
							$res1[$i]['td']=$td;
							$res1[$i]['reg']=$reg;
							$res1[$i]['yr']=$yr;
							$res1[$i]['sem']=$sem;				              
							$res1[$i]['cr']=$cr;				              				
							$res1[$i]['feed_id']=$id;
							$i++;
							$res1['status'] = 1;
						}/*while loop close*/
						$res1['ival'] = $i;
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
		
		public function getActivationByBr($br){
			$res1 = array();
			$res1['status'] = 0;
			
			if($this->myerr==0 && !empty($this->myconn)){
				$query = "SELECT activation.`id`, `regulation`, `cr_code`, `year`, `sem`, spec.brcode, `from_date`, `to_date` FROM `activation` LEFT JOIN spec on activation.cr_code = `spec`.crcode AND activation.branch=`spec`.brcode WHERE spec.`branch`=? order by `from_date`";
				
				if ($stmt = $this->myconn->prepare($query)) {
					$stmt->bind_param("s",$br);
					
					if($stmt->execute()){
						/* bind result variables */
						$stmt->bind_result($id, $reg, $cr, $yr, $sem, $brc, $fd, $td);
						
						$i = 0;
						while ($stmt->fetch()) {
							$res1[$i]['fd']=$fd;
							$res1[$i]['td']=$td;
							$res1[$i]['reg']=$reg;
							$res1[$i]['yr']=$yr;
							$res1[$i]['sem']=$sem;				              
							$res1[$i]['brc']=$brc;				              							
							$res1[$i]['cr']=$cr;				              				
							$res1[$i]['feed_id']=$id;
							$i++;
							$res1['status'] = 1;
						}/*while loop close*/
						$res1['ival'] = $i;
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
		
		
		public function selectd($fac,$sub,$cr1){
			$res = array();
			$res['status'] = 0;
			
			
			if($this->myerr==0 && !empty($this->myconn)){
				$query = "SELECT  `qs1`, `qs2`, `qs3`, `qs4`, `qs5`, `qs6`, `qs7`, `qs8`, `qs9`, `qs10`, `qs11`, `qs12`, `qs13`, `qs14`, `avg`, `count` FROM `ques` WHERE `fid`=? AND `cr_code`=? AND  `sid`=?";
				if ($stmt = $this->myconn->prepare($query)) {
					$stmt->bind_param("sss",$fac,$cr1,$sub);
					
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
		
		
		public function selectd2($fac,$sub,$cr1,$brc,$feed_id){
			$res = array();
			$res['status'] = 0;
			
			
			if($this->myerr==0 && !empty($this->myconn)){
				$query = "SELECT  `qs1`, `qs2`, `qs3`, `qs4`, `qs5`, `qs6`, `qs7`, `qs8`, `qs9`, `qs10`, `qs11`, `qs12`, `qs13`, `qs14`, `avg`, `count` FROM `ques` WHERE `fid`=? AND `cr_code`=? AND  `sid`=? and `br_code`=? and feed_id=?";
				if ($stmt = $this->myconn->prepare($query)) {
					$stmt->bind_param("ssssd",$fac,$cr1,$sub,$brc,$feed_id);
					
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
		
		public function getComments($fac,$sub){
			$res = array();
			$res['status'] = 0;
			$res['sub'] = $sub;
			$res['comments'] = array();
			
			if($this->myerr==0 && !empty($this->myconn)){
				$query = "SELECT `cmnt` FROM `comments` WHERE `fname`=? and `subject`=?";
				if ($stmt = $this->myconn->prepare($query)) {
					$stmt->bind_param("ss",$fac,$sub);
					
					if($stmt->execute()){
						/* bind result variables */
						$stmt->bind_result($cmnts);
						while ($stmt->fetch()) {
							array_push($res['comments'],$cmnts);
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
		
		
		public function getComments2($fac,$sub,$brc,$feed_id){
			$res = array();
			$res['status'] = 0;
			$res['sub'] = $sub;
			$res['comments'] = array();
			$brroll = str_pad($brc, 2, '0', STR_PAD_LEFT);
			$roll = '%_____'.$brroll.'__%';
			if($this->myerr==0 && !empty($this->myconn)){
				$query = "SELECT `cmnt` FROM `comments` WHERE `fname`=? and `subject`=? and trim(stid) like ? and feed_id=?";
				if ($stmt = $this->myconn->prepare($query)) {
					$stmt->bind_param("sssd",$fac,$sub,$roll,$feed_id);
					
					if($stmt->execute()){
						/* bind result variables */
						$stmt->bind_result($cmnts);
						while ($stmt->fetch()) {
							array_push($res['comments'],$cmnts);
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
				if ($stmt = $this->myconn->prepare("SELECT   DISTINCT `fname` FROM `fac_login` WHERE `br_code`=? and `privilege` like '%staff%'")) {
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

		public function getFacultyByBranch($br){
			$res = array();
			if($this->myerr==0 && !empty($this->myconn)){
				//"SELECT fid,avg FROM `ques` where feed_id>19 and fid in (SELECT fname FROM `fac_login` where branch=?) ORDER BY `ques`.`fid` ASC"
				if ($stmt = $this->myconn->prepare("select fid,avg(avg) FROM `ques` where fid in (SELECT fname FROM `fac_login` where br_code=?) group by fid ORDER BY avg(avg) desc")) {
					$stmt->bind_param("s",$br);
					if($stmt->execute()){
						$stmt->bind_result($facs,$score);
						$i = 0;
						while ($stmt->fetch()) {
							$res[$i]['fid'] = $facs;
							$res[$i]['avg']=$score;
							$i++;
						}
						$res['ival'] = $i;
					}
				}
			}
			return $res;
		}
		
		
		public function getF2($reg,$cr,$br,$yr,$sem){
			$faculty = array();
			if($this->myerr==0 && !empty($this->myconn)){
				if ($stmt = $this->myconn->prepare("SELECT  DISTINCT`fname` FROM `fac_course` WHERE `regulation`=? AND `cr_code`=? AND `br_code`=? AND `year`=? AND `sem`=?")) {
					$stmt->bind_param("sssss",$reg,$cr,$br,$yr,$sem);
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
		
		public function getStDetails($roll){
			$std = array();
			$std['status'] = 0;		
			if($this->myerr==0 && !empty($this->myconn)){
				if ($stmt = $this->myconn->prepare("SELECT  email,spass FROM `st_login` WHERE `sid`=?")) {
					$stmt->bind_param("s",$roll);
					if($stmt->execute()){
						$stmt->bind_result($dts,$pass);
						$i = 0;
						$pwd = "";
						while ($stmt->fetch()) {
							$std['email'] = $dts;
							$i++;
							$std['status'] = 1;
							$pwd = $pass;
						}
						if($pwd==$roll){
							$std['status'] = 2;
						}
					}
				}
			}
			return $std;
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
				if($stmt = $this->myconn->prepare("SELECT DISTINCT `regulation` FROM `subjects_2`")){
					if($stmt->execute()){
						$stmt->bind_result($regs);
						$i=0;
						while($stmt->fetch()){
//							$regulation[$i]=$regs;
//							$i++;
						}
						$regulation[0]="15";
						$regulation[1]="17";
						$regulation[2]="19";
						$regulation[3]="20";
						$i = 3;
					}
				}
			}
			return $regulation;
		}
		
		public function getBr1($br){
			$spec = array();
			if($this->myerr==0 && !empty($this->myconn)){
				if($stmt = $this->myconn->prepare("SELECT DISTINCT `br_code`,spec FROM `subjects_2` a left join spec b on a.br_code=b.brcode where a.branch=?")){
					$stmt->bind_param("s",$br);		
					if($stmt->execute()){
						$stmt->bind_result($specss,$spec_names);
						$i=0;
						while($stmt->fetch()){
							$spec[$i]=$specss."|".$spec_names;
							$i++;
						}
					}
				}
			}
			return $spec;
		}


		public function getBr2($br){
			$spec = array();
			if($this->myerr==0 && !empty($this->myconn)){
				if($stmt = $this->myconn->prepare("SELECT `brcode`, `spec`, `crcode` FROM `spec` where branch=?")){
					$stmt->bind_param("s",$br);		
					if($stmt->execute()){
						$stmt->bind_result($specss,$spec_names,$crs);
						$i=0;
						while($stmt->fetch()){
							$spec[$i]=$specss."|".$spec_names."|".$crs;
							$i++;
						}
					}
				}
			}
			return $spec;
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
		
		public function getBrSpecs($br){
			$res=array();
			if($this->myerr==0 && !empty($this->myconn)){
				if($stmt = $this->myconn->prepare("SELECT `brcode`, `spec`, `crcode` FROM `spec` WHERE `branch`=?")){
					$stmt->bind_param("s",$br);
					if($stmt->execute()){
						$stmt->bind_result($brcs,$specs,$crs);
						$i = 0; 			 
						while($stmt->fetch()){
							$res[$i]['cr_br'] = $crs.'_'.$brcs;
							$res[$i]['spec'] = $specs;
							$i++;
							$res['ival'] = $i;				 
						}
					}
				} 
			}
			return $res;
		}
		
		
		public function getList($fac,$crse){
			require_once("cr_codes.php");	  
			$res="<option value=''>--Select--</option>";
			if($this->myerr==0 && !empty($this->myconn)){
				if ($stmt = $this->myconn->prepare("SELECT  DISTINCT a.`feed_id`, a.`sid`, a.`br_code`, a.`year`, a.`sem`, b.`from_date`, b.`to_date` FROM `ques` a left join activation b on a.feed_id=b.id WHERE a.`fid`=? AND a.`cr_code`=? order by a.feed_id desc")) {
					$stmt->bind_param("ss",$fac,$crse);
					if($stmt->execute()){
						$stmt->bind_result($feed_id,$sub,$brc,$yr,$sem,$fromdt,$todt);
						//$i = 0;
						while ($stmt->fetch()) {
							$temp_dt = date('d-m-Y',strtotime($fromdt));
							$feeddt = $feed_id;
							if(!empty($temp_dt) && $temp_dt!="01-01-1970"){
								$feeddt = $temp_dt;
							}
							if(!empty($br_name[$brc])){
								$brname = $br_name[$brc];
								}else{
								$brname = $brc;
							}
							$res.= "<option value='".$brc.'_'.$sub.'_'.$feed_id."'>".$brname." - ".$yr." - ".$sem." - ".$sub." - ".$feeddt."</option>";
						}
					}
				}
			}
			return $res;
		}
		public function getList2($reg1,$cr1,$br1,$yr1,$sem1,$fac1){
			$res="<option value=''>--Select--</option>";
			//$sub=array();
			if($this->myerr==0 && !empty($this->myconn)){
				if ($stmt = $this->myconn->prepare("SELECT  `subject` FROM `fac_course` WHERE `regulation`=? AND `cr_code`=? AND `br_code`=? AND `year`=? AND `sem`=? AND `fname`=?")) {
					$stmt->bind_param("ssssss",$reg1,$cr1,$br1,$yr1,$sem1,$fac1);
					if($stmt->execute()){
						$stmt->bind_result($sub);
						//$i = 0;
						while ($stmt->fetch()) {
							$res.= "<option value='".$sub ."'>".$sub."</option>";
						}
					}
				}
			}
			return $res;
		}
		
		
		
		public function getList1($reg,$cr,$branch,$year,$sem){
			$res="<option>--Select--</option>";
			$sub=array();
			$fac_subs = array();
			require_once("cr_codes.php");
			if($this->myerr==0 && !empty($this->myconn)){
				if ($stmt = $this->myconn->prepare("SELECT `subject` FROM `fac_course` WHERE `regulation`=? AND `cr_code`=? AND `branch`=? AND `year`=? AND `sem`=?")) {
					$stmt->bind_param("sssss",$reg,$cr,$branch,$year,$sem);
					if($stmt->execute()){
						$stmt->bind_result($subs);
						$i = 0;
						while ($stmt->fetch()) {
							array_push($fac_subs,$subs);
						}
					}
				}			
				if ($stmt = $this->myconn->prepare("SELECT `br_code`, `sub` FROM `subjects_2` WHERE `regulation`=? AND `cr_code`=? AND `branch`=? AND `year`=? AND `sem`=?")) {
					$stmt->bind_param("sssss",$reg,$cr,$branch,$year,$sem);
					if($stmt->execute()){
						$stmt->bind_result($brcodes,$sub);
						$i = 0;
						while ($stmt->fetch()) {
							$v = $brcodes."|".$sub;
							if(!in_array($sub,$fac_subs)){
								$res.= "<option value='".$v."'>".$brcodes." - ".$sub."</option>";
							}
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
		
		
		public function getF1All($branch){
			$res="<option>--select--</option>";
			if($this->myerr==0 && !empty($this->myconn)){
				
				if ($stmt = $this->myconn->prepare("SELECT `fname`, `br_code`, `branch` FROM `fac_login` where privilege!='admin' order by `br_code`")) {
					if($stmt->execute()){
						$stmt->bind_result($facs,$brcs,$brs);
						$i = 0;
						$arr = array();
						while ($stmt->fetch()) {				
							$arr[$i]['br'] = $brs;
							$arr[$i]['brc'] = $brcs;
							$arr[$i]['fac'] = $facs;
							$i++;
						}
						
						$res.= "<optgroup label='".$branch."'>";
						for($j=0;$j<$i;$j++){
							if(!empty($arr[$j]['br']) && $arr[$j]['br'] == $branch){					
								$res.= "<option value='".$arr[$j]['fac']."'>".$arr[$j]['fac']."</option>";
								unset($arr[$j]);
							}				
						}
						$res.= "</optgroup>";
						
						$res.= "<optgroup label='H&S'>";
						for($j=0;$j<$i;$j++){
							if(!empty($arr[$j]['brc']) && $arr[$j]['brc'] == "99"){					
								$res.= "<option value='".$arr[$j]['fac']."'>".$arr[$j]['fac']."</option>";
								unset($arr[$j]);
							}				
						}
						$temp_brc == "99";
						for($j=0;$j<$i;$j++){				
							if(!empty($arr[$j]['brc'])){
								if($arr[$j]['brc'] != $temp_brc){					
									$res.= "</optgroup><optgroup label='".$arr[$j]['br']."'>";
									$temp_brc = $arr[$j]['brc'];
								}
								$res.= "<option value='".$arr[$j]['fac']."'>".$arr[$j]['fac']."</option>";				
							}
						}
						$res.= "</optgroup>";
						
					}
				}
			}
			return $res;
		}
		
		public function activation($reg,$cr,$brc1,$yr,$sem,$fdate,$tdate)
		{
			//echo "hi";
			$res = 0;
			if($this->myerr==0 && !empty($this->myconn)){
				
				$query="INSERT INTO `activation` (`regulation`,`cr_code`,`branch`,`year`,`sem`,`from_date`,`to_date`) VALUES(?,?,?,?,?,?,?)";
				if ($stmt = $this->myconn->prepare($query)) {
					$stmt->bind_param("sssssss",$reg,$cr,$brc1,$yr,$sem,$fdate,$tdate);
					if($stmt->execute()){
						if($this->myconn->affected_rows){
							$query2="UPDATE `st_login` SET `feedback_status`='1' WHERE `regulation`=? AND `year`=? AND `sem`=? AND `br_code`=?";
							if ($stmt2 = $this->myconn->prepare($query2)) {
								$stmt2->bind_param("ssss",$reg,$yr,$sem,$brc1);
								if($stmt2->execute()){
									$res = 1; // change this logic				   
									if($this->myconn->affected_rows){
										$res = 1;
										}else{
										
									}
								}
								
							}
							
						}
						
					}
					
				}
			}
			return $res;
		}
		
		public function addFacMap($reg,$bran,$cr,$yr,$se,$su,$fna)
		{
			$branch=$bran;
			$val=0;
			if($this->myerr==0 && !empty($this->myconn)){
				/* $query1="SELECT `br_code` FROM `subjects_2` WHERE `branch`=?";
					if($stmt1=$this->myconn->prepare($query1)){
					$stmt1->bind_param("s",$bran);
					if($stmt1->execute()){
					$stmt1->bind_result($brc);
					while($stmt1->fetch()){
					$brc1=$brc;
					}
					}
				}*/
				//echo $brc;
				$subbr = explode('|',$su);
				$brc = $subbr[0];
				$sub = $subbr[1];
				$query="INSERT INTO `fac_course` (`regulation`,`cr_code`,`branch`,`br_code`,`year`,`sem`,`subject`,`fname`) VALUES (?,?,?,?,?,?,?,?)";
				if($stmt=$this->myconn->prepare($query)){
					$stmt->bind_param("ssssssss",$reg,$cr,$branch,$brc,$yr,$se,$sub,$fna);
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


		public function addSub($reg,$brc,$crs,$branch,$yr,$sem,$sub)
		{
			$val=0;
			if($this->myerr==0 && !empty($this->myconn)){
				$query="INSERT INTO `subjects_2`(`regulation`, `br_code`, `cr_code`, `branch`, `year`, `sem`, `sub`) VALUES (?,?,?,?,?,?,?)";
				if($stmt=$this->myconn->prepare($query)){
					$stmt->bind_param("sssssss",$reg,$brc,$crs,$branch,$yr,$sem,$sub);
					if($stmt->execute()){
						if($this->myconn->affected_rows){
							$val=1;
						}
					}else{
						die(".");
					}
					}else{
						die("l.");
					}			}
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
		
		public function updateData($tid,$br,$yr1,$sm,$regu,$course,$subid,$q11,$q21,$q31,$q41,$q51,$q61,$q71,$q81,$q91,$q101,$q111,$q121,$q131,$q141,$avg,$ct,$feed_id,$user){
			$insres = 0;
			if($this->myerr==0 && !empty($this->myconn)){
				$query = "UPDATE `ques` SET `qs1`=?,`qs2`=?,`qs3`=?,`qs4`=?,`qs5`=?,`qs6`=?,`qs7`=?,`qs8`=?,`qs9`=?,`qs10`=?,`qs11`=?,`qs12`=?,`qs13`=?,`qs14`=?,`avg`=?,`count`=? WHERE `feed_id`=? and `fid`=?  AND `br_code`=? AND `year`=? AND `sem`=? AND `regulation`=? AND `cr_code`=? AND `Sid`=?" ;
				if ($stmt = $this->myconn->prepare($query)) {
					$stmt->bind_param("ssssssssssssssssdsssssss",$q11,$q21,$q31,$q41,$q51,$q61,$q71,$q81,$q91,$q101,$q111,$q121,$q131,$q141,$avg,$ct,$feed_id,$tid,$br,$yr1,$sm,$regu,$course,$subid);
					
					if($stmt->execute()){
						if($this->myconn->affected_rows){
							$insres = 1;
							$this->submitFeed($user,$subid,$feed_id);				
						}
					}
				}
			}
			return $insres;
			
		}
		
		public function insertData($tid,$br1,$yr1,$sm,$regu,$course,$subid,$q11,$q21,$q31,$q41,$q51,$q61,$q71,$q81,$q91,$q101,$q111,$q121,$q131,$q141,$avg,$ct,$feed_id,$user){
			$insres = 0;
			if($this->myerr==0 && !empty($this->myconn)){
				
				$query = "INSERT INTO `ques`(`feed_id`, `fid`,`br_code`,`year`,`sem`,`regulation`,`cr_code`,`sid`, `qs1`, `qs2`, `qs3`, `qs4`, `qs5`, `qs6`, `qs7`, `qs8`, `qs9`, `qs10`, `qs11`, `qs12`, `qs13`, `qs14`, `avg`, `count`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
				if ($stmt = $this->myconn->prepare($query)) {
					$stmt->bind_param("dsssssssssssssssssssssss",$feed_id,$tid,$br1,$yr1,$sm,$regu,$course,$subid,$q11,$q21,$q31,$q41,$q51,$q61,$q71,$q81,$q91,$q101,$q111,$q121,$q131,$q141,$avg,$ct);
					
					if($stmt->execute()){
						if($this->myconn->affected_rows){
							$insres = 1;
							$this->submitFeed($user,$subid,$feed_id);
						}
					}
					else{
						//echo $this->myconn->error;
					}
				}
			}
			return $insres;
		}
		
		
		public function submitFeed($user,$sid,$feed_id){
			$insres = 0;
			if($this->myerr==0 && !empty($this->myconn)){
				$query = "INSERT INTO `feedsSubmitted`(`user`, `subject`, `feed_id`) VALUES (?,?,?)" ;
				if ($stmt = $this->myconn->prepare($query)) {
					$stmt->bind_param("ssd",$user,$sid,$feed_id);
					
					if($stmt->execute()){
						if($this->myconn->affected_rows){
							$insres = 1;
						}
					}
				}
			}
			return $insres;
			
		}
		
		
		public function getFeedsSubmitted($user,$feed_id){
			$res = array();
			$res['subjects'] = array();
			if($this->myerr==0 && !empty($this->myconn)){
				$query = "select `subject` from `feedsSubmitted` where `user`=? and `feed_id`=?" ;
				if ($stmt = $this->myconn->prepare($query)) {
					$stmt->bind_param("sd",$user,$feed_id);
					if($stmt->execute()){
						$stmt->bind_result($subs);
						while ($stmt->fetch()){
							array_push($res['subjects'],$subs);
						}
					}
				}
			}
			return $res;	
		}
		
		
		public function insertInitData(){
			$insres = 0;
			if($this->myerr==0 && !empty($this->myconn)){
				$i = 0;
				
				if ($stmt = $this->myconn->prepare("SELECT `regulation`, `cr_code`, `branch`, `br_code`, `year`, `sem`, `subject`, `fname` FROM `fac_course`")) {
					if($stmt->execute()){
						$stmt->bind_result($regs,$crs,$brs,$brcs,$yrs,$sems,$subs,$facs);
						while ($stmt->fetch()) {
							$reg[$i] = $regs;
							$cr[$i] = $crs;
							$br[$i] = $brs;
							$brc[$i] = $brcs;
							$yr[$i] = $yrs;
							$sem[$i] = $sems;
							$sub[$i] = $subs;
							$faculty[$i] = $facs;
							$i++;
						}
					}
				}
				
				$init_val = "0";
				for($j=0;$j<$i;$j++){
					$query = "INSERT INTO `ques`(`feed_id`,`fid`,`br_code`,`year`,`sem`,`regulation`,`cr_code`,`sid`, `qs1`, `qs2`, `qs3`, `qs4`, `qs5`, `qs6`, `qs7`, `qs8`, `qs9`, `qs10`, `qs11`, `qs12`, `qs13`, `qs14`, `avg`, `count`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
					if ($stmt = $this->myconn->prepare($query)) {
						$stmt->bind_param("dsssssssssssssssssssssss",$feed_id,$faculty[$j],$brc[$j],$yr[$j],$sem[$j],$reg[$j],$cr[$j],$sub[$j],$init_val,$init_val,$init_val,$init_val,$init_val,$init_val,$init_val,$init_val,$init_val,$init_val,$init_val,$init_val,$init_val,$init_val,$init_val,$init_val);
						
						if($stmt->execute()){
							if($this->myconn->affected_rows){
								$insres++;
							}
						}
					}
				}/*loop close*/
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
		
		public function insertcmnt($fname,$sub,$st,$cmt,$feed_id){
			$ins = 0;
			if($this->myerr==0 && !empty($this->myconn)){
				
				$query = "INSERT INTO `comments`(`feed_id`, `fname`, `subject`, `stid`, `cmnt`) VALUES (?,?,?,?,?)";
				if ($stmt = $this->myconn->prepare($query)) {
					$stmt->bind_param("dssss",$feed_id,$fname,$sub,$st,$cmt);
					
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
			$otp_stat = 0;
			
			if($this->myerr==0 && !empty($this->myconn)){
				if($stmt=$this->myconn->prepare("INSERT INTO `fac_login`(`branch`, `fname`,`br_code`, `fuser`, `fpass`,`privilege`,`email`,`otp_status`) VALUES (?,?,?,?,?,?,?,?)")){
					$stmt->bind_param("sssssssd",$branch,$fname,$br_code,$fuser,$fpass,$privilege,$email,$otp_stat);
					
					
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
		

		public function delSubFac($subfacid)
		{
			$val=0;
			if($this->myerr==0 && !empty($this->myconn)){
				if($stmt=$this->myconn->prepare("DELETE FROM `fac_course` WHERE `id` = ?")){
					$stmt->bind_param("d",$subfacid);										
					if($stmt->execute()){						
						$val=1;
					}
				}
			}
			return $val;
		}


		public function delSub($subid)
		{
			$val=0;
			if($this->myerr==0 && !empty($this->myconn)){
				if($stmt=$this->myconn->prepare("DELETE FROM `subjects_2` WHERE `id` = ?")){
					$stmt->bind_param("d",$subid);										
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
		
		
		
		public function chngpwdSt($user,$pwd){
			$res=0;
			if($this->myerr==0 && !empty($this->myconn)){
				if($stmt=$this->myconn->prepare("UPDATE `st_login` SET `spass`=? WHERE `sid`=?")){
					$stmt->bind_param("ss",$pwd,$user);
					if($stmt->execute()){
						if($this->myconn->affected_rows){
							$res=1;
						}
					}
				}
			}
			return $res;
		}
		
		
		
		
		// subjects and faculty 
		
		public function getSubFac($reg,$cr,$br,$yr,$sem){
			$res = array();
			if($this->myerr==0 && !empty($this->myconn)){
				if ($stmt = $this->myconn->prepare("SELECT  `subject`, `fname` FROM `fac_course` WHERE `regulation`=? AND `cr_code`=? AND `br_code`=? AND `year`=? AND `sem`=?")) {
					$stmt->bind_param("sssss",$reg,$cr,$br,$yr,$sem);
					if($stmt->execute()){
						$stmt->bind_result($subs,$facs);
						$i = 0;
						while ($stmt->fetch()) {
							$res['faculty'][$i] = $facs;
							$res['subject'][$i] = $subs;
							$i++;
						}
						$res['ival'] = $i;
					}
				}
			}
			return $res;
		}


		public function getSubFacAjax($reg,$cr,$br,$yr,$sem){
			$res = array();
			if($this->myerr==0 && !empty($this->myconn)){
				if ($stmt = $this->myconn->prepare("SELECT  `id`, `subject`, `fname` FROM `fac_course` WHERE `regulation`=? AND `cr_code`=? AND `branch`=? AND `year`=? AND `sem`=?")) {
					$stmt->bind_param("sssss",$reg,$cr,$br,$yr,$sem);
					if($stmt->execute()){
						$stmt->bind_result($ids,$subs,$facs);
						$i = 0;
						while ($stmt->fetch()) {
							$res[$i]['id'] = $ids;
							$res[$i]['faculty'] = $facs;
							$res[$i]['subject'] = $subs;
							$i++;
						}
						$res['ival'] = $i;
					}
				}
			}
			return $res;
		}

		public function getSubsAjax($reg,$cr,$br,$yr,$sem){
			$res = array();
			if($this->myerr==0 && !empty($this->myconn)){
				if ($stmt = $this->myconn->prepare("SELECT  `id`, `sub` FROM `subjects_2` WHERE `regulation`=? AND `br_code`=? AND `branch`=? AND `year`=? AND `sem`=?")) {
					$stmt->bind_param("sssss",$reg,$cr,$br,$yr,$sem);
					if($stmt->execute()){
						$stmt->bind_result($ids,$subs);
						$i = 0;
						while ($stmt->fetch()) {
							$res[$i]['id'] = $ids;
							$res[$i]['subject'] = $subs;
							$i++;
						}
						$res['ival'] = $i;
					}
				}
			}
			return $res;
		}

		
		public function stopActivation($id,$br){
			$res=0;
			$today = date("Y-m-d\TH:i",time()-100);
			
			if($this->myerr==0 && !empty($this->myconn)){
				if($stmt=$this->myconn->prepare("UPDATE `activation` SET `to_date`=? WHERE `id`=? and `branch`=?")){
					$stmt->bind_param("sds",$today,$id,$br);
					if($stmt->execute()){
						if($this->myconn->affected_rows){
							$res=1;
						}
					}
				}
			}
			return $res;
		}
		
		
		public function clearFeedback(){
			$res = 0;
			if($this->myerr==0 && !empty($this->myconn)){
				if ($stmt = $this->myconn->prepare("truncate ques")) {
					
					if($stmt->execute()){
						$res++;
					}
				}
				if ($stmt = $this->myconn->prepare("truncate activation")) {
					
					if($stmt->execute()){
						$res++;
					}
				}
				if ($stmt = $this->myconn->prepare("truncate comments")) {
					
					if($stmt->execute()){
						$res++;
					}
				}
				if ($stmt = $this->myconn->prepare("truncate feedsSubmitted")) {
					
					if($stmt->execute()){
						$res++;
					}
				}	   
			}
			return $res;
		}
		
		
		public function clsWise($cr,$br,$yr,$sem,$reg,$feedid){
			$res = array();
			$res['status'] = 0;
			
			
			if($this->myerr==0 && !empty($this->myconn)){
				$query = "SELECT  `fid`, `sid`, `qs1`, `qs2`, `qs3`, `qs4`, `qs5`, `qs6`, `qs7`, `qs8`, `qs9`, `qs10`, `qs11`, `qs12`, `qs13`, `qs14`, `avg`, `count` FROM `ques` WHERE `cr_code`=? AND `br_code`=? AND `year`=? AND `sem`=? AND `regulation`=? AND `feed_id`=?";
				if ($stmt = $this->myconn->prepare($query)) {
					$stmt->bind_param("ssssss",$cr,$br,$yr,$sem,$reg,$feedid);
					
					if($stmt->execute()){
						/* bind result variables */
						$stmt->bind_result($fid,$sid,$q1,$q2,$q3,$q4,$q5,$q6,$q7,$q8,$q9,$q10,$q11,$q12,$q13,$q14,$avg,$c);
						$i = 0;
						while ($stmt->fetch()) {
							$res[$i]['fid']=$fid;
							$res[$i]['sid']=$sid;				
							$res[$i]['qs1']=$q1;
							$res[$i]['qs2']=$q2;
							$res[$i]['qs3']=$q3;
							$res[$i]['qs4']=$q4;
							$res[$i]['qs5']=$q5;
							$res[$i]['qs6']=$q6;
							$res[$i]['qs7']=$q7;
							$res[$i]['qs8']=$q8;
							$res[$i]['qs9']=$q9;
							$res[$i]['qs10']=$q10;
							$res[$i]['qs11']=$q11;
							$res[$i]['qs12']=$q12;
							$res[$i]['qs13']=$q13;
							$res[$i]['qs14']=$q14;
							$res[$i]['avg'] = $avg;
							$res[$i]['count']=$c;
							$res['status'] = 1;
							$i++;
						}/*while loop close*/
						$res['ival'] = $i;
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
