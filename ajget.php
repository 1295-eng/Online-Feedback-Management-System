<?php
require('cgs.php');

$obj= new CGS();

if(!empty($_POST['fid'])&&!empty($_POST['course'])){
  
  $res = $obj->getList($_POST['fid'],$_POST['course']);
  echo $res."".$_POST['fid'];
}



?>