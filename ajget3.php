<?php
@session_start();
require('cgs.php');
require('data.php');
$obj= new CGS();

if(!empty($_POST['fac'])){
  
  $res = $obj->getList2($reg,$cr,$br,$yr,$sem,$_POST['fac']);
  echo $res;
}



?>