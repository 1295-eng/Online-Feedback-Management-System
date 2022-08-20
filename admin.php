<?php 
@session_start();
if(!empty($_SESSION['user']) && !empty($_SESSION['priv'])&& ($_SESSION['priv']="hod" || $_SESSION['priv']="admin")){

require('header.php');
?>
<div class="col-xs-12 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
                <div class="list-group">
<?php 
$menu_id = 10;
require_once('menu.php');


?>

</div>
</div>
<div class="col-xs-12 col-sm-9">
			  
			  <div class="row">
              
              <h4 align="center">Welcome Admin</h4>
              </div>
              </div>
			<?php
			if($_SESSION['user']=="admin" || strtolower($_SESSION['user'])=="administrator"){
			
			if(!empty($_POST)){
				if(!empty($_POST['dept'])){
					$br = explode("|",$_POST['dept']);
					$_SESSION['br_code'] = $br[0];
					$_SESSION['br'] = $br[0];
					$_SESSION['branch'] = $br[1];
				}
			}
				echo "<h4>Selected Department: &emsp;";
				if(!empty($_SESSION['branch']) && $_SESSION['branch']=="all"){
					echo "None";
				}else{
					echo $_SESSION['branch'];
				}
				echo "</h4>";
			?>
			
			<form action="admin.php" method="post">
				<select name="dept" required>
					<option value="">--Select Department--</option>
					<option value="01|CIVIL">CIVIL</option>
					<option value="02|EEE">EEE</option>
					<option value="03|MECH">MECH</option>
					<option value="04|ECE">ECE</option>
					<option value="05|CSE">CSE</option>
					<option value="27|FDT">FOOD TECH</option>
					
				</select>
				<input type="submit" name="deptchange" value="Change Department" />
			</form>
				
			<?php } ?>
<?php 
require('footer.php');
}





?>