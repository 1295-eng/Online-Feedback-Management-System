<?php
/*@session_start();
if(!empty($_SESSION['user']) && !empty($_SESSION['priv'])&& $_SESSION['priv']="hod"){
 $fac = $_SESSION['user'];*/
 
 require('header.php');
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
                    $menu_id = 5;
                    require_once("menu.php");
                  ?>
                </div>
              </div><!--/span-->

              <div class= "col-xs-12 col-sm-9">
			  
					
			  
				<div class= "row">
	    <div class="col-md-2">&nbsp;
		</div>
		 <div class="col-md-5">
		 <div class="panel panel-primary">
  <div class="panel-heading">Add Course Name</div>
  <div class="panel-body">

	   <form class="form-signin" role="form" action="addcourse1.php" method="post">
	  
	     <div class="form-group"><label>Course Name:&emsp;&emsp;</label>      
          <input type="text" name="cname" required></div>
		 <div class="form-group"><label>Course Code:&emsp;&emsp;</label>  
         <input type="text" name="crcode" required></div>
		 <div class="form-group"><label>Regulation:&emsp;&emsp;&emsp;</label>   
         <input type="text" name="reg" required></div>
         <div class="form-group"><label> Year:&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</label> 
          <input type="text" name="year" required></div>
	     <div class="form-group"><label> Semester:&emsp;&emsp;&emsp;&emsp;</label> 
          <input type="text" name="sem" required></div>
	    <br/><br/><button class="btn btn-md btn-primary btn-block" type="submit">ADD</button>
		</div>
		</div>
		</div>
		 <div class="col-md-2">&nbsp;</div>
			  
			  
			  
			  
			  
			
				</div>

</div>
</div>




<?php
          require('footer.php');

//}
/*else {
  header('Location: index.php');
}*/