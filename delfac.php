<?php
@session_start();
if(!empty($_SESSION['user']) && !empty($_SESSION['priv'])&& $_SESSION['priv']="hod"){
 
 require('header.php');
 require('cgs.php');
        $cgs_obj1 = new CGS;
		if(!empty($_POST['fname'])){
		$res = $cgs_obj1->delFac($_POST['fname']);
		if($res==1)
		{
			echo "<h3 style='color:orange'>Faculty Details deleted</h3>";
		}
		else{
			
			echo "<h3 style='color:orange'>Faculty details not deleted</h3>";
		}
 }
 $faculty = $cgs_obj1->getF($_SESSION['br']);

?>
<h3>Welcome <?php echo $_SESSION['user'].$_SESSION['branch'];?></h3>
<div class="container-fluid">
    <div class="row row-offcanvas row-offcanvas-left">

              <div class="col-xs-12 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
                <div class="list-group">
                  <?php
                    $menu_id = 4445;
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
  <div class="panel-heading">Remove Faculty</div>
  <div class="panel-body">

	   <form class="form-signin" role="form" action="#" method="post">
	   
	    <br/>Select Faculty Name :<select name="fname" id="fac">
					<option value="">--Select--</option>
        <?php
        // A sample product array
       
        
        // Iterating through the product array
        foreach($faculty as $item){
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