<?php
@session_start();
if(!empty($_SESSION['user']) && !empty($_SESSION['priv'])&& $_SESSION['priv']="hod"){
 
 require('header.php');
 require('cgs.php');
        $cgs_obj1 = new CGS;
		$regulation=$cgs_obj1->getReg();
?>		
<h3>Welcome <?php echo $_SESSION['user'].$_SESSION['branch'];?></h3>
<div class="container-fluid">
    <div class="row row-offcanvas row-offcanvas-left">

              <div class="col-xs-12 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
                <div class="list-group">
                  <?php
                    $menu_id = 6;
                    require_once("menu.php");
                  ?>
                </div>
              </div><!--/span-->

              <div class="col-xs-12 col-sm-9">
			  
			  <div class="row">
	    <div class="col-md-2">&nbsp;
		</div>
		 <div class="col-md-5">
		 <div class="panel panel-primary">
  <div class="panel-heading">Remove Course</div>
  <div class="panel-body">

	   <form class="form-signin" role="form" action="delcourses1.php" method="post">
  
	   <br/> Select Regulation :<select name ="reg" id="r">
                  <option value="">--Select--</option>
           <?php
		    foreach($regulation as $it){
			?>
            <option value="<?php echo strtolower($it); ?>"><?php echo $it; ?></option>
            <?php
			}
			?>
            </select><br/><br/>
	    
	
	    <br/><br/><button class="btn btn-md btn-primary btn-block" type="submit">Get Courses</button>
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