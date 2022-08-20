<?php
	@session_start();
	if(!empty($_SESSION['user']) && !empty($_SESSION['priv'])&& $_SESSION['priv']="hod"){
		
		require_once('header.php');
		require_once('cgs.php');
		$cgs_obj = new CGS;
		$dep  = $cgs_obj->getdep($_SESSION['user']);
		$reg=$cgs_obj->getReg1();
		$br_specs=$cgs_obj->getBr2($_SESSION['branch']); 		
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
						$menu_id = 445;
						require_once("menu.php");
					?>
				</div>
			</div><!--/span-->
			
			<div class="col-xs-12 col-sm-9">
				<div class= "row">				
				<div class= "col-sm-6">
				<div class= "row">								
					<div class= "col-md-12">
						<div class= "panel panel-primary">
							<div class="panel-heading">Select The Following</div>
							<div class= "panel-body">
								
								<form class="form-signin" role="form" action="addsubject.php" method="post">
									<br/><b>Select Regulation </b>&emsp;<select name="regulation" id="reg1" required>
										<option value="">--Select--</option>
										<?php
											foreach($reg as $item){												
												echo '<option value="'.$item.'"';
												 if(!empty($_COOKIE['sub_reg']) && $_COOKIE['sub_reg']==$item){
													echo ' selected';
												 }
												echo '>'.$item.'</option>';
											}
										?></select>
										<br /><br/><b>Select Department </b> &emsp;&emsp;<select name="branch" id="dep" style="width:100px" required>
											<?php
												echo '<option value="'.$_SESSION['branch'].'"';
												 if(!empty($_COOKIE['sub_dep']) && $_COOKIE['sub_dep']==$_SESSION['branch']){
													echo ' selected';
												 }
												echo '>'.$_SESSION['branch'].'</option>';
											?>
											</select>
											<br /><br><b>Select Course Type: </b> &emsp;<select name="course" id="cr" required>
												<option value="">--SELECT--</option>
												<?php
												foreach($br_specs as $item1){
													$item = explode("|",$item1);
													$temp_item = $item[0].'_'.$item[2];
													echo '<option value="'.$temp_item.'"';
													 if(!empty($_COOKIE['sub_cr']) && $_COOKIE['sub_cr']==$temp_item){
														echo ' selected';
													 }
													echo '>'.$item[1].'</option>';													
												}
												?>

											</select>
											<br /><br><b>Select year </b> &emsp; &emsp; &emsp;<select name="year" id="yr" required>
												<option value="">--SELECT--</option>
												<option value="I" <?php if(!empty($_COOKIE['sub_yr']) && $_COOKIE['sub_yr']=='I'){ echo 'selected'; } ?>>I</option>
												<option value="II" <?php if(!empty($_COOKIE['sub_yr']) && $_COOKIE['sub_yr']=='II'){ echo 'selected'; } ?>>II</option>
												<option value="III" <?php if(!empty($_COOKIE['sub_yr']) && $_COOKIE['sub_yr']=='III'){ echo 'selected'; } ?>>III</option>
												<option value="IV" <?php if(!empty($_COOKIE['sub_yr']) && $_COOKIE['sub_yr']=='IV'){ echo 'selected'; } ?>>IV</option>
											</select>
											
											<br><br><b>Select Semester:</b> &emsp;<select name="sem" id="sm" required>
												<option value="">--SELECT--</option>
												<option value="I" <?php if(!empty($_COOKIE['sub_sm']) && $_COOKIE['sub_sm']=='I'){ echo 'selected'; } ?>>I</option>
												<option value="II" <?php if(!empty($_COOKIE['sub_sm']) && $_COOKIE['sub_sm']=='II'){ echo 'selected'; } ?>>II</option>
											</select><br/><br/>
											<b>Subject Name</b> &emsp;&emsp;<input type="text" class="form-control" name="sub" id="sub1" required>
											
											<br/><br/><button class="btn btn-md btn-primary btn-block" type="submit">ADD</button>
								</div>
							</div>
						</div>
					
					</div></div>
					<div class="col-sm-6">
						<div class="panel panel-default">
							<div class="panel-heading">Added Subjects</div>
							<div class= "panel-body" id="subs">
								<?php
								if(!empty($_POST['delsub']) && !empty($_POST['subid'])){
								 $del_res = $cgs_obj->delSub($_POST['subid']);
								 if($del_res>0){
									echo '<div class="alert alert-warning">Success..! Subject Deleted </div>';
								 }
								}
								?>

							</div>
						</div>
					</div>
					</div>
					
				</div>
			</div>
			
		</div>

		<script>
			$(function(){

				var regulation1 = $("#reg1").val();
				var dep1=$("#dep").val();
				var year1=$("#yr").val();
				var sem1=$("#sm").val();
				var course1=$("#cr").val();
				 document.cookie = "sub_dep="+$("#dep").val();					
				 document.cookie = "sub_sm="+$("#sm").val();
				 
				if(1){
					$.ajax({							
						url:"ajgetsubs.php",
						method:"post",
						data:{regulation:regulation1,branch:dep1,year:year1,sem:sem1,course:course1},
						dataType:"text",
						success:function(data){
							$("#subs").html(data);
						}
					});												
				}					
				else{
					$("#subs").html("");						
				}


				$("#reg1").change(	
				  function(){
					  document.cookie = "sub_reg="+$("#reg1").val();
					  $("#cr").val('');
					 $("#yr").val('');		  
					 $("#sm").val('');
				});	
				

				$("#cr").change(	
				  function(){
					 document.cookie = "sub_cr="+$("#cr").val();
					 $("#yr").val('');		  
					 $("#sm").val('');
				});	

				$("#yr").change(	
				  function(){
					 document.cookie = "sub_yr="+$("#yr").val();
					 $("#sm").val('');
				});
				
				
				$("#sm").change(
				function(){
					var regulation1 = $("#reg1").val();
					var dep1=$("#dep").val();
					var year1=$("#yr").val();
					var sem1=$("#sm").val();
					var course1=$("#cr").val();
					 document.cookie = "sub_dep="+$("#dep").val();					
					 document.cookie = "sub_sm="+$("#sm").val();
					 
					if(1){
						$.ajax({							
							url:"ajgetsubs.php",
							method:"post",
							data:{regulation:regulation1,branch:dep1,year:year1,sem:sem1,course:course1},
							dataType:"text",
							success:function(data){
								$("#subs").html(data);
							}
						});												
					}					
					else{
						$("#subs").html("");						
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
	?>	