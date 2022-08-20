<?php 
@session_start();
if(!empty($_SESSION['user']) && !empty($_SESSION['priv'])&& ($_SESSION['priv']="hod" || $_SESSION['priv']="admin")){

require('header.php');
?>
<div class="col-xs-12 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
                <div class="list-group">
<?php 
$menu_id = 443;
require_once('menu.php');

?>

</div>
</div>
<div class="col-xs-12 col-sm-9">
			  
			  <div class="row">
				<form action="db_dump_sh.php" method="post">
				  <br>
				<table align="center" cellspacing="0" cellpadding="8">
				  <tr>
					<th colspan="2" align="center" style="font-size:1.2em;">
					  <b>Back Up Database</b>
					  <br /><br />
					</th>
				  </tr>

				  <tr>
					<td>&nbsp;   </td>
					<td align="center">
					  <input type="submit" name="submitbutton" value="Click Here to Proceed" style="padding-left:15px; padding-top:3px; padding-bottom:3px; padding-right:15px; background-color:#61cf16;" />
					</td>
				  </tr>
				  <tr>
					<td align="center" colspan="2">
					  <?php
					  if(!empty($_POST['id']) && $_POST['id']=="error"){
						echo "<br /> <span style='color:red'>Please Try again..!</span>";
					  }
					  elseif(!empty($_POST['id']) && $_POST['id']=="success"){
						echo "<br /> <span style='color:green'>Backup file Successfully created..!</span>";
					  }
					  ?>
					</td>
				  </tr>
				</table>
				</form>
										
              </div>
              </div>
<?php 
require('footer.php');
}





?>