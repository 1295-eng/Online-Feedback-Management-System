<?php

use Phppot\DataSource;
require_once 'DataSource.php';
$db = new DataSource();
$conn = $db->getConnection();

if (isset($_POST["import"]) && !empty($_POST["whoisit"]) && $_POST["whoisit"]=="student") {
    
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            
            $sid = "";
            if (isset($column[0])) {
                $sid = mysqli_real_escape_string($conn, $column[0]);
            }
            $email = "";
            if (isset($column[1])) {
                $email = mysqli_real_escape_string($conn, $column[1]);
            }
            $spass = "";
            if (isset($column[2])) {
                $spass = mysqli_real_escape_string($conn, $column[2]);
            }
            $privilege = "";
            if (isset($column[3])) {
                $privilege = mysqli_real_escape_string($conn, $column[3]);
            }
            $cr_code = "";
            if (isset($column[4])) {
                $cr_code = mysqli_real_escape_string($conn, $column[4]);
            }
            $regulation = "";
            if (isset($column[5])) {
                $regulation = mysqli_real_escape_string($conn, $column[5]);
            }
            $year = "";
            if (isset($column[6])) {
                $year = mysqli_real_escape_string($conn, $column[6]);
            }
            $sem = "";
            if (isset($column[7])) {
                $sem = mysqli_real_escape_string($conn, $column[7]);
            }
            $br_code = "";
            if (isset($column[8])) {
                $br_code = mysqli_real_escape_string($conn, $column[8]);
            }
            $staus = "";
            if (isset($column[9])) {
                $status = mysqli_real_escape_string($conn, $column[9]);
            }
            $otp_status = "";
            if (isset($column[10])) {
                $otp_status = mysqli_real_escape_string($conn, $column[10]);
            }
            $feedback_status = "";
            if (isset($column[11])) {
                $feedback_status = mysqli_real_escape_string($conn, $column[11]);
            }
            $sqlInsert = "INSERT IGNORE into st_login (sid,email,spass,privilege,cr_code,regulation,year,sem,br_code,status,otp_status,feedback_status)
                   values (?,?,?,?,?,?,?,?,?,?,?,?)";
            $paramType = "sssssssssiii";
            $paramArray = array(
                $sid,
                $email,
                $spass,
                $privilege,
                $cr_code,
                $regulation,
                $year,
                $sem,
                $br_code,
                $status,
                $otp_status,
                $feedback_status
            );
            $insertId = $db->insert($sqlInsert, $paramType, $paramArray);
            
            if (! empty($insertId)) {
                $type = "success";
                $message = "Students CSV Data Imported into the Database Successfully!";
            } else {
                $type = "error";
                $message = "Problem in Importing CSV Data";
            }
        }
    }
}

