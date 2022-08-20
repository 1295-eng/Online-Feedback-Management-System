<?php
if(!empty($_POST['reg']))
{
 
 require('header.php');
 require('cgs.php');
        $cgs_obj1 = new CGS;
$course = $cgs_obj1->getC($_POST['reg']);
	
?>

<div class="container-fluid">
    <div class="row row-offcanvas row-offcanvas-left">

             <!-- <div class="col-xs-12 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
                <div class="list-group">
                  <?php
                    $menu_id = 6;
                    require_once("menu.php");
                  ?>
                </div>
              </div> -->

              <div class="col-xs-12 col-sm-9">
			  
			  <div class="row">
	    <div class="col-md-2">&nbsp;
		</div>
		 <div class="col-md-5">
		 <div class="panel panel-primary">
  <div class="panel-heading">Remove Course</div>
  <div class="panel-body">

<form class="form-signin" role="form" action="delcourse2.php" method="post">
  
<br/>Select Course Name :<select name="cname" id="c">
					<option value="">--Select--</option>
        <?php
        // A sample product array
       
        
        // Iterating through the product array
        foreach($course as $item){
        ?>
        <option value="<?php echo strtolower($item); ?>"><?php echo $item; ?></option>
        <?php
        }
        ?>
		
    </select><br/><br/>
	
	    <br/><br/><button class="btn btn-md btn-primary btn-block" type="submit">Delete</button>
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