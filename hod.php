<?php
@session_start();
if(!empty($_SESSION['user']) && !empty($_SESSION['priv'])&& $_SESSION['priv']="hod"){
 $fac = $_SESSION['user'];
 
 require('header.php');
 require('cgs.php');
 $cgs_obj = new CGS;
 $res = $cgs_obj->getbr($fac);
 //echo $res['brcode'];
 $_SESSION['br'] = $res['brcode'];
$cgs_obj1 = new CGS;
		$faculty = $cgs_obj1->getF($res['brcode']);

?>
<script src="jquery-1.12.4.js"></script>
  <script src="jquery-ui.js"></script>
  <script src="js/jquery-3.1.1.min.js"></script>
<h3>Welcome <?php echo $_SESSION['user'].$_SESSION['branch'];?></h3>
<div class="container-fluid">
    <div class= "row row-offcanvas row-offcanvas-left">

              <div class="col-xs-12 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
                <div class="list-group">
                  <?php
                    $menu_id = 1;
                   require_once("menu.php");
                  ?>
                </div>
              </div><!--/span-->

              <div class="col-xs-12 col-sm-9">
			  
			  <div class="row">
	    <div class="col-md-2">&nbsp;
		</div>
		 <div class="col-md-6">
		 <div class="panel panel-primary">
  <div class="panel-heading">Select The Following</div>
  <div class="panel-body">

	   <form class="form-signin" role="form" action="rpt.php" method="post">
	   
	    <br/>Select Faculty Name &emsp;:&emsp;<select name="fname" id="fac" required>
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
	Select subject &emsp;&emsp;&emsp;&emsp;:&emsp;<select name="sub" id="subj" required>
                      <option value="">--select--</option>

                    </select>
	
	    <br/><br/><button class="btn btn-md btn-primary btn-block" type="submit">Get Feedback</button>
		</div>
		</div>
		</div>
		 <div class="col-md-2">&nbsp;</div>
		 
		 </div>
			   
              </div>
    </div>

</div>

<script>

  $(function(){
    $("#fac").change(
	
      function(){
        var faculty = $("#fac").val();
		if(1){
        $.ajax({
          url:"ajget.php",
          method:"post",
          data:{fid:faculty},
          dataType:"text",
          success:function(data){
            $("#subj").html(data);
          }
        });

        
		}

else{
  $("#subj").html("<option>--select--</option>");
 
}

    });
  });

</script>


<?php
          require('footer.php');

}
else {
  header('Location: index.php');
}