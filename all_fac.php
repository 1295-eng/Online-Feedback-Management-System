<?php
@session_start();
if(!empty($_SESSION['user']) && !empty($_SESSION['priv'])&& $_SESSION['priv']="hod"){
 $fac = $_SESSION['user'];
 
 require('header.php');

 require('cgs.php');
 $cgs_obj1=new CGS;
 $reg=$cgs_obj1->getReg1();
 $br_specs=$cgs_obj1->getBr1($_SESSION['branch']); 
 
?>
<script src="jquery-1.12.4.js"></script>
  <script src="jquery-ui.js"></script>
  <script src="js/jquery-3.1.1.min.js"></script>
<h3>Welcome <?php echo $_SESSION['user'];?></h3>
<div class= "container-fluid">
    <div class="row row-offcanvas row-offcanvas-left">

              <div class="col-xs-12 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
                <div class="list-group">
                  <?php
                    $menu_id = 12;
                                     //require_once("submenu.php");
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

	   <form class="form-signin" role="form" action="overall_report.php" method="post">
	   
	   <br/><b>Select Regulation </b>&emsp;&emsp;&emsp;<select name="regulation" id="reg1" required>
					<option value="">--SELECT--</option>
        <?php
        // A sample product array
      // Iterating through the product array
        foreach($reg as $item){
        ?>
        <option value="<?php if($item=="17"){ echo $item.'" selected'; } else { echo $item.'"'; } ?>><?php echo $item; ?></option>
        
        <?php
        }
        ?>
		</select>
        <br /><br><b>Select Program:</b> &emsp;&emsp;
		<select name="course" id="cr" required>
         <option value="">--SELECT--</option>
         <option value="A" selected>B.Tech</option>
         <option value="D">M.Tech</option>
    </select>
	
	
		   <br/><br><b>Select Specialization </b>&emsp;<select name="spec" id="spec1" required>
					<option value="">--SELECT--</option>
        <?php
        // A sample product array
      // Iterating through the product array
        foreach($br_specs as $item1){
			$item = explode("|",$item1);
			?>
			<option value="<?php echo ($item[0]); ?>"><?php echo $item[1]; ?></option>
			
			<?php
        }
        ?></select>
	
         <br /><br><b>Select year </b> &emsp; &emsp; &emsp;&emsp;&emsp;<select name="year" id="year" required>
         <option value="">--SELECT--</option>
         <option value="I" selected>I</option>
         <option value="II">II</option>
         <option value="III">III</option>
         <option value="IV">IV</option>
    </select>
    
		<br><br><b>Select Semester:</b> &emsp;&emsp;&emsp;<select name="sem" id="sm" required>
         <option value="">--SELECT--</option>
         <option value="I">I</option>
         <option value="II">II</option>
         </select>

		<br><br><b>Select Feedback Time:</b> &emsp;&emsp;&emsp;<select name="feedid" id="feedid" required>
         <option value="">--SELECT--</option>
         </select>
		 
	    <br/><br/><button class="btn btn-md btn-primary btn-block" type="submit">Get Report</button>
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

    $("#reg1").change(	
      function(){
		  $("#cr").val('');
		  $("#spec1").val('');
		 $("#year").val('');		  
		 $("#sm").val('');
	});	
	
    $("#cr").change(	
      function(){
		  $("#spec1").val('');
		 $("#year").val('');
		 $("#sm").val('');
	});	

    $("#spec1").change(	
      function(){
		 $("#year").val('');		  
		 $("#sm").val('');
	});	

    $("#year").change(	
      function(){
		 $("#sm").val('');
	});
	
	  
    $("#sm").change(	
      function(){
        var regs = $("#reg1").val();
		 var crs=$("#cr").val();
		 var specs=$("#spec1").val();
		 var yrs=$("#year").val();
		 var sems=$("#sm").val();		 
		if(1){
			$.ajax({
			  url:"ajaxgetfeeds.php",
			  method:"post",
			  data:{reg:regs,course:crs,spec:specs,year:yrs,sem:sems},
			  dataType:"text",
			  success:function(data){
				$("#feedid").html(data);
			  }
			});        
		}
		else{
		  $("#feedid").html("<option>--Select--</option>");
		 
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