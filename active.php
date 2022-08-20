<?php
@session_start();
if(!empty($_POST['regulation'])&&!empty($_POST['course'])&&!empty($_POST['year'])&&!empty($_POST['sem'])&&!empty($_POST['fdate'])&&!empty($_POST['tdate'])){
 $course = explode('_',$_POST['course']);
 if(!empty($course[0]) && !empty($course[1])){
	 $cr = $course[0];
	 $br = $course[1];
	require('cgs.php');
	 $obj = new CGS;
	 $res1= $obj->getActivation($_POST['regulation'],$cr,$br,$_POST['year'],$_POST['sem']);
	 date_default_timezone_set("Asia/Kolkata");
	 $today = date("Y-m-d\TH:i",time());

	 if(!empty($res1['fd']) && !empty($res1['td']) && $today>=$res1['fd'] && $today<=$res1['td']){
		header('Location:activ_feedback.php?msg=feedback_exists');
	 }else{
		if($_POST['fdate']>=$_POST['tdate']){
			header('Location:activ_feedback.php?msg=start_end_time_error');
		}else if($_POST['tdate']<=$today){
			
			header('Location:activ_feedback.php?msg=end_time_error'.$_POST['tdate'].'-'.$today);
		}else{			
			$res2= $obj->activation($_POST['regulation'],$cr,$br,$_POST['year'],$_POST['sem'],$_POST['fdate'],$_POST['tdate']);

			if($res2==1)
			{
				header('Location:activ_feedback.php?msg=feedback_activated');
			}
			else
			{
				header('Location:activ_feedback.php?msg=feedback_not_activated');
			}
		}
	 }
 }
 else
 { 
	header('Location:activ_feedback.php');
 }
	
}
else
{
	header('Location:activ_feedback.php');
}

?>