<a href="hod1.php"  <?php if(!empty($menu_id) && $menu_id==1){ echo "class='list-group-item active'"; } else{ echo "class='list-group-item'"; } ?> >Individual Report</a>
<a href="all_fac.php"  <?php if(!empty($menu_id) && $menu_id==6){ echo "class='list-group-item active'"; } else{ echo "class='list-group-item'"; } ?> >All Faculty Report</a>
<a href="feedback_trig.php"  <?php if(!empty($menu_id) && $menu_id==2){ echo "class='list-group-item active'"; } else{ echo "class='list-group-item'"; } ?> >Feedback Triggered</a>
<a href="fac_course_info.php"  <?php if(!empty($menu_id) && $menu_id==3){ echo "class='list-group-item active'"; } else{ echo "class='list-group-item'"; } ?> >Faculty & Courses</a>
<a href="feed_completed.php"  <?php if(!empty($menu_id) && $menu_id==5){ echo "class='list-group-item active'"; } else{ echo "class='list-group-item'"; } ?> >Completed Feedback</a>
<a href="admin.php"  <?php if(!empty($menu_id) && $menu_id==4){ echo "class='list-group-item active'"; } else{ echo "class='list-group-item'"; } ?> >Go to main page</a>
<a href="flogout.php" class="list-group-item" >Logout</a>