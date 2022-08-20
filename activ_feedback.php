<?php
@session_start();
if(!empty($_SESSION['user']) && !empty($_SESSION['priv'])&& $_SESSION['priv']="hod"){

require('header.php');
 require('cgs.php');
 $cgs_obj = new CGS;
 $reg=$cgs_obj->getReg1();
 $brcs = $cgs_obj->getBrSpecs($_SESSION['branch']);

?>


<script src="jquery-1.12.4.js"></script>
  <script src="jquery-ui.js"></script>
  <script src="js/jquery-3.1.1.min.js"></script>
<h3>Welcome <?php echo $_SESSION['user'];?></h3>
<div class="container-fluid">
    <div class="row row-offcanvas row-offcanvas-left">

              <div class="col-xs-12 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
                <div class="list-group">
                  <?php
                    $menu_id = 8;
                    require_once("menu.php");
                  ?>
                </div>
              </div><!--/span-->

              <div class="col-xs-12 col-sm-9">
			  
			  <div class="row">
	    <div class="col-md-2">&nbsp;
		</div>
		 <div class="col-md-6">
		 
		 <?php
			if(!empty($_GET['msg']) && $_GET['msg']=='feedback_activated'){
				echo "<div class='alert alert-success'>Feedback Activated Successfully</div>";
			}
			else if(!empty($_GET['msg']) && $_GET['msg']=='feedback_not_activated'){
				echo "<div class='alert alert-danger'>Feedback Not Activated..!</div>";
			}else if(!empty($_GET['msg']) && $_GET['msg']=='feedback_exists'){
				echo "<div class='alert alert-warning'>Feedback Exists..!</div>";
			}else if(!empty($_GET['msg']) && $_GET['msg']=='start_end_time_error'){
				echo "<div class='alert alert-warning'>From DateTime Value > To DateTime Value..!</div>";
			}else if(!empty($_GET['msg']) && $_GET['msg']=='end_time_error'){
				echo "<div class='alert alert-warning'>To DateTime Value is Invalid/Expired..!</div>";
			}

		 ?>
		 <div class="panel panel-primary">
  <div class="panel-heading">Select The Following</div>
  <div class="panel-body">

	   <form class="form-signin" role="form" action="active.php" method="post">
		<br><b>Select Branch: </b> &emsp;<select name="course" id="cr" required>
		<?php
			if(!empty($brcs['ival']) && $brcs['ival']>0){
				for($i=0;$i<$brcs['ival'];$i++){
					echo '<option value="'.$brcs[$i]['cr_br'].'">'.$brcs[$i]['spec'].'</option>';					
				}
			}
		?>
    </select>
	        <br />
		   <br/><b>Select Regulation: &emsp;</b>&emsp;<select name="regulation" id="reg" required>
					<option value="">--Select--</option>
					<?php
					foreach($reg as $item){
					?>
					<option value="<?php echo strtolower($item); ?>"><?php echo $item; ?></option>
					
					<?php
					}
					?></select>
		<br /><br><b>Select year: </b> &emsp;&emsp; &emsp; &emsp;<select name="year" id="yr" required>
         <option value="">--SELECT--</option>
         <option value="I">I</option>
         <option value="II">II</option>
         <option value="III">III</option>
         <option value="IV">IV</option>
    </select>
    
		<br><br><b>Select Semester:</b>&emsp; &emsp;<select name="sem" id="sm" required>
         <option value="">--SELECT--</option>
         <option value="I">I</option>
         <option value="II">II</option>
         </select><br/><br/>
	
            <b> From date & time: &emsp;</b><input type="datetime-local" name="fdate" required><br /><br />
            <b> To date & time: &emsp; &emsp;</b><input type="datetime-local" name="tdate" required><br />
 
	    <br/><br/><button class="btn btn-md btn-primary btn-block" type="submit">Activate</button>
		</div>
		</div>
		</div>
		 <div class="col-md-2">&nbsp;</div>
		 
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

