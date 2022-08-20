<?php
$k = 0;
 	require('cgs.php');
  	$cgs_obj = new CGS;
//  	$res = $cgs_obj->getAllQuesData();
//	var_dump($res);
/*	for($i=0;$i<$res['ival'];$i++){
		$res1 = $cgs_obj->getEachFdetails($res['fid'][$i],$res['brc'][$i],$res['yr'][$i],$res['sem'][$i],$res['reg'][$i],$res['crc'][$i]);
		if($res1['jval']<=2){
			echo $i." | ".$res['fid'][$i]." - ".$res1['jval']." - |~|";
			for($j=0;$j<$res1['jval'];$j++){
				echo $res1['sid'][$j]."|";
			}
			echo "~| <br>";
		}
		unset($res1);
	}
	
	
	echo $i." | ".$res['fid'][$i]." - ".$res1['jval']." - |~|";

		echo $res1['count'][0]."|".$res1['count'][1]."|".$ct;

	echo "|~| <br>";
	
*/	
	

	for($i=0;$i<$res['ival'];$i++){
		$res1 = $cgs_obj->getEachFdetails($res['fid'][$i],$res['brc'][$i],$res['yr'][$i],$res['sem'][$i],$res['reg'][$i],$res['crc'][$i]);

		if($res1['jval']==2){

			$q1 = $res1['qs1'][0] + $res1['qs1'][1];
			$q2 = $res1['qs2'][0] + $res1['qs2'][1];
			$q3 = $res1['qs3'][0] + $res1['qs3'][1];
			$q4 = $res1['qs4'][0] + $res1['qs4'][1];
			$q5 = $res1['qs5'][0] + $res1['qs5'][1];
			$q6 = $res1['qs6'][0] + $res1['qs6'][1];
			$q7 = $res1['qs7'][0] + $res1['qs7'][1];
			$q8 = $res1['qs8'][0] + $res1['qs8'][1];
			$q9 = $res1['qs9'][0] + $res1['qs9'][1];
			$q10 = $res1['qs10'][0] + $res1['qs10'][1];
			$q11 = $res1['qs11'][0] + $res1['qs11'][1];
			$q12 = $res1['qs12'][0] + $res1['qs12'][1];
			$q13 = $res1['qs13'][0] + $res1['qs13'][1];
			$q14 = $res1['qs14'][0] + $res1['qs14'][1];

			$ttl = $q1 + $q2 + $q3 + $q4 + $q5 + $q6 + $q7 + $q8 + $q9 + $q10 + $q11 + $q12 + $q13 + $q14;
			$ct=$res1['count'][0] + $res1['count'][1];
			$avg = ($ttl/(14*$ct));
			
			if(strpos($res1['sid'][0],'-Select')>0 || strpos($res1['sid'][1],'-Select')>0){
				if(strpos($res1['sid'][0],'-Select')>0 && strpos($res1['sid'][1],'-Select')<1){
					$sub = $res1['sid'][1];
				//	echo "1".$sub;
				}
				else if(strpos($res1['sid'][1],'-Select')>0 && strpos($res1['sid'][0],'-Select')<1){
					$sub = $res1['sid'][0];
				//	echo "2".$sub;
				}
				else{
				//	echo "Not OK";
				}
			}else{
			//	echo "Not ok";
			}
			
			//echo "<br>";
			if(!empty($sub) && $ct>0 && $avg>0){
//				$res2 = $cgs_obj->updateErrData($res['fid'][$i],$res['brc'][$i],$res['yr'][$i],$res['sem'][$i],$res['reg'][$i],$res['crc'][$i],$sub,$q1,$q2,$q3,$q4,$q5,$q6,$q7,$q8,$q9,$q10,$q11,$q12,$q13,$q14,$avg,$ct);
/*				echo ++$k." | ".$res2;
				if($res2==0){
					echo 'Check this';
				}
				echo "<br>";*/
			}
			
		}
		else{
			if($res['fid'][$i]=="Dr.B.Omprakash"){
				$sub = "SEMINAR PROGRAM";
				echo $res1['sid'][0]."|".$res1['sid'][1]."|".$res1['sid'][2]."|";
//				if()
			}
				//echo "--------------------------------------".$res['fid'][$i]."----".$res['brc'][$i]."--------------<br>";
		}
		
		unset($res1);
	}



	

?>