<?php
@session_start();

if(!empty($_SESSION['user']) && !empty($_SESSION['priv']) && $_SESSION['priv']=="student")
{
    require('cgs.php');
	require('data.php');
	
	$cgs_obj = new CGS;
       $res1 = $cgs_obj->getBdetails($br);
		$cgs_obj1 = new CGS;
		
		$faculty = $cgs_obj1->getF2($reg,$cr,$br,$yr,$sem);
	//print_r($res1);
	//print_r($faculty);
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
<h3>Welcome <?php echo $_SESSION['user'].$_SESSION['branch'];?></h3>
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
                 
				<div class="col-sm-9">
               


 <div  STYLE=" margin:10mm 10mm 10mm 10mm; border: 5px double #000000; width:220mm; height:340mm;">
              <div class="col-sm-12" style="font-family:'Book Antiqua';">
                <div align='center' style=" padding-top:12px; letter-spacing:1px; font-weight: bold;">
				  <div class="row">
				  <div class="col-xs-12 col-sm-2">
				  <img src="images/jntuacea.png" alt="JNTUACEA" width="100px" height="100px" style="margin:10px;" />
				  </div>
				  <div class="col-xs-12 col-sm-10">
                  <br/><span style="font-size:1.2em;">JAWAHARLAL NEHRU TECHNOLOGICAL UNIVERSITY ANANTAPUR</span><br/>
                  <span style="font-size:1.2em;">COLLEGE OF ENGINEERING (<i>Autonomous</i>), ANANTHAPURAMU</span><br/>
                  <span style="font-size:1em; padding-top:10px;">ANDHRA PRADESH, INDIA - 515002</span><br/>
                  <br/>
                 

                  <span class="data" style="font-family:'Arial'; font-size:1.4em; margin-bottom:12px; letter-spacing: 3px;">FEEDBACK FORM</span><br/>
				  <span class="data" style="font-family:'Arial'; font-size:1.4em; margin-bottom:12px; letter-spacing: 3px;">FORM:<?php echo $_SESSION['count'];?></span><br/>
                 </div>
				 </div>
				</div>
                <br/> <br/>
				
				
			<form name='feedback' action='insert.php' onsubmit='return validateForm()' method='post'>
			<table style="width:100%">
			<tr>
				<td><span><b>Faculty Name </b><span></td>
				<td>&emsp;:&emsp;<select name="fname" id="fac1" required="required">
					<option value="">--Select--</option>
        <?php
        foreach($faculty as $item){
        ?>
        <option value="<?php echo $item; ?>" ><?php echo $item; ?></option>
        
		<?php 
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
				<td><span><b>Subject </b><span></td>
				<td>&emsp;:&emsp;<select name="sub" id="subj" required="required">
					<option value="">--Select--</option>
					
					</select>
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
					<td><input type='radio' name='q1' value='10'></td>
					<td><input type='radio' name='q1' value='8'></td>
					<td><input type='radio' name='q1' value='6'></td>
					<td><input type='radio' name='q1' value='4'></td>
					<td><input type='radio' name='q1' value='2'></td>
				  </tr>
				  <tr>
				    <td>2</td>
				    <td style="font-size:1.4em;"> Teacher speaks clearly and audibly </td>
					<td><input type='radio' name='q2' value='10'></td>
					<td><input type='radio' name='q2' value='8'></td>
					<td><input type='radio' name='q2' value='6'></td>
					<td><input type='radio' name='q2' value='4'></td>
					<td><input type='radio' name='q2' value='2'></td>
				  </tr>
				  <tr>
				    <td>3</td>
				    <td style="font-size:1.4em;"> Teacher plans lesson with clear objective </td>
					<td><input type='radio' name='q3' value='10'></td>
					<td><input type='radio' name='q3' value='8'></td>
					<td><input type='radio' name='q3' value='6'></td>
					<td><input type='radio' name='q3' value='4'></td>
					<td><input type='radio' name='q3' value='2'></td>
				  </tr>
				  <tr>
				    <td>4</td>
				    <td style="font-size:1.4em;"> Teacher has got command on the subject </td>
					<td><input type='radio' name='q4' value='10'></td>
					<td><input type='radio' name='q4' value='8'></td>
					<td><input type='radio' name='q4' value='6'></td>
					<td><input type='radio' name='q4' value='4'></td>
					<td><input type='radio' name='q4' value='2'></td>
				  </tr>
				  <tr>
				    <td>5</td>
				    <td style="font-size:1.4em;"> Teacher writes and draws legibly </td>
					<td><input type='radio' name='q5' value='10'></td>
					<td><input type='radio' name='q5' value='8'></td>
					<td><input type='radio' name='q5' value='6'></td>
					<td><input type='radio' name='q5' value='4'></td>
					<td><input type='radio' name='q5' value='2'></td>
				  </tr>
				  <tr>
				    <td>6</td>
				    <td style="font-size:1.4em;"> Teacher asks qstions to promote interaction and effective thinking </td>
					<td><input type='radio' name='q6' value='10'></td>
					<td><input type='radio' name='q6' value='8'></td>
					<td><input type='radio' name='q6' value='6'></td>
					<td><input type='radio' name='q6' value='4'></td>
					<td><input type='radio' name='q6' value='2'></td>
				  </tr>
				  <tr>
				    <td>7</td>
				    <td style="font-size:1.4em;"> Teacher encourages,compliments and praises originality and creativity displayed by the student </td>
					<td><input type='radio' name='q7' value='10'></td>
					<td><input type='radio' name='q7' value='8'></td>
					<td><input type='radio' name='q7' value='6'></td>
					<td><input type='radio' name='q7' value='4'></td>
					<td><input type='radio' name='q7' value='2'></td>
				  </tr>
				  <tr>
				    <td>8</td>
				    <td style="font-size:1.4em;"> Teacher is courteous and impartial in dealing with the students </td>
					<td><input type='radio' name='q8' value='10'></td>
					<td><input type='radio' name='q8' value='8'></td>
					<td><input type='radio' name='q8' value='6'></td>
					<td><input type='radio' name='q8' value='4'></td>
					<td><input type='radio' name='q8' value='2'></td>
				  </tr>
				  <tr>
				    <td>9</td>
				    <td style="font-size:1.4em;"> Teacher covers the syllabus completely </td>
					<td><input type='radio' name='q9' value='10'></td>
					<td><input type='radio' name='q9' value='8'></td>
					<td><input type='radio' name='q9' value='6'></td>
					<td><input type='radio' name='q9' value='4'></td>
					<td><input type='radio' name='q9' value='2'></td>
				  </tr>
				  <tr>
				    <td>10</td>
				    <td style="font-size:1.4em;"> Teacher evaluation of the sessional exams answer scripts,lab records etc is fair and impartial </td>
					<td><input type='radio' name='q10' value='10'></td>
					<td><input type='radio' name='q10' value='8'></td>
					<td><input type='radio' name='q10' value='6'></td>
					<td><input type='radio' name='q10' value='4'></td>
					<td><input type='radio' name='q10' value='2'></td>
				  </tr>
				  <tr>
				    <td>11</td>
				    <td style="font-size:1.4em;"> Teacher is prompt in valuing and returning the answer scripts providing feedback on performance </td>
					<td><input type='radio' name='q11' value='10'></td>
					<td><input type='radio' name='q11' value='8'></td>
					<td><input type='radio' name='q11' value='6'></td>
					<td><input type='radio' name='q11' value='4'></td>
					<td><input type='radio' name='q11' value='2'></td>
				  </tr>
				  <tr>
				    <td>12</td>
				    <td style="font-size:1.4em;"> Teacher offers assistance and counseling to the needy students </td>
					<td><input type='radio' name='q12' value='10'></td>
					<td><input type='radio' name='q12' value='8'></td>
					<td><input type='radio' name='q12' value='6'></td>
					<td><input type='radio' name='q12' value='4'></td>
					<td><input type='radio' name='q12' value='2'></td>
				  </tr>
				  <tr>
				    <td>13</td>
				    <td style="font-size:1.4em;"> Teacher imparts the practical knowledge concerned to the subject </td>
					<td><input type='radio' name='q13' value='10'></td>
					<td><input type='radio' name='q13' value='8'></td>
					<td><input type='radio' name='q13' value='6'></td>
					<td><input type='radio' name='q13' value='4'></td>
					<td><input type='radio' name='q13' value='2'></td>
				  </tr>
				  <tr>
				    <td>14</td>
				    <td style="font-size:1.4em;"> Teacher leaves the class on time </td>
					<td><input type='radio' name='q14' value='10'></td>
					<td><input type='radio' name='q14' value='8'></td>
					<td><input type='radio' name='q14' value='6'></td>
					<td><input type='radio' name='q14' value='4'></td>
					<td><input type='radio' name='q14' value='2'></td>
				  </tr>
				 
				</table>
				<span><b>Comments</b></span><br/>
				<textarea  name="cmnt" placeholder="enter your comment here"></textarea><br/>

				<input class="btn btn-primary" type='submit' value='submit' style='margin-left:500px'/>
				</form>
				
				</div>
              </div>
            </div><br/><br/><br/>
</div>
				<div class="col-sm-1">&nbsp;
				</div>
                
<script>

  $(function(){
    $("#fac1").change(
	
      function(){
        var faculty = $("#fac1").val();
		
		if(1){
        $.ajax({
          url:"ajget3.php",
          method:"post",
          data:{fac:faculty},
          dataType:"text",
          success:function(data){
            $("#subj").html(data);
          }
        });

        
		}

else{
  $("#subj").html("<option>--select--</option>");
 
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