if (isset($_POST["import"]) && !empty($_POST["whoisit"]) && $_POST["whoisit"]=="faculty") {
    
    $fileName = $_FILES["filefac"]["tmp_name"];
    
    if ($_FILES["filefac"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            
            $fname = "";
            if (isset($column[0])) {
                $fname = mysqli_real_escape_string($conn, $column[0]);
            }
            $br_code = "";
            if (isset($column[1])) {
                $br_code = mysqli_real_escape_string($conn, $column[1]);
                $br_code = str_pad($br_code,2,'0', STR_PAD_LEFT);
            }
            $branch = "";
            if (isset($column[2])) {
                $branch = mysqli_real_escape_string($conn, $column[2]);
            }
            $fuser = "";
            if (isset($column[3])) {
                $fuser = mysqli_real_escape_string($conn, $column[3]);
            }            
            $fpass = "";
            if (isset($column[4])) {
                $fpass = mysqli_real_escape_string($conn, $column[4]);
            }
            $email = "";
            if (isset($column[5])) {
                $email = mysqli_real_escape_string($conn, $column[5]);
            } 

            $sqlInsert = "INSERT IGNORE INTO `fac_login`(`fname`, `br_code`, `branch`, `fuser`, `fpass`, `privilege`, `email`, `otp_status`) VALUES (?,?,?,?,?,'staff',?,1)";
            $paramType = "ssssss";
            $paramArray = array(
                $fname,
                $br_code,
                $branch,
                $fuser,
                $fpass,
                $email
            );
            $insertId = $db->insert($sqlInsert, $paramType, $paramArray);
            
            if (! empty($insertId)) {
                $type = "success";
                $message = "Faculty CSV Data Imported into the Database Successfully!";
            } else {
                $type = "error";
                $message = "Problem in Importing Faculty CSV Data";
            }
        }
    }
}
?>
<?php
	@session_start();
	if(!empty($_SESSION['user']) && !empty($_SESSION['priv'])&& $_SESSION['priv']="hod"){
		
		require_once('header.php');
		require_once('cgs.php');
		$cgs_obj = new CGS;
		$dep  = $cgs_obj->getdep($_SESSION['user']);
		$reg=$cgs_obj->getReg1();
		//$_SESSION['fac_sub'] = array(); 
		//var_dump($_SESSION['fac_sub']);
		
	?>
<script src="jquery-1.12.4.js"></script>
<script src="jquery-ui.js"></script>
<script src="js/jquery-3.1.1.min.js"></script>
<h3>Welcome <?php echo $_SESSION['user'];?></h3>
<div class="container-fluid">

		<div class="row row-offcanvas row-offcanvas-left">
			
			<div class="col-xs-12 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
                <div class="list-group">
					<?php
						$menu_id = 556;
						require_once("menu.php");
					?>
				</div>
			</div><!--/span-->
    
    <div class="outer-scontainer">
    <h2>Import Students Details</h2>
        <br>

            <form class="form-horizontal" action="" method="post"
                name="frmCSVImport" id="frmCSVImport"
                enctype="multipart/form-data">
                <div class="input-row">
                     <input type="file" name="file"
                        id="file" accept=".csv">
                        <br>
                        <input type="hidden" name="whoisit" value="student" />
                    <button type="submit" id="submit" name="import"  class='btn btn-success'
                        class="btn-submit">Import</button>
                    <br />

                </div>

            </form>
            <br><br>

            <h2>Import Faculty Details</h2>
        <br>

            <form class="form-horizontal" action="" method="post"
                name="frmCSVImp" id="frmCSVImp"
                enctype="multipart/form-data">
                <div class="input-row">
                     <input type="file" name="filefac"
                        id="filefac" accept=".csv">
                        <br>
                        <input type="hidden" name="whoisit" value="faculty" />
                    <button type="submit" id="submit" name="import"  class='btn btn-success'
                        class="btn-submit">Import</button>
                    <br />

                </div>

            </form>            
            <h4>
            <center>
             <div id="response" style="color:green"
                class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>">
                <?php if(!empty($message)) { echo $message; } ?>
            </div>
               </h4>         
        </center>
    </div>
    <script type="text/javascript">
$(document).ready(function() {
    $("#frmCSVImport").on("submit", function () {

	    $("#response").attr("class", "");
        $("#response").html("");
        var fileType = ".csv";
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
        if (!regex.test($("#file").val().toLowerCase())) {
        	    $("#response").addClass("error");
        	    $("#response").addClass("display-block");
            $("#response").html("Invalid File. Upload : <b>" + fileType + "</b> Files.");
            return false;
        }
        return true;
    });
    $("#frmCSVImp").on("submit", function () {

        $("#response").attr("class", "");
        $("#response").html("");
        var fileType = ".csv";
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
        if (!regex.test($("#filefac").val().toLowerCase())) {
                $("#response").addClass("error");
                $("#response").addClass("display-block");
            $("#response").html("Invalid File. Upload : <b>" + fileType + "</b> Files.");
            return false;
        }
        return true;
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