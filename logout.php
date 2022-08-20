<?php
@session_start();
if(!empty($_SESSION['user']) && !empty($_SESSION['priv'])){
	require_once('cgs.php');
	$clear = new CGS;
$insres = $clear->delPass($_SESSION['user']);
   $obj = new CGS;
   $res=$obj->getFeed($_SESSION['user']);
	if($insres==0){
	  unset($_SESSION['user']);
	  unset($_SESSION['priv']);
	  unset($_SESSION['count']);
	}
	
	if(!empty($_SESSION['user'])){
	  unset($_SESSION['user']);
	}
	if(!empty($_SESSION['priv'])){
	  unset($_SESSION['priv']);
	}  
	if(!empty($_SESSION['count'])){
	  unset($_SESSION['count']);
	}

	if(!empty($_SESSION['yr'])){
		unset($_SESSION['yr']);
	}
	if(!empty($_SESSION['sem'])){
		unset($_SESSION['sem']);
	}
	if(!empty($_SESSION['reg'])){
		unset($_SESSION['reg']);
	}
	if(!empty($_SESSION['br'])){
		unset($_SESSION['br']);
	}
	if(!empty($_SESSION['cr'])){
		unset($_SESSION['cr']);
	}

  //require('header.php');

 if($res == 0){
 ?>
<script type='text/javascript'>
	alert('Thank you.You have successfully submitted your feedback.Feedback can be submitted only once.');
  	document.location.href = "index.php";	
	</script>;
<?php }
 else{ 
	if(!empty($_GET['msg']) && $_GET['msg']=='feed_time_out'){
	 ?>
	<script type='text/javascript'>
		alert('Feedback Time Expired..!');
		document.location.href = "index.php";	
		</script>;
	<?php }
	 ?>
   <script type='text/javascript'>
	alert('Feedback was not submitted.Please submit again.');
  	document.location.href = "index.php";	
	</script>;
<?php }
 

 }
?>      