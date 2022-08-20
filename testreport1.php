
<?php 
@session_start();
$fac = $_SESSION['user'];
/* Open connection to "feedback1" MySQL database. */
$mysqli = new mysqli("localhost", "root", "", "feedback1");
 
/* Check the connection. */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
require('header.php');
?>
<h3>Welcome <?php echo $_SESSION['user'];?></h3>
<div class="col-xs-12 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
                <div class="list-group">
                  <?php
                    $menu_id = 7;
                   require_once("submenu.php");
                  ?>
                </div>
              </div>

<?php
$br=$_SESSION['br_code'];
$faculty=array();
$average=array();
$query="SELECT `fid`,`avg` FROM `ques` WHERE `br_code`=?";
if ($stmt = $mysqli->prepare($query)) {
      $stmt->bind_param("s",$br);
		 if($stmt->execute()){  
         $stmt->bind_result($dat,$score);
	        $i=0;
         while ($stmt->fetch()) {
             $faculty[$i]=$dat;
	        $average[$i]=$score;
	           $i++;
	         }
	    }

}

?>
<script>
var myData=[<?php 
//while($info=mysqli_fetch_array($average))
  //echo '"'.$info.'",';
foreach($average as $item)
//echo ($a/($res1['count']*10)*100)
   echo $item.',';/* We use the concatenation operator '.' to add comma delimiters after each data value. */
?>];
<?php
//$data=mysqli_query($mysqli,"SELECT `fid`,`sid`,`avg` FROM `ques` WHERE `br_code`='5'");
?>
var myLabels=[<?php 
//while($info=mysqli_fetch_array($faculty))
  foreach($faculty as $item)
    echo '"'.$item.'",'; /* The concatenation operator '.' is used here to create string values from our database names. */
?>];

</script>

<script>
window.onload=function(){
zingchart.render({
    id:"myChart",
    width:"100%",
    height:"500",
    data:{
    "type":"bar",
    "title":{
        "text":"Data Representing Overall Feedback Of Faculties"
    },
    "scale-x":{
        "labels":myLabels
    },
	 "scale-y": {
    "values": "0:10:2"
  },
    "series":[
        {
            "values":myData
        }
]
}
});
};
</script>
<!DOCTYPE html>
<html>
	<head>
		<script src= "https://cdn.zingchart.com/zingchart.min.js"></script>
		<script> zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
		ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9","ee6b7db5b51705a13dc2339db3edaf6d"];</script></head>
	<body>
		<div id='myChart'></div>
	</body>
</html>
<?php
/* Close the connection */
require('footer.php');
$mysqli->close(); 
?>