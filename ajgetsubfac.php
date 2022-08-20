<?php
	require_once('cgs.php');
	
	$obj= new CGS();
	
	if(!empty($_POST['regulation'])&&!empty($_POST['branch'])&&!empty($_POST['course'])&&!empty($_POST['year'])&&!empty($_POST['sem'])){
		
		$res = $obj->getSubFacAjax($_POST['regulation'],$_POST['course'],$_POST['branch'],$_POST['year'],$_POST['sem']);
		
		if(!empty($res['ival'])){
			echo "<table class='table table-striped'>";
			for($i=0;$i<$res['ival'];$i++){
				echo "<tr><td>".$res[$i]['subject']."</td><td>".$res[$i]['faculty']."</td><td><form action='fac_course.php' method='post'><input type='hidden' name='subfacid' value='".$res[$i]['id']."' /><input type='submit' name='delsubfac' class='btn btn-danger' value=' X ' /></form></td></tr>";
			}
			echo "</table>";
		}
	}
?>