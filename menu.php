<a href="admin.php"  <?php if(!empty($menu_id) && $menu_id==10){ echo "class='list-group-item active'"; } else{ echo "class='list-group-item'"; } ?> >Home</a>





<a href="activ_feedback.php"  <?php if(!empty($menu_id) && $menu_id==8){ echo "class='list-group-item active'"; } else{ echo "class='list-group-item'"; } ?> >Activate Feedback</a>
<a href="show_activ_feedback.php"  <?php if(!empty($menu_id) && $menu_id==88){ echo "class='list-group-item active'"; } else{ echo "class='list-group-item'"; } ?> >Show Activated Feedbacks</a>
<?php
	if($_SESSION['user']=="admin" || strtolower($_SESSION['user'])=="administrator"){

		if(!empty($menu_id) && $menu_id==4444){
			echo '<a href="pwdreset.php" class="list-group-item active" >Reset Student Password</a>';
		}else{
			echo '<a href="pwdreset.php" class="list-group-item" >Reset Student Password</a>';
		}
		if(!empty($menu_id) && $menu_id==4445){
			echo '<a href="delfac.php" class="list-group-item active" >Delete Faculty</a>';
		}else{
			echo '<a href="delfac.php" class="list-group-item" >Delete Faculty</a>';
		}
		if(!empty($menu_id) && $menu_id==555){
			echo '<a href="faculty_sort.php" class="list-group-item active" >Faculty List</a>';
		}else{
			echo '<a href="faculty_sort.php" class="list-group-item" >Faculty List</a>';
		}
		if(!empty($menu_id) && $menu_id==556){
			echo '<a href="addstudents.php" class="list-group-item active" >Upload Data</a>';
		}else{
			echo '<a href="addstudents.php" class="list-group-item" >Upload Data</a>';
		}
				
		
	}

	if(!empty($menu_id) && $menu_id==445){
		echo '<a href="subjects.php" class="list-group-item active" >Add/View Subjects</a>';
	}else{
		echo '<a href="subjects.php" class="list-group-item" >Add/View Subjects</a>';
	}
	
	if(!empty($menu_id) && $menu_id==446){
		echo '<a href="fac_course.php" class="list-group-item active" >Fac_Course Mapping</a>';
	}else{
		echo '<a href="fac_course.php" class="list-group-item" >Fac_Course Mapping</a>';
	}
	
?>
<a href="all_fac.php"  <?php if(!empty($menu_id) && $menu_id==12){ echo "class='list-group-item active'"; } else{ echo "class='list-group-item'"; } ?> >All Faculty Report</a>
<a href="hod1.php"  <?php if(!empty($menu_id) && $menu_id==11){ echo "class='list-group-item active'"; } else{ echo "class='list-group-item'"; } ?> >Individual Report</a>
<?php
	if($_SESSION['user']=="admin" || strtolower($_SESSION['user'])=="administrator"){
		if(!empty($menu_id) && $menu_id==111){
			echo '<a href="hod2.php" class="list-group-item active" >Individual Written Feedback</a>';
		}else{
			echo '<a href="hod2.php" class="list-group-item" >Individual Written Feedback</a>';
		}
	}
?>

<a href="chngpwd.php"  <?php if(!empty($menu_id) && $menu_id==4){ echo "class='list-group-item active'"; } else{ echo "class='list-group-item'"; } ?> >Change Password</a>
<a href="flogout.php" class="list-group-item" >Logout</a>

