<?php

//	 date_default_timezone_set("Asia/Kolkata");
	 $today = date("Y-m-d\TH:i");
	 echo $today;
	 echo date_default_timezone_get ();

	 date_default_timezone_set('Asia/Kolkata'); 

$dt2=date("Y-m-d H:i:s");
echo $dt2;

echo date_default_timezone_get ();
phpinfo();
?>