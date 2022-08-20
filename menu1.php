<a href="staff1.php"  <?php if(!empty($menu_id) && $menu_id==1){ echo "class='list-group-item active'"; } else{ echo "class='list-group-item'"; } ?> >Get Report</a>
<a href="staff2.php"  <?php if(!empty($menu_id) && $menu_id==3){ echo "class='list-group-item active'"; } else{ echo "class='list-group-item'"; } ?> >Get Comments</a>
<a href="chngpwd.php"  <?php if(!empty($menu_id) && $menu_id==2){ echo "class='list-group-item active'"; } else{ echo "class='list-group-item'"; } ?> >Change Password</a>
<a href="flogout.php" class="list-group-item" >Logout</a>