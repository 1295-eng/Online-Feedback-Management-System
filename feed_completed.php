
<html>
<head>
<link href="css/bootstrap.min_1.css" rel="stylesheet" type="text/css">
<link href="css/tableexport.min.css" rel="stylesheet" type="text/css">

</head>
<body>



<?php 
@session_start();
$host= "localhost";
$user = "root";
$password = "";
$dbname = "feedback1";
require('header.php');
// Create connection
$conn = new mysqli($host, $user, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$br=$_SESSION['br_code'];  ?>
<h3>Welcome <?php echo $_SESSION['user'];?></h3>
 <div class="col-xs-12 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
                <div class="list-group">
                 <?php
                    $menu_id = 5;
                   require_once("submenu.php");
                  ?>
                </div>
              </div>
     
		  <h4 align="center">Feedback Submitted table</h4> 
           <div class="container">
      <table id="data2" class="table table-bordered" style="width:900px">
     <tr><th>Regulation</th><th>Branch</th><th>Year</th><th>Sem</th><th>From-date</th><th>To-date</th></tr>
     <tbody>          
  <?php   
  date_default_timezone_set("Asia/Kolkata");
$today = date("Y-m-d\TH:i",time());
  $branch=$_SESSION['br'];         
$sql = "SELECT * FROM `activation` WHERE `branch`='$br' AND `to_date`<'$today'  ORDER BY `from_date` ASC";
$result = $conn->query($sql);

//echo "<table>";
//echo "<tr><th>Regulation</th><th>Branch</th><th>Year</th><th>Sem</th><th>From-date</th><th>To-date</th></tr>";

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       // echo "regulation: " . $row["regulation"]. " - branch: " . $row["branch"]. " " . $row["lastnam"]. "<br>";
	   echo "<tr><td>";
	   echo $row['regulation'];
	   echo "</td><td>";
	   echo $row['branch'];
	   echo "</td><td>";
	    echo $row['year'];
	   echo "</td><td>";
	    echo $row['sem'];
	   echo "</td><td>";
	    echo $row['from_date'];
	   echo "</td><td>";
	    echo $row['to_date'];
	   echo "</td></tr>"; 
	    }
		?>
         </tbody>
		</table>
        </div>
        <script src="js/bootstrap.min_1.js" type="text/javascript"></script> 
    <script src="js/FileSaver.min.js" type="text/javascript"></script>    
    <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>    
    <script src="js/tableexport.min.js" type="text/javascript"></script>           
       <script>
	   $('#data2').tableExport();
	   
	   </script> 
       <?php
} else {
    echo "0 results";
}
$conn->close();

require('footer.php');;
?>

</body>
</html>
