<?php
@session_start();
if(!empty($_SESSION['user']) && !empty($_SESSION['priv'])&& $_SESSION['priv']="hod"){

require('header.php');
 require('cgs.php');
 $cgs_obj = new CGS;
 $dep  = $cgs_obj->getdep($_SESSION['user']);
 $cgs_obj1=new CGS;
 $reg=$cgs_obj1->getReg1();
 
 if(!empty($_POST['updfeed']) && $_POST['updfeed']=="stop" && !empty($_POST['feed_id']) && !empty($_POST['br_code'])){
	$stopfeed = $cgs_obj1->stopActivation($_POST['feed_id'],$_POST['br_code']);
	if($stopfeed==1){
		$msg = "<div class='alert alert-success'>Feedback Deactivated..!</div>";
	}else{
		
	}
 }
 $feeds = $cgs_obj1->getActivationByBr($_SESSION['branch']);

?>


  <script src="js/jquery-3.1.1.min.js"></script>
<h3>Welcome <?php echo $_SESSION['user'];?></h3>
<div class="container-fluid">
    <div class="row row-offcanvas row-offcanvas-left">

              <div class="col-xs-12 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
                <div class="list-group">
                  <?php
                    $menu_id = 88;
                    require_once("menu.php");
                  ?>
                </div>
              </div><!--/span-->

              <div class="col-xs-12 col-sm-9">
				
				<?php
			if($_SESSION['user']=="admin" || strtolower($_SESSION['user'])=="administrator"){				
				echo "<h4>Selected Department: &emsp;";
				if(!empty($_SESSION['branch']) && $_SESSION['branch']=="all"){
					echo "None";
				}else{
					echo $_SESSION['branch'];
				}
				echo "</h4>";
			}
					require_once('cr_codes.php');
					if(!empty($feeds['ival']) && $feeds['ival']>0){
						if(!empty($msg)){
							echo $msg;
						}
						date_default_timezone_set("Asia/Kolkata");
						$today = date("Y-m-d\TH:i",time());

						echo "<table class='table'>";
						echo "<tr><th>Course</th><th>Regulation</th><th>Year</th><th>Sem</th><th>Start Time</th><th>End Time</th><th>Status</th></tr>";
						for($i=0;$i<$feeds['ival'];$i++){
							if(!empty($cr_name[$feeds[$i]['cr']])){
								$cr = $cr_name[$feeds[$i]['cr']];
							}else{
								$cr = $feeds[$i]['cr'];
							}
							
							if(!empty($feeds[$i]['fd']) && !empty($feeds[$i]['td']) && $today>=$feeds[$i]['fd'] && $today<=$feeds[$i]['td']){
								$stat = '<div class="row"><div class="col-sm-6"><span class="text-success">Active</span></div><div class="col-sm-6"><form action="show_activ_feedback.php" method="post"><input type="hidden" name="br_code" value="'.$feeds[$i]['brc'].'" /><input type="hidden" name="feed_id" value="'.$feeds[$i]['feed_id'].'" /><input type="submit" class="btn btn-sm btn-danger" name="updfeed" value="stop" /></div></div></form>';
							}else{
								$stat = '<span class="text-default">Completed</span>';
							}
							echo "<tr><td>".$cr."</td><td>".$feeds[$i]['reg']."</td><td>".$feeds[$i]['yr']."</td><td>".$feeds[$i]['sem']."</td><td>".$feeds[$i]['fd']."</td><td>".$feeds[$i]['td']."</td><td>".$stat."</td></tr>";
						}
						echo "</table>";
					}else{
						echo "<h4>No Feebdacks yet..!</h4>";
					}
				?>
			   
              </div>
    </div>

</div>

<?php
          require('footer.php');

}
else {
  header('Location: index.php');
}

