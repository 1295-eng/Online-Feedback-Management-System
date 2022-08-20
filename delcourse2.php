<?php
	if(!empty($_POST['cname'])){
 require('cgs.php');
        $cgs_obj2 = new CGS;
		$res = $cgs_obj2->delCourse($_POST['cname']);
		if($res==1)
		{
			echo "<h3 style='color:orange'>Course deleted</h3>";
		}
		else{
			
			echo "<h3 style='color:orange'>Course is not deleted</h3>";
		}
 }
?>