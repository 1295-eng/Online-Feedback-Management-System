<?php
@session_start();
if(!empty($_SESSION['user']) && !empty($_SESSION['priv'])){
include('header.php');

 if( $_SESSION['priv']=="hod"){
                    $menu_id = 4;
                    require_once("menu.php");
					}
					else {
					$menu_id=2;
					require_once("menu1.php");
					} 
					
			}		
?>
<?php


include('footer.php');
?>
