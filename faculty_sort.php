<?php 
@session_start();
if(!empty($_SESSION['user']) && !empty($_SESSION['priv'])&& ($_SESSION['priv']="admin")){

	require('header.php');
	?>
	<div class="col-xs-12 col-sm-3 sidebar-offcanvas dontprint" id="sidebar" role="navigation">
					<div class="list-group">
	<?php 
		$menu_id = 555;
		require_once('menu.php');
	?>
					</div>
	</div>

	<div class="col-xs-12 col-sm-9">
				  
				  <div class="row">
				<?php
				if($_SESSION['user']=="admin" || strtolower($_SESSION['user'])=="administrator"){
					echo "<h4>Selected Department: &emsp;";
					if(!empty($_SESSION['branch']) && $_SESSION['branch']=="all"){
						echo "None";
					}else{
						echo $_SESSION['branch'];
					}
					echo "</h4>";				
					require_once('cgs.php');
					$cg = new CGS();
					$a = $cg->getFacultyByBranch($_SESSION['br_code']);
					
					if(!empty($a['ival']) && $a['ival']>0){						
						echo "<table class='table table-hover table-bordered'>";
						echo "<tr><th>S.No.</th><th>Name of the Faculty</th><th>Average</th></tr>";						
						for($i=0;$i<$a['ival'];$i++){
							echo "<tr><td>".($i+1)."</td><td>".$a[$i]['fid']."</td><td>".round($a[$i]['avg'],2)."</td></tr>";
						}
						echo "</table>";
					}else{
						echo "Faculty Data Not Found..!";
					}
				?>							
				<?php } ?>
				<br/><br/>
				  </div>  </div>
	<?php 
	require('footer.php');
}
?>