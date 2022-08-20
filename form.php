<?php
@session_start();

if(!empty($_SESSION['user']) && !empty($_SESSION['priv']) && $_SESSION['priv']=="student")
{
    require_once('cgs.php');
	require_once('data.php');
	
	$cgs_obj = new CGS;
       $res1 = $cgs_obj->getBdetails($br);
		$cgs_obj1 = new CGS;
		
		$faculty = $cgs_obj1->getF2($reg,$cr,$br,$yr,$sem);
		$subfac = $cgs_obj1->getSubFac($reg,$cr,$br,$yr,$sem);
		//echo $reg." - ".$cr." - ".$br." - ".$yr." - ".$sem;
//	print_r($res1);
	//var_dump($faculty);
	
	
							$over = 0;
							for($i=0; $i<=$subfac['ival'];$i++){
								if(!empty($subfac['faculty'][$i]) && !in_array($subfac['subject'][$i],$_SESSION['yes_sub'])){
									$over++;
								}
							}
			if($over==0){
				header('Location:logout.php');
			}else{
	
	
	require('header.php');
	//echo $cr;
	++$_SESSION['count'];
?>
<script type="text/javascript">
function validateRadio (radios)
{
    for (i = 0; i < radios.length; ++ i)
    {
        if (radios [i].checked) return true;
    }
    return false;
}

function validateForm()
{
	var x = document.getElementById("subj").selectedIndex;
	var xval = document.getElementsByTagName("option")[x].value;
	
    if(validateRadio (document.forms["feedback"]["q1"])
	&&validateRadio (document.forms["feedback"]["q2"])
	&&validateRadio (document.forms["feedback"]["q3"])
	&&validateRadio (document.forms["feedback"]["q4"])
	&&validateRadio (document.forms["feedback"]["q5"])
	&&validateRadio (document.forms["feedback"]["q6"])
	&&validateRadio (document.forms["feedback"]["q7"])
	&&validateRadio (document.forms["feedback"]["q8"])
	&&validateRadio (document.forms["feedback"]["q9"])
	&&validateRadio (document.forms["feedback"]["q10"])
	&&validateRadio (document.forms["feedback"]["q11"])
	&&validateRadio (document.forms["feedback"]["q12"])
	&&validateRadio (document.forms["feedback"]["q13"])
	&&validateRadio (document.forms["feedback"]["q14"]))
    {
        return true;
    }
	else if(xval==""){
		alert("Please select a subject");
		return false;
	}
    else
    {
        alert('Please answer all questions');
        return false;
    }
	
}
</script>
<!--<a href="flogout.php">Logout</a>-->
<h3>Welcome <?php echo $_SESSION['user']; //.$_SESSION['branch'];?></h3>
<div class="container-fluid">
 <div class="row row-offcanvas row-offcanvas-left">
 
<div class="row">
<div class="col-xs-12 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
                <div class="list-group">
                  <?php
                    $menu_id = 1;
                    require_once("menu2.php");
                  ?>
                </div>
              </div>

				<div class="col-sm-2">&nbsp;
				</div>
                  <span class="data" style="font-family:'Arial'; font-size:1.4em; margin-bottom:12px; letter-spacing: 3px;">FEEDBACK FORM</span><br/>
				  <span class="data" style="font-family:'Arial'; font-size:1.4em; margin-bottom:12px; letter-spacing: 3px;">FORM:<?php echo $_SESSION['count'];?></span><br/>
                 </div>
				 </div>
				</div>
                <br/> <br/>
				
		<?php
		?>				
			<form name='feedback' action='insert.php' onsubmit='return validateForm()' method='post'>
			<table style="width:100%">
			<tr>
				<td><span><b>Subject Name </b><span></td>
				<td>&emsp;:&emsp;<select name="subfac" id="subfac1" required="required">
					<option value="">--Select--</option>
					<?php
					for($i=0; $i<=$subfac['ival'];$i++){
						if(!empty($subfac['faculty'][$i]) && (!in_array($subfac['subject'][$i],$_SESSION['yes_sub']))){
						?>
						<option value="<?php echo $subfac['faculty'][$i].'_'.$subfac['subject'][$i]; ?>" ><?php echo $subfac['subject'][$i]; ?></option>						
						<?php 
						}
					}
					 ?>
				</select>
				</td>
				<td style="text-align:right;"><span><b>Class&emsp;: &emsp;</b><span></td>
				<td style="text-align:left;">
				<?php 
				if($cr=='A'){
				echo " ".$yr." B.Tech ".$sem." Sem ";
				}
				if($cr=='D'){
				echo " ".$yr." M.Tech ".$sem." Sem ";
				}
				if($cr=='E'){
				echo " ".$yr." MBA ".$sem." Sem ";
				}
				if($cr=='F'){
				echo " ".$yr." MCA".$sem." Sem ";
				}
				
				?>
				</td>
			</tr>
			<tr>
				<td><span><b>Faculty Name </b><span></td>
				<td>&emsp;:&emsp;<span id="fac_name"></span>
				</td>
				<td style="text-align:right;"><span><b>Branch &emsp;: &emsp;</b><span></td>
				<td style="text-align:left;">
				
				<?php echo $res1;?>
				</td>
			</tr>
			</table><br/>
			  
				
				<table class="table" style="width:100%; border:1px solid">
				   <tr>
					<td><b>S.No</b></td>
					<td><b>Question</b></td>
					<td><b>Excellent</b></td>
					<td><b>Very Good</b></td>
					<td><b>Good</b></td>
					<td><b>Average</b></td>
					<td><b>Poor</b></td>
				  </tr>
				  <tr>
				    <td>1</td>
				    <td style="font-size:1.4em;"> Teacher comes to the class on time </td>
					<td><input type='radio' required="required" name='q1' value='10'></td>
					<td><input type='radio' required="required" name='q1' value='8'></td>
					<td><input type='radio' required="required" name='q1' value='6'></td>
					<td><input type='radio' required="required" name='q1' value='4'></td>
					<td><input type='radio' required="required" name='q1' value='2'></td>
				  </tr>
				  <tr>
				    <td>2</td>
				    <td style="font-size:1.4em;"> Teacher speaks clearly and audibly </td>
					<td><input type='radio' required="required" name='q2' value='10'></td>
					<td><input type='radio' required="required" name='q2' value='8'></td>
					<td><input type='radio' required="required" name='q2' value='6'></td>
					<td><input type='radio' required="required" name='q2' value='4'></td>
					<td><input type='radio' required="required" name='q2' value='2'></td>
				  </tr>
				  <tr>
				    <td>3</td>
				    <td style="font-size:1.4em;"> Teacher plans lesson with clear objective </td>
					<td><input type='radio' required="required" name='q3' value='10'></td>
					<td><input type='radio' required="required" name='q3' value='8'></td>
					<td><input type='radio' required="required" name='q3' value='6'></td>
					<td><input type='radio' required="required" name='q3' value='4'></td>
					<td><input type='radio' required="required" name='q3' value='2'></td>
				  </tr>
				  <tr>
				    <td>4</td>
				    <td style="font-size:1.4em;"> Teacher has got command on the subject </td>
					<td><input type='radio' required="required" name='q4' value='10'></td>
					<td><input type='radio' required="required" name='q4' value='8'></td>
					<td><input type='radio' required="required" name='q4' value='6'></td>
					<td><input type='radio' required="required" name='q4' value='4'></td>
					<td><input type='radio' required="required" name='q4' value='2'></td>
				  </tr>
				  <tr>
				    <td>5</td>
				    <td style="font-size:1.4em;"> Teacher writes and draws legibly </td>
					<td><input type='radio' required="required" name='q5' value='10'></td>
					<td><input type='radio' required="required" name='q5' value='8'></td>
					<td><input type='radio' required="required" name='q5' value='6'></td>
					<td><input type='radio' required="required" name='q5' value='4'></td>
					<td><input type='radio' required="required" name='q5' value='2'></td>
				  </tr>
				  <tr>
				    <td>6</td>
				    <td style="font-size:1.4em;"> Teacher asks qstions to promote interaction and effective thinking </td>
					<td><input type='radio' required="required" name='q6' value='10'></td>
					<td><input type='radio' required="required" name='q6' value='8'></td>
					<td><input type='radio' required="required" name='q6' value='6'></td>
					<td><input type='radio' required="required" name='q6' value='4'></td>
					<td><input type='radio' required="required" name='q6' value='2'></td>
				  </tr>
				  <tr>
				    <td>7</td>
				    <td style="font-size:1.4em;"> Teacher encourages,compliments and praises originality and creativity displayed by the student </td>
					<td><input type='radio' required="required" name='q7' value='10'></td>
					<td><input type='radio' required="required" name='q7' value='8'></td>
					<td><input type='radio' required="required" name='q7' value='6'></td>
					<td><input type='radio' required="required" name='q7' value='4'></td>
					<td><input type='radio' required="required" name='q7' value='2'></td>
				  </tr>
				  <tr>
				    <td>8</td>
				    <td style="font-size:1.4em;"> Teacher is courteous and impartial in dealing with the students </td>
					<td><input type='radio' required="required" name='q8' value='10'></td>
					<td><input type='radio' required="required" name='q8' value='8'></td>
					<td><input type='radio' required="required" name='q8' value='6'></td>
					<td><input type='radio' required="required" name='q8' value='4'></td>
					<td><input type='radio' required="required" name='q8' value='2'></td>
				  </tr>
				  <tr>
				    <td>9</td>
				    <td style="font-size:1.4em;"> Teacher covers the syllabus completely </td>
					<td><input type='radio' required="required" name='q9' value='10'></td>
					<td><input type='radio' required="required" name='q9' value='8'></td>
					<td><input type='radio' required="required" name='q9' value='6'></td>
					<td><input type='radio' required="required" name='q9' value='4'></td>
					<td><input type='radio' required="required" name='q9' value='2'></td>
				  </tr>
				  <tr>
				    <td>10</td>
				    <td style="font-size:1.4em;"> Teacher evaluation of the sessional exams answer scripts,lab records etc is fair and impartial </td>
					<td><input type='radio' required="required" name='q10' value='10'></td>
					<td><input type='radio' required="required" name='q10' value='8'></td>
					<td><input type='radio' required="required" name='q10' value='6'></td>
					<td><input type='radio' required="required" name='q10' value='4'></td>
					<td><input type='radio' required="required" name='q10' value='2'></td>
				  </tr>
				  <tr>
				    <td>11</td>
				    <td style="font-size:1.4em;"> Teacher is prompt in valuing and returning the answer scripts providing feedback on performance </td>
					<td><input type='radio' required="required" name='q11' value='10'></td>
					<td><input type='radio' required="required" name='q11' value='8'></td>
					<td><input type='radio' required="required" name='q11' value='6'></td>
					<td><input type='radio' required="required" name='q11' value='4'></td>
					<td><input type='radio' required="required" name='q11' value='2'></td>
				  </tr>
				  <tr>
				    <td>12</td>
				    <td style="font-size:1.4em;"> Teacher offers assistance and counseling to the needy students </td>
					<td><input type='radio' required="required" name='q12' value='10'></td>
					<td><input type='radio' required="required" name='q12' value='8'></td>
					<td><input type='radio' required="required" name='q12' value='6'></td>
					<td><input type='radio' required="required" name='q12' value='4'></td>
					<td><input type='radio' required="required" name='q12' value='2'></td>
				  </tr>
				  <tr>
				    <td>13</td>
				    <td style="font-size:1.4em;"> Teacher imparts the practical knowledge concerned to the subject </td>
					<td><input type='radio' required="required" name='q13' value='10'></td>
					<td><input type='radio' required="required" name='q13' value='8'></td>
					<td><input type='radio' required="required" name='q13' value='6'></td>
					<td><input type='radio' required="required" name='q13' value='4'></td>
					<td><input type='radio' required="required" name='q13' value='2'></td>
				  </tr>
				  <tr>
				    <td>14</td>
				    <td style="font-size:1.4em;"> Teacher leaves the class on time </td>
					<td><input type='radio' required="required" name='q14' value='10'></td>
					<td><input type='radio' required="required" name='q14' value='8'></td>
					<td><input type='radio' required="required" name='q14' value='6'></td>
					<td><input type='radio' required="required" name='q14' value='4'></td>
					<td><input type='radio' required="required" name='q14' value='2'></td>
				  </tr>
				 
				</table>
				<br/>
				<span><b>Comments</b></span><br/>
				<textarea  name="cmnt" placeholder="enter your comment here"></textarea><br/>

				<input class="btn btn-primary" type='submit' value='submit' rows="5" cols="40" style='margin-left:500px'/>
				</form>
			<?php  ?>
				</div>
              </div>
            </div><br/><br/><br/>
</div>
				<div class="col-sm-1">&nbsp;
				</div>
                
<script>

  $(function(){
    $("#subfac1").change(
	
      function(){
        var subfac = $("#subfac1").val();
		
		if(1){
			$("#fac_name").html(subfac.split("_",1));
		}

		else{
		  $("#fac_name").html("");		 
		}

    });
  });

</script>


<?php
          require('footer.php');
	}
}
else {
  header('Location: index.php');
}
 ?>