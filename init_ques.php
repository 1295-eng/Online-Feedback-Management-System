<?php
 	require('cgs.php');
  	$cgs_obj = new CGS;
  	$res = $cgs_obj->insertInitData();
	echo $res;
?>