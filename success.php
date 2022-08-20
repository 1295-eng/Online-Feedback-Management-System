<?php
@session_start();
if(!empty($_SESSION['user']) && !empty($_SESSION['priv'])){
echo "login success";
}
echo $_SESSION['user'];
echo $_SESSION['priv'];

?>