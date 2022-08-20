<?php
$backup_dir = "./backup";
if(!file_exists($backup_dir)){
mkdir($backup_dir);
}

$dates1 = "./backup/".date('M_Y');
if(!file_exists($dates1)){
mkdir($dates1);
}

$d = $dates1."/".date('d_m_Y_H_i_s');
date_default_timezone_set('Asia/Kolkata');
$cmd = "mysqldump -h localhost -u root feedback1 > ".$d.".sql";
//$a = shell_exec($cmd);
exec($cmd,$a,$b);
//var_dump($a);
if($b==0){
$res = "success";
}
else{
$res = "error";
}

?>

<html>
<body>
<table width='100%' border='0' cellspacing='0' cellpadding='0'>
<tbody>
<tr> 
<td align='center'>
</td> 
</tr> 
<tr> 
<td height='85' align='center'>
<br>
<table width='80%' border='0' cellpadding='0' cellspacing='1' bgcolor='#CCCCCC'> 
<tbody>
<tr> 
<td bgcolor='#CCCCCC'>
<table width='100%' border='0' cellpadding='6' cellspacing='0' bgcolor='#FFFFFF'> 
<tbody>
<tr> 
<td colspan='2' align='left' valign='bottom'>
<span style='	font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #666666;'>Please wait while Redirecting...
</span>
</td> 
</tr> 
<tr valign='top'> 
<td colspan='2' align='left'>
<table width='100%' border='0' cellspacing='0' cellpadding='0'> 
<tbody>
<tr> 
<td width='87%' bgcolor='#cccccc' height='1' align='center'>
</td> 
</tr>
</tbody>
</table>
</td> 
</tr> 
<tr> 
<td width='60%' align='left' valign='bottom'>
<table width='95%' border='0' cellpadding='1' cellspacing='0' bgcolor='#FFFFFF'> 
<tbody>
<tr> 
<td align='right' valign='top'>
</td> 
<td class='bodytxt'>&nbsp;
</td> 
</tr> 
<tr> 
<td align='right' valign='top'> 
<li style='color:#FF9900'>
</li>
</td> 
<td>The server will take about 1 to 5 seconds to redirect. 
<br /> 
<br />
</td> 
</tr> 
<tr> 
<td align='right' valign='top'>
<li style='color:#FF9900;'>
</li>
</td> 
<td>Please do not press 'Submit' button once again or the 'Back' or 'Refresh' buttons. 
</td> 
</tr>
</tbody>
</table>
</td> 
</tr>
</tbody>
</table>
</td> 
</tr>
</tbody>
</table>
</td> 
</tr>
</tbody>
</table>
<form action='backupdata.php' method='POST' >
<input type='hidden' name='id' value="<?php echo $res; ?>" />
<script language='javascript'>document.forms[0].submit()
</script>
</form>
</body>
</html>