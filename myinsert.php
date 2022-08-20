<?php

$fname = "Mr.K.Sravan Kumar";
$sub_name = "Computer Networks-ECE";
$br = "04";
$yr="IV";
$sem = "I";
$reg = "15";
$cr = "A";
$feed_id = "47";
$user = "test";
 require('cgs.php');
				$cgs_obj = new CGS;
				$res = $cgs_obj->getFdetails($fname,$sub_name,$br,$yr,$sem,$reg,$cr,$feed_id,$user);
				
					$tid=$fname;
					$subid=$sub_name;
					$q11=6+$res['qs1'];
					$q21=6+$res['qs2'];
					$q31=6+$res['qs3'];
					$q41=6+$res['qs4'];
					$q51=6+$res['qs5'];
					$q61=6+$res['qs6'];
					$q71=6+$res['qs7'];
					$q81=6+$res['qs8'];
					$q91=6+$res['qs9'];
					$q101=6+$res['qs10'];
					$q111=6+$res['qs11'];
					$q121=6+$res['qs12'];
					$q131=6+$res['qs13'];
					$q141=6+$res['qs14'];
					$ttl = $q11+$q21+$q31+$q41+$q51+$q61+$q71+$q81+$q91+$q101+$q111+$q121+$q131+$q141;
					
					$ct=++$res['count'];
					$avg = ($ttl/(14*$ct));
				

					 $cgs_obj1 = new CGS;
					
					$insres = $cgs_obj1->updateData($tid,$br,$yr,$sem,$reg,$cr,$subid,$q11,$q21,$q31,$q41,$q51,$q61,$q71,$q81,$q91,$q101,$q111,$q121,$q131,$q141,$avg,$ct,$feed_id,$user);

					if($insres)
					{
						echo "ok";
						
					}
					else{
						
						echo "data not inserted";
					}


 ?>