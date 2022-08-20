<?php
@session_start();
if(!empty($_SESSION['user']) && !empty($_SESSION['priv'])){
 $uid= $_SESSION['user'];
 
 require_once('header.php');
 if(!empty($_POST['cpwd'])&& !empty($_POST['npwd1']) && !empty($_POST['npwd2']))
 {
	 if($_POST['npwd1'] == $_POST['npwd2'])
	 {
		 require_once('cgs.php');
		 $cgs_obj = new CGS;
		 $stat=1;
		 $res = $cgs_obj->insertOtp($uid,$_POST['npwd1'],$stat);
		 if($res==1 && $_SESSION['priv']=='student')
		 {
		 
			header('Location:form.php?msg="password changed"');
		
		 }
		 else if($res==2 && $_SESSION['priv']=='staff')
		 {
			$msg = "pwd_chngd";
		 	//header('Location:staff1.php?msg="password changed"');
		 }
		  else if($res==2 && ($_SESSION['priv']=='hod' || $_SESSION['priv']=='admin'))
		 {
		  
		 	header('Location:admin.php?msg="password changed"');
		 }
		 else{
			$msg = "pwd_not_chngd";
			 
		 }

		 
	 }
	 else{
		 $msg = "pwd_mismatch"; 
	 }
 }
// require('cgs.php');
 //$cgs_obj = new CGS;
 //$res = $cgs_obj->getbr($fac);
//$cgs_obj1 = new CGS;
	//$faculty = $cgs_obj1->getF($res['brcode']);

?>
<h3>Welcome <?php echo $_SESSION['user']?></h3>
<div class="container-fluid">
    <div class="row row-offcanvas row-offcanvas-left">

              <div class="col-xs-12 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
                <div class="list-group">
                  <?php
				  if($_SESSION['priv']=="hod")
				  {
                    $menu_id = 4;
                                       //require_once("submenu.php");
					require_once("menu.php");

					}
					else if($_SESSION['priv']=="staff"){
					$menu_id=2;
					require_once("menu1.php");
					}
					else if($_SESSION['priv']=="student"){
					$menu_id=2;
					require_once("menu2.php");
					}
                  ?>
                </div>
              </div><!--/span-->

              <div class= "col-xs-12 col-sm-9">
			  
			  <div class= "row">
	    <div class="col-md-2">&nbsp;
		</div>
		 <div class= "col-md-6">
		 <div class= "panel panel-primary">
  <div class="panel-heading">Change Password</div>
  <div class= "panel-body">

	   <form class="form-signin" role="form" action="#.php" method="post">
	   
	   <b>Current Password&emsp;:&emsp;</b><input type="password" name="cpwd" required><br/></br>
	   <b>Enter New Password&emsp;:&emsp;</b><input type="password" name="npwd1" required><br/></br>
	   <b>Re-enter New Password&emsp;:&emsp;</b><input type="password" name="npwd2" required>
	


	
	    <br/><br/><button class="btn btn-md btn-primary btn-block"type="submit">Go</button>
		<?php 
		if($msg=="pwd_chngd"){
			echo '<br /><div class="alert alert-success" role="alert">Password Changed Successfully..!</div>';
		}
		if($msg=="pwd_not_chngd"){
			echo '<br /><div class="alert alert-danger" role="alert">Password NOT Changed..!</div>';
		}
		if($msg=="pwd_mismatch"){
			echo '<br /><div class="alert alert-danger" role="alert">Re-enter Password Mismatch..!</div>';
		}		
		?>
		</div>
		</div>
		</div>
		 <div class="col-md-1">&nbsp;</div>
		 
		 </div>
			   
              </div>
    </div>

</div>




<?php
          require('footer.php');

}
else {
  header('Location: index.php');
}
?>