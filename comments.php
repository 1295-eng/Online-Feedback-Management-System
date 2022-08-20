<?php
@session_start();
if(!empty($_SESSION['user']) && !empty($_SESSION['priv'])){
//echo $_POST['fname'];
 
 require_once('header.php');
 require_once('cgs.php');
if(!empty($_POST['fname']) && !empty($_POST['sub'])&& !empty($_POST['course']) )
{
	$fclt = $_POST['fname'];
	$subs = explode('_',$_POST['sub']);
	$brc = $subs[0];
	$sub = $subs[1];
	$feed_id = $subs[2];
	
	$cr_code=$_POST['course'];
	$cgs_obj2 = new CGS;
	   $res1 = $cgs_obj2->selectd2($fclt,$sub,$cr_code,$brc,$feed_id);
        $res2 = $cgs_obj2->getComments2($fclt,$sub,$brc,$feed_id);
		
		
		
		$a = intval($res1['avg']);
		
}else{
	header('Location: staff2.php');
}
?>

<div class="container-fluid">
    <div class="row row-offcanvas row-offcanvas-left">

              <div class="col-xs-12 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
                <div class="list-group">
                  <?php
				  if($_SESSION['priv']=="hod")
				  {
                    $menu_id = 111;
                                       //require_once("submenu.php");
				   require_once("menu.php");

					}
					else{
					$menu_id=3;
					require_once("menu1.php");
					}
                  ?>
                </div>
              </div><!--/span-->

              <div class="col-xs-12 col-sm-9">
			  
			<table>
            <tr>		
			 <td> <b>Subject :&emsp;:&emsp;</b><i><?php 
			 echo $sub.' (';
			 if(!empty($br_name[$brc])){
				echo $br_name[$brc];
			 }
			 if(!empty($subs[2]) && !empty($subs[3])){
				 echo ' - '.$subs[2].' - '.$subs[3];
			 }
			 echo ')';?>
			 </i>&emsp;&emsp;</td>

              <td><b>Faculty name:&emsp;:&emsp;</b> <i><?php echo strtoupper($_POST['fname']);?></i></td>
              </tr>
              <tr>
             <td><b>Overall rating :&emsp;</b><meter value="<?php echo round($res1['avg']*10,2);?>" min="0" max="100"></meter>
					<?php echo round($res1['avg']*10,2); ?>%</td>
               <td> <b>No.of students submitted:&emsp;:&emsp;</b><?php echo $res1['count']?> </td> 
                  </tr>
				</table>
                  <?php 
					if(!empty($res2['status']) && $res2['status']==1){
						echo "<h4>Comments:</h4>";
						foreach($res2['comments'] as $cmnt){
							echo '<div class="panel panel-default"><div class="panel-body">'.nl2br($cmnt).'</div></div>';
						}
					}else{
						echo '<div class="alert alert-success" role="alert">Comments Not Found..!</div>';
					}
				  ?>

		</div>

</div>
</div>




<?php
          require('footer.php');

}
else {
  header('Location: index.php');
}