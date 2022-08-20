
<?php 
@session_start();
/* Open connection to "feedback1" MySQL database. */
$mysqli = new mysqli("localhost", "root", "", "feedback1");
 
/* Check the connection. */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
require('header.php');
$br=$_POST['spec'];
$feeds=explode('_',$_POST['feedid']);
$yr=$_POST['year'];
$sm=$_POST['sem'];
$reg=$_POST['regulation'];
$cr=$_POST['course'];

$feedid = $feeds[0];

$url = 'pdfs.php?reg='.$reg.'&cr='.$cr.'&br='.$br.'&yr='.$yr.'&sem='.$sm.'&feeds='.$_POST['feedid'];
?>
<h3>Welcome <?php echo $_SESSION['user'];?></h3>
<div class="col-xs-12 col-sm-1 sidebar-offcanvas" id="sidebar" role="navigation">
                <div class="list-group">
                  <?php
                    $menu_id = 12;
                    //require_once("submenu.php");
				   require_once("menu.php");

                  ?>
                </div>
              </div>

<?php

$data=mysqli_query($mysqli,"SELECT `fid`,`sid`,`avg`,`count` FROM `ques` WHERE `br_code`='$br' AND `year`='$yr' AND `sem`='$sm' AND `regulation`='$reg' AND `cr_code`='$cr' AND `feed_id`='$feedid'");

$spec = mysqli_query($mysqli,"SELECT `spec` FROM `spec` where `brcode`='$br'");

$spec_name = "";
while($sp=mysqli_fetch_array($spec))
 {
	$spec_name=$sp['spec'];
 }
 
 if(empty($spec_name)){
	 $spec_name = $br;
 }
?>
<script>
var myData=[<?php 
while($info=mysqli_fetch_array($data))
 {
 $a=round(($info['avg']*10),2);
 echo $a .',';
 
  }  //echo $info['avg'].','; /* We use the concatenation operator '.' to add comma delimiters after each data value. */
?>];
<?php
  $data=mysqli_query($mysqli,"SELECT `fid`,`sid`,`avg`,`count` FROM `ques` WHERE `br_code`='$br' AND `year`='$yr' AND `sem`='$sm' AND `regulation`='$reg' AND `cr_code`='$cr' AND `feed_id`='$feedid'");


//$data=mysqli_query($mysqli,"SELECT (`fid`+ ',' + `sid`) AS fac_id, FROM `ques` WHERE `br_code`='$br'");
?>
var myLabels=[<?php 
while($info=mysqli_fetch_array($data))
 {
 //$string= $info['fid']."-".$info['sid'];
      //echo '"'.$string.'",';
	echo '"'.$info['fid'].'",'; 

	  }/* The concatenation operator '.' is used here to create string values from our database names. */
?>];
<?php
  $data=mysqli_query($mysqli,"SELECT `fid`,`sid`,`avg`,`count` FROM `ques` WHERE `br_code`='$br' AND `year`='$yr' AND `sem`='$sm' AND `regulation`='$reg' AND `cr_code`='$cr' AND `feed_id`='$feedid'");


//$data=mysqli_query($mysqli,"SELECT (`fid`+ ',' + `sid`) AS fac_id, FROM `ques` WHERE `br_code`='$br'");
?>
var graph_title = "<?php echo "Overall feedback of ".$spec_name." - ".$yr." Year ".$sm." Sem"; ?>";
var subjects=[<?php 
while($info=mysqli_fetch_array($data))
 {
 //$string= $info['fid']. $info['sid'];
     // echo '"'.$string.'",';
	 echo '"'.$info['sid'].'",'; 

	  }/* The concatenation operator '.' is used here to create string values from our database names. */
?>];

</script>

<script>
window.onload=function(){
zingchart.render({
    id:"myChart",
    width:"100%",
    height:"400",
    data:{
    "type":"bar3d",
	"plot":{
		valueBox:[
 	    {
 	      text:"%v\n%data-subjectnames\n%data-subjectname\n\n",
 	      placement: 'top'
 	    }],
		"bar-width":"60px"
	},
    "title":{
        "text":graph_title
    },
    "scale-x":{
       "values": myLabels,
	   //"values":mylabels1
          },
	 "scale-y": {
    "values": "0:100:10",
	},
    "series":[
        {
            "values":myData,
			"data-subjectnames":subjects,
			"data-subjectname":myLabels,
			 "tooltip":{
				"text":"%v\n%data-subjectnames\n%data-subjectname"
			}
        }
		
		
]
}
});
};
</script>
<!DOCTYPE html>
<html>
<style>
#mychart{
height:100%
}

</style>
	<head>
		<script src= "https://cdn.zingchart.com/zingchart.min.js"></script>
		<script> zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
		ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9","ee6b7db5b51705a13dc2339db3edaf6d"];</script></head>
	<body>
		<div id='myChart'></div>
		<br /><br />

		<div><a href='<?php echo $url; ?>' class='btn btn-primary'>Download Individual Reports</a></div>
	</body>
</html>
<?php
/* Close the connection */
require('footer.php');
$mysqli->close(); 
?>