<?php
@session_start();
if(!empty($_SESSION['user']) && !empty($_SESSION['priv'])){
//echo $_POST['fname'];

 require_once('cr_codes.php');
 
 require('header.php');
 require('cgs.php');
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
		
		$a = intval($res1['avg']);
		
}
?>

<div class="container-fluid">
    <div class="row row-offcanvas row-offcanvas-left">

              <div class="col-xs-12 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
                <div class="list-group dontprint">
                  <?php
				  if($_SESSION['priv']=="hod")
				  {
                    $menu_id = 11;
                                       //require_once("submenu.php");
				   require_once("menu.php");

					}
					else{
					$menu_id=1;
					require_once("menu1.php");
					}
                  ?>
                </div>
              </div><!--/span-->

              <div class="col-xs-12 col-sm-9">
			  <br/>
			<table>
            <tr>		
			 <td> <b>Subject :&emsp;:&emsp;</b><i>
			 <?php 
			 echo $sub.' (';
			 if(!empty($br_name[$brc])){
				echo $br_name[$brc];
			 }
			 if(!empty($subs[2]) && !empty($subs[3])){
				 echo ' - '.$subs[2].' - '.$subs[3];
			 }
			 echo ')';?>
			 </i>&emsp;&emsp;</td>
              <td style="font-size:1.1em;"><b>Faculty name:&emsp;:&emsp;</b> <i><?php echo strtoupper($_POST['fname']);?></i></td>
              </tr>
              <tr>
             <td style="font-size:1.1em;"><b>Overall rating :&emsp;</b><meter value="<?php echo round($res1['avg']*10,2);?>" min="0" max="100"></meter>
					<?php echo round($res1['avg']*10,2); ?>%</td>
               <td style="font-size:1.1em;"><br/> <b>No.of students submitted:&emsp;:&emsp;</b><?php echo $res1['count']?> <br/><br/></td> 
                  </tr>
				</table>
				<table class="table" style="width:100%; border:1px solid">
				
				   <tr>
					<th>S.No</th>
					<th>Question</th>
					<th>Rating</th>
                    <th>Percentage</th>
				  </tr>
				  <tr>
				    <td>1</td>
				    <td style="font-size:1.4em;"> Teacher comes to the class on time </td>
					<td><meter value="<?php echo round((($res1['qs1']/($res1['count']*10))*100),2);?>" min="0" max="100"></meter></td>
					<td><?php echo round((($res1['qs1']/($res1['count']*10))*100),2);?>%</td>
					
				  </tr>
				  <tr>
				    <td>2</td>
				    <td style="font-size:1.4em;"> Teacher speaks clearly and audibly </td>
					<td><meter value="<?php echo round((($res1['qs2']/($res1['count']*10))*100),2);?>" min="0" max="100"></meter></td>
					<td><?php echo round((($res1['qs2']/($res1['count']*10))*100),2);?>%</td>
					
				  </tr>
				  <tr>
				    <td>3</td>
				    <td style="font-size:1.4em;"> Teacher plans lesson with clear objective </td>
					<td><meter value="<?php echo round((($res1['qs3']/($res1['count']*10))*100),2);?>" min="0" max="100"></meter></td>
					<td><?php echo round((($res1['qs3']/($res1['count']*10))*100),2);?>%</td>
					
				  </tr>
				  <tr>
				    <td>4</td>
				    <td style="font-size:1.4em;"> Teacher has got command on the subject </td>
					<td><meter value="<?php echo round((($res1['qs4']/($res1['count']*10))*100),2);?>" min="0" max="100"></meter></td>
					<td><?php echo round((($res1['qs4']/($res1['count']*10))*100),2);?>%</td>
					
				  </tr>
				  <tr>
				    <td>5</td>
				    <td style="font-size:1.4em;"> Teacher writes and draws legibly </td>
					<td><meter value="<?php echo round((($res1['qs5']/($res1['count']*10))*100),2);?>" min="0" max="100"></meter></td>
					<td><?php echo round((($res1['qs5']/($res1['count']*10))*100),2);?>%</td>
					
				  </tr>
				  <tr>
				    <td>6</td>
				    <td style="font-size:1.4em;"> Teacher asks qstions to promote interaction and effective thinking </td>
					<td><meter value="<?php echo round((($res1['qs6']/($res1['count']*10))*100),2);?>" min="0" max="100"></meter></td>
					<td><?php echo round((($res1['qs6']/($res1['count']*10))*100),2);?>%</td>
				
				  </tr>
				  <tr>
				    <td>7</td>
				    <td style="font-size:1.4em;"> Teacher encourages,compliments and praises originality and creativity displayed by the student </td>
					<td><meter value="<?php echo round((($res1['qs7']/($res1['count']*10))*100),2);?>" min="0" max="100"></meter></td>
					<td><?php echo round((($res1['qs7']/($res1['count']*10))*100),2);?>%</td>
					
				  </tr>
				  <tr>
				    <td>8</td>
				    <td style="font-size:1.4em;"> Teacher is courteous and impartial in dealing with the students </td>
					<td><meter value="<?php echo round((($res1['qs8']/($res1['count']*10))*100),2);?>" min="0" max="100"></meter></td>
					<td><?php echo round((($res1['qs8']/($res1['count']*10))*100),2);?>%</td>
					
				  </tr>
				  <tr>
				    <td>9</td>
				    <td style="font-size:1.4em;"> Teacher covers the syllabus completely </td>
					<td><meter value="<?php echo round((($res1['qs9']/($res1['count']*10))*100),2);?>" min="0" max="100"></meter></td>
					<td><?php echo round((($res1['qs9']/($res1['count']*10))*100),2);?>%</td>
					
				  </tr>
				  <tr>
				    <td>10</td>
				    <td style="font-size:1.4em;"> Teacher evaluation of the sessional exams answer scripts,lab records etc is fair and impartial </td>
					<td><meter value="<?php echo round((($res1['qs10']/($res1['count']*10))*100),2);?>" min="0" max="100"></meter></td>
					<td><?php echo round((($res1['qs10']/($res1['count']*10))*100),2);?>%</td>
					
				  </tr>
				  <tr>
				    <td>11</td>
				    <td style="font-size:1.4em;"> Teacher is prompt in valuing and returning the answer scripts providing feedback on performance </td>
					<td><meter value="<?php echo round((($res1['qs11']/($res1['count']*10))*100),2);?>" min="0" max="100"></meter></td>
					<td><?php echo round((($res1['qs11']/($res1['count']*10))*100),2);?>%</td>
					
				  </tr>
				  <tr>
				    <td>12</td>
				    <td style="font-size:1.4em;"> Teacher offers assistance and counseling to the needy students </td>
					<td><meter value="<?php echo round((($res1['qs12']/($res1['count']*10))*100),2);?>" min="0" max="100"></meter></td>
					<td><?php echo round((($res1['qs12']/($res1['count']*10))*100),2);?>%</td>
					
				  </tr>
				  <tr>
				    <td>13</td>
				    <td style="font-size:1.4em;"> Teacher imparts the practical knowledge concerned to the subject </td>
					<td><meter value="<?php echo round((($res1['qs13']/($res1['count']*10))*100),2);?>" min="0" max="100"></meter></td>
					<td><?php echo round((($res1['qs13']/($res1['count']*10))*100),2);?>%</td>
					
					
				  </tr>
				  <tr>
				    <td>14</td>
				    <td style="font-size:1.4em;"> Teacher leaves the class on time </td>
					<td><meter value="<?php echo round((($res1['qs14']/($res1['count']*10))*100),2);?>" min="0" max="100"></meter></td>
					<td><?php echo round((($res1['qs14']/($res1['count']*10))*100),2);?>%</td>
					
				  </tr>
                 
				 
				</table>
			  
			   
                  
			  
			  
			  
			
				</div>

</div>
</div>




<?php
          require('footer.php');

}
else {
  header('Location: index.php');
}