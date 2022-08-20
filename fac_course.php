<?php
	@session_start();
	if(!empty($_SESSION['user']) && !empty($_SESSION['priv'])&& $_SESSION['priv']="hod"){
		
		require_once('header.php');
		require_once('cgs.php');
		$cgs_obj = new CGS;
		$dep  = $cgs_obj->getdep($_SESSION['user']);
		$reg=$cgs_obj->getReg1();
		//$_SESSION['fac_sub'] = array(); 
		//var_dump($_SESSION['fac_sub']);
		
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
						$menu_id = 446;
						require_once("menu.php");
					?>
				</div>
			</div><!--/span-->
			
			<div class="col-xs-12 col-sm-9">
				
				<div class= "row">
					<div class="col-md-2">&nbsp;
					</div>
					<div class= "col-md-6">
						<div class= "panel panel-primary">
							<div class="panel-heading">Select The Following</div>
							<div class= "panel-body">
								
								<form class="form-signin" role="form" action="addcoursemap.php" method="post">
									<br/><b>Select Regulation </b>&emsp;<select name="regulation" id="reg1" required>
										<option value="">--Select--</option>
										<?php
											// A sample product array
											// Iterating through the product array
											foreach($reg as $item){
												
											?>
											<option value="<?php echo ($item); ?>" <?php if($item==17){ echo 'selected'; } ?>><?php echo $item; ?></option>
											
											<?php
											}
										?></select>
										<br /><br/><b>Select Department </b> &emsp;&emsp;<select name="branch" id="dep" style="width:100px" required>
											<option value="<?php echo $_SESSION['branch'];?>"><?php echo $_SESSION['branch']; ?></option>
											<?php
												// A sample product array
												// Iterating through the product array
												// foreach($dep as $item){
											?>
											<!-- <option value="<?php //echo ($item); ?>"><?php //echo $item; ?></option>-->
											
											<?php
												//}
											?></select>
											<br /><br><b>Select Course Type: </b> &emsp;<select name="course" id="cr" required>
												<option value="">--SELECT--</option>
												<option value="A" selected>B.Tech</option>
												<option value="D">M.Tech</option>
											</select>
											<br /><br><b>Select year </b> &emsp; &emsp; &emsp;<select name="year" id="yr" required>
												<option value="">--SELECT--</option>
												<option value="I" selected>I</option>
												<option value="II">II</option>
												<option value="III">III</option>
												<option value="IV">IV</option>
											</select>
											
											<br><br><b>Select Semester:</b> &emsp;<select name="sem" id="sm" required>
												<option value="">--SELECT--</option>
												<option value="I">I</option>
												<option value="II">II</option>
											</select><br/><br/>
											<b>Select subject</b> &emsp;&emsp;<select name="sub" id="sub1" required>
												<option value="">--SELECT--</option>
												
											</select>
											
											<br /><br /><b>Select Faculty</b>&emsp;&emsp;<select name="fnamem" id="fac" required>
												<option value="">--SELECT--</option>
											</select>
											<br/><br/><button class="btn btn-md btn-primary btn-block" type="submit">ADD</button>
								</div>
							</div>
						</div>
						<div class="col-md-2">&nbsp;</div>
					
					</div>
					<div class="row">
						<div class="panel panel-default">
							<div class="panel-heading">Added Subjects</div>
							<div class= "panel-body" id="sub_fac">
								<?php
								if(!empty($_POST['delsubfac']) && !empty($_POST['subfacid'])){
								 $del_res = $cgs_obj->delSubFac($_POST['subfacid']);
								 if($del_res>0){
									echo '<div class="alert alert-warning">Success..! Subject - Faculty Deleted </div>';
								 }
								}
								?>
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
				if(1){
					$.ajax({
						
						url:"ajget1.php",
						method:"post",
						data:{regulation:regulation1,branch:dep1,year:year1,sem:sem1,course:course1},
						dataType:"text",
						success:function(data){
							$("#sub1").html(data);
						}
					});
					
					
				}
				
				else{
					$("#sub1").html("<option>--selectssss--</option>");
					
				}
				
				var branch1 = $("#dep").val();
				if(1){
					$.ajax({
						url:"ajget2.php",
						method:"post",
						data:{branch:branch1},
						dataType:"text",
						success:function(data){
							$("#fac").html(data);
						}
					});
					
					
				}
				
				else{
					$("#fac").html("<option>--select--</option>");
					
				}
				
			});
			
			$(function(){
				$("#sm").change(
				function(){
					
					var branch1 = $("#dep").val();
					if(1){
						$.ajax({
							url:"ajget2.php",
							method:"post",
							data:{branch:branch1},
							dataType:"text",
							success:function(data){
								$("#fac").html(data);
							}
						});
						
						
					}
					
					else{
						$("#fac").html("<option>--select--</option>");
						
					}
					
				});
			});
			
		</script>
		<script>
			//alert("hi");
			$(function(){
				$("#sm").change(
				function(){
					var regulation1 = $("#reg1").val();
					var dep1=$("#dep").val();
					var year1=$("#yr").val();
					var sem1=$("#sm").val();
					var course1=$("#cr").val();
					if(1){
						$.ajax({
							
							url:"ajget1.php",
							method:"post",
							data:{regulation:regulation1,branch:dep1,year:year1,sem:sem1,course:course1},
							dataType:"text",
							success:function(data){
								$("#sub1").html(data);
							}
						});
						
						
					}
					
					else{
						$("#sub1").html("<option>--select--</option>");
						
					}
					
					
					if(1){
						$.ajax({
							
							url:"ajgetsubfac.php",
							method:"post",
							data:{regulation:regulation1,branch:dep1,year:year1,sem:sem1,course:course1},
							dataType:"text",
							success:function(data){
								$("#sub_fac").html(data);
							}
						});
						
						
					}
					
					else{
						$("#sub_fac").html("");
						
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