
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
$br=$_SESSION['br_code'];
?>
<div class="col-xs-12 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
                <div class="list-group">
                  <?php
                    $menu_id = 7;
                   require_once("submenu.php");
                  ?>
                </div>
              </div>

<?php

$data=mysqli_query($mysqli,"SELECT `fid`,`avg` FROM `ques` WHERE `br_code`='$br'");


?>
<script>
var myData=[<?php 
while($info=mysqli_fetch_array($data))
    echo $info['avg'].','; /* We use the concatenation operator '.' to add comma delimiters after each data value. */
?>];
<?php
$data=mysqli_query($mysqli,"SELECT `fid`,`sid`,`avg` FROM `ques` WHERE `br_code`='$br'");
?>
var myLabels=[<?php 
while($info=mysqli_fetch_array($data))
    echo '"'.$info['fid'].'",'; /* The concatenation operator '.' is used here to create string values from our database names. */
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