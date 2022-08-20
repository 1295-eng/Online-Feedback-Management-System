<?php 
@session_start();
if(!empty($_SESSION['user']) && !empty($_SESSION['priv'])&& ($_SESSION['priv']="hod" || $_SESSION['priv']="admin")){

require('header.php');
?>
<div class="col-xs-12 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
                <div class="list-group">
<?php 
$menu_id = 4444;
require_once('menu.php');


?>

</div>
</div>
<div class="col-xs-12 col-sm-9">
			  
			  <div class="row">
			<?php
			if($_SESSION['user']=="admin" || strtolower($_SESSION['user'])=="administrator"){
				$dts = 0;
				if(!empty($_POST)){
					require_once('cgs.php');
					$cg = new CGS();
					if(!empty($_POST['roll'])){
						$_POST['roll'] = strtoupper($_POST['roll']);
						$a = $cg->getStDetails($_POST['roll']);
						if(!empty($a['status']) && $a['status']==1){
							$dts = 1;
						}else if(!empty($a['status']) && $a['status']==2){
							$msg = 'pwd_ok';
						}else{
							$msg = 'no_roll';
						}
					}else if(!empty($_POST['resetroll'])){
						$b = $cg->chngpwdSt($_POST['resetroll'],$_POST['resetroll']);
						if($b>0){
							$msg = "pwd_chngd";
						}else{
							$msg = 'pwd_not_chngd';
						}
					}
				}
			} ?>
 			<br/><br/>
			<div class= "row">
				<div class="col-md-2">&nbsp;</div>
				<div class= "col-md-6">
					<div class= "panel panel-primary">
					  <div class="panel-heading">Reset Student Password</div>
					  <div class= "panel-body">
							<?php
							if($dts==1 && !empty($a['email'])){ ?>
							<form class="form-signin" role="form" action="pwdreset.php" method="post">
							<b>UserName/Roll_No&emsp;:&emsp;</b><?php echo $_POST['roll'];?><input type="hidden" name="resetroll" value="<?php echo $_POST['roll'];?>"><br/>
							<br/><b>Name/Email&emsp;:&emsp;</b><?php echo $a['email'];?>
							<br/><br/><button class="btn btn-md btn-success btn-block"type="submit">Reset Password</button>
							</form>
							<?php } else { ?>
							<form class="form-signin" role="form" action="pwdreset.php" method="post">
							<b>Enter UserName/Roll_No&emsp;:&emsp;</b><input type="text" name="roll" required><br/>
							<br/><br/><button class="btn btn-md btn-primary btn-block"type="submit">Get Details</button>
							</form>
							<?php 
							}
							
							if($msg=="pwd_chngd"){
								echo '<br /><div class="alert alert-success" role="alert">Password Changed Successfully..!</div>';
							}
							if($msg=="pwd_not_chngd"){
								echo '<br /><div class="alert alert-danger" role="alert">Password NOT Changed..!</div>';
							}
							if($msg=="no_roll"){
								echo '<br /><div class="alert alert-danger" role="alert">Student Details Not Found..!</div>';
							}		
							if($msg=="pwd_ok"){
								echo '<br /><div class="alert alert-success" role="alert">Password has been Reset Successfully..!</div>';
							}		
							?>
						</div>
					</div>
				</div>
				<div class="col-md-1">&nbsp;</div>		 
			</div>
		</div>
</div>
<?php 
require('footer.php');
}





?>