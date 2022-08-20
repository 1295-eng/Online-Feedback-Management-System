

<?php

require('cgs.php');

$obj= new CGS();

$a=$_POST['branch'];

if(!empty($_POST['branch'])){
  
  $res = $obj->getF1All($_POST['branch']);
  echo $res;
}



?>