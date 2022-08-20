<?php
require_once('cgs.php');

$obj= new CGS();

if(!empty($_POST['reg']) && !empty($_POST['course']) && !empty($_POST['spec']) && !empty($_POST['year']) && !empty($_POST['sem']) ){  
  $res = $obj->getFeedsSelectTag($_POST['reg'],$_POST['course'],$_POST['spec'],$_POST['year'],$_POST['sem']);
  echo $res;
}

?>