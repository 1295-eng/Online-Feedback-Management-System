<?php 
@session_start();
if(!empty($_SESSION['user']) && !empty($_SESSION['priv'])&& ($_SESSION['priv']="hod" || $_SESSION['priv']="admin")){

require('header.php');
?>
<div class="col-xs-12 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
                <div class="list-group">
<?php 
$menu_id = 444;
require_once('menu.php');


?>

</div>
</div>
<div class="col-xs-12 col-sm-9">
			  
			  <div class="row">
			<?php
			if($_SESSION['user']=="admin" || strtolower($_SESSION['user'])=="administrator"){
			
				if(!empty($_POST)){
					if(!empty($_POST['cleardata'])){
						require_once('cgs.php');
						$cg = new CGS();
						$a = $cg->clearFeedback();
						if($a>0){
							echo "<h4 class='text-danger'>Data Cleared..!</h4>";
						}
					}
				}
			?>
						
			<?php } ?>
 			<br/><br/>
				<form action="cleardata.php" method="post">
					<input type="submit" class='btn btn-danger' name="cleardata" value="Clear Data" />
				</form>
             
              </div>
              </div>
<?php 
require('footer.php');
}





?>