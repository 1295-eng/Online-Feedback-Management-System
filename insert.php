<?php
@session_start();
if(!empty($_SESSION['user']) && !empty($_SESSION['priv']) && $_SESSION['priv']=="student" && !empty($_SESSION['reg']) && !empty($_SESSION['cr']) && !empty($_SESSION['br']) && !empty($_SESSION['yr']) && !empty($_SESSION['sem']) )
{
	require_once('cgs.php');
	$obj1=new CGS;
	$res1=$obj1->getActivation($_SESSION['reg'],$_SESSION['cr'],$_SESSION['br'],$_SESSION['yr'],$_SESSION['sem']);
	date_default_timezone_set("Asia/Kolkata");
	$today = date("Y-m-d\TH:i",time());		
	if(!empty($res1['fd']) && !empty($res1['td']) && $today>=$res1['fd'] && $today<=$res1['td']){
		
		$c=$_SESSION['count'];
		require('data.php');
		$subfac = explode('_',$_POST['subfac']);
		$fname = $subfac[0];
		$sub_name = $subfac[1];

		$res2=$obj1->getFeedsSubmitted($_SESSION['user'],$res1['feed_id']);
		if(!empty($res2['subjects']) && count($res2['subjects'])>0 && in_array($sub_name,$res2['subjects'])){			
		  header('Location: form.php');
		}
		else {
			
			if(!empty($fname) && !empty($sub_name))
			{
				require_once('cgs.php');
				//echo $fname." ".$sub_name;
				if(!empty($_POST['cmnt']))
				{
					$cgs_obj1 = new CGS;
				$ins = $cgs_obj1->insertcmnt($fname,$sub_name,$_SESSION['user'],$_POST['cmnt'],$res1['feed_id']);
					
				}
				$cgs_obj = new CGS;
				$res = $cgs_obj->getFdetails($fname,$sub_name,$br,$yr,$sem,$reg,$cr,$res1['feed_id']);
				
			if($res['status']==0)
			{
				$p=1;
				$p1=(int)$_POST['q1'];
				$p2=(int)$_POST['q2'];
				$p3=(int)$_POST['q3'];
				$p4=(int)$_POST['q4'];
				$p5=(int)$_POST['q5'];
				$p6=(int)$_POST['q6'];
				$p7=(int)$_POST['q7'];
				$p8=(int)$_POST['q8'];
				$p9=(int)$_POST['q9'];
				$p10=(int)$_POST['q10'];
				$p11=(int)$_POST['q11'];
				$p12=(int)$_POST['q12'];
				$p13=(int)$_POST['q13'];
				$p14=(int)$_POST['q14'];
				$av=($p1+$p2+$p3+$p4+$p5+$p6+$p7+$p8+$p9+$p10+$p11+$p12+$p13+$p14)/14;
				
				$cgs_obj2 = new CGS;
				$insres = $cgs_obj2->insertData($fname,$br,$yr,$sem,$reg,$cr,$sub_name,$p1,$p2,$p3,$p4,$p5,$p6,$p7,$p8,$p9,$p10,$p11,$p12,$p13,$p14,$av,$p,$res1['feed_id'],$_SESSION['user']);
				$str = $fname.",".$br.",".$yr.",".$sem.",".$reg.",".$cr.",".$sub_name.",".$p1.",".$p2.",".$p3.",".$p4.",".$p5.",".$p6.",".$p7.",".$p8.",".$p9.",".$p10.",".$p11.",".$p12.",".$p13.",".$p14.",".$av.",".$p.",".$res1['feed_id'].",".$_SESSION['user']."\n";
				file_put_contents("logs/ques.csv",$str,FILE_APPEND);
			}
			else{
							
					$val=0;
						for($j=1;$j<15;$j++){
							if(isset($_POST['q'.$j.'']))
						  $val=1;
							}
					if($val==1){

					$tid=$fname;
					$subid=$sub_name;
					$q11=$_POST['q1']+$res['qs1'];
					$q21=$_POST['q2']+$res['qs2'];
					$q31=$_POST['q3']+$res['qs3'];
					$q41=$_POST['q4']+$res['qs4'];
					$q51=$_POST['q5']+$res['qs5'];
					$q61=$_POST['q6']+$res['qs6'];
					$q71=$_POST['q7']+$res['qs7'];
					$q81=$_POST['q8']+$res['qs8'];
					$q91=$_POST['q9']+$res['qs9'];
					$q101=$_POST['q10']+$res['qs10'];
					$q111=$_POST['q11']+$res['qs11'];
					$q121=$_POST['q12']+$res['qs12'];
					$q131=$_POST['q13']+$res['qs13'];
					$q141=$_POST['q14']+$res['qs14'];
					$ttl = $q11+$q21+$q31+$q41+$q51+$q61+$q71+$q81+$q91+$q101+$q111+$q121+$q131+$q141;
					
					$ct=++$res['count'];
					$avg = ($ttl/(14*$ct));
					}

					 $cgs_obj1 = new CGS;
							$insres = $cgs_obj1->updateData($tid,$br,$yr,$sem,$reg,$cr,$subid,$q11,$q21,$q31,$q41,$q51,$q61,$q71,$q81,$q91,$q101,$q111,$q121,$q131,$q141,$avg,$ct,$res1['feed_id'],$_SESSION['user']);
							$str = $tid.",".$br.",".$yr.",".$sem.",".$reg.",".$cr.",".$subid.",".$q11.",".$q21.",".$q31.",".$q41.",".$q51.",".$q61.",".$q71.",".$q81.",".$q91.",".$q101.",".$q111.",".$q121.",".$q131.",".$q141.",".$avg.",".$ct.",".$res1['feed_id'].",".$_SESSION['user']."\n";
							file_put_contents("logs/ques_upd.csv",$str,FILE_APPEND);
		}
					if($insres)
					{
						++$_SESSION['count'];
						array_push($_SESSION['yes_sub'],$sub_name);
						//if($c=1 && $c<=5)
						//if($c<=12)
						header('Location:form.php');
						/*
						else{
							
							header('Location:logout.php?');
						}*/
						
					}
					else{
						
						echo "data not inserted";
					}

			}
			else {
			  header('Location: form.php');
			}
		}
		
	}
	else {
	  header('Location: logout.php?msg=feed_time_out');
	}

}
else {
  header('Location: index.php');
}


 ?>