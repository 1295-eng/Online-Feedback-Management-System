<?php
	require_once('cgs.php');
	
	$obj= new CGS();
	
	if(!empty($_POST['regulation'])&&!empty($_POST['branch'])&&!empty($_POST['course'])&&!empty($_POST['year'])&&!empty($_POST['sem'])){
			$br = explode('_',$_POST['course']);
		$res = $obj->getSubsAjax($_POST['regulation'],$br[0],$_POST['branch'],$_POST['year'],$_POST['sem']);

		if(!empty($res['ival'])){
			echo "<table class='table table-striped'>";
			for($i=0;$i<$res['ival'];$i++){
				echo "<tr><td>".($i+1)."</td><td>".$res[$i]['subject']."</td><td><form action='subjects.php' method='post'><input type='hidden' name='subid' value='".$res[$i]['id']."' /><input type='submit' name='delsub' class='btn btn-danger' value=' X ' /></form></td></tr>";
			}
			echo "</table>";
		}
	}
?>