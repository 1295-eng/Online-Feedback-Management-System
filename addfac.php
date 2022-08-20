<?php
@session_start();
if(!empty($_SESSION['user']) && !empty($_SESSION['priv'])&& $_SESSION['priv']="hod"){
 $fac = $_SESSION['user'];
 //echo $fac;
 require('header.php');
 require('cgs.php');
 $cgs_obj = new CGS;
 $dep  = $cgs_obj->getdep($_SESSION['user']);
 /*require('cgs.php');
if(!empty($_POST['fname']) && $_POST['sub'])
{
	
	$cgs_obj2 = new CGS;
        $res1 = $cgs_obj2->selectd($_POST['fname'],$_POST['sub']);
}*/
?>
<h3>Welcome <?php echo $_SESSION['user'].$_SESSION['branch'];?></h3>

<div class="container-fluid">
    <div class="row row-offcanvas row-offcanvas-left">

              <div class="col-xs-12 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
                <div class="list-group">
                  <?php
                    $menu_id = 2;
                    require_once("menu.php");
                  ?>
                </div>
              </div><!--/span-->

              <div class= "col-xs-12 col-sm-9">
			  
					
			  
				<div class= "row">
	    <div class="col-md-2">&nbsp;
		</div>
		 <div class= "col-md-5">
		 <div class= "panel panel-primary">
  <div class="panel-heading">Add Faculty Name</div>
  <div class= "panel-body">

	   <form class="form-signin" role="form" action="addfac1.php" method="post">
	   </select>
	   <b>Department : </b> &emsp;&emsp;<select name="branch" id="dep" style="width:100px" required>
					<option value="<?php echo $dep;?>"><?php echo $dep; ?></option></select>
	    <!--<div class="form-group"><label> Department :</label><br /><input type="text" name="branch" required></div>-->
		<br /><br /> <div class="form-group"><label> Faculty Name :</label><br /><input type="text" name="fname" required></div>
		<?php
			if($dep=="CSE"){
				$br = "05";
			}elseif($dep=="ECE"){
				$br = "04";
			}elseif($dep=="EEE"){
				$br = "02";
			}elseif($dep=="MECH"){
				$br = "03";
			}elseif($dep=="CIVIL"){
				$br = "01";
			}elseif($dep=="CHEMICAL"){
				$br = "08";
			}
		?>
		 <div class="form-group"><label> Department Code:</label><br /><input type="text" name="br_code" required value="<?php if(!empty($br)){ echo $br; } ?>"></div>
          <div class="form-group"><label> Faculty Password: </label><br /><input type="password" name="fpass" required></div>
           <div class="form-group"><label> Faculty Email :</label><br /><input type="text" name="email" value="no" required></div>
	       <div class="form-group"><label> Faculty Privilege :</label><br /><input type="text" name="privilege" value="staff" required readonly></div>
	    <br/><br/><button class="btn btn-md btn-primary btn-block" type="submit">ADD</button>
		</div>
		</div>
		<?php
			if(!empty($_GET['msg'])){
				if($_GET['msg']=="success"){
					echo "<div class='alert alert-success'>Added Successfully..!</div>";
				}
			}
		?>
		</div>
		 <div class="col-md-2">&nbsp;</div>
			  
			  
			  
			  
			  
			
				</div>

</div>
</div>




<?php
          require('footer.php');

}
else {
  header('Location: index.php');
}