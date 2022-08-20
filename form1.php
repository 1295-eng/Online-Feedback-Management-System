<?php
@session_start();
require('header.php');
if(!empty($_SESSION['user']) && !empty($_SESSION['priv']) && $_SESSION['priv']="student"){
?>
 

<div class="col-xs-12 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
                <div class="list-group">
                  <?php
                    $menu_id = 1;
                    require_once("menu2.php");
                  ?>
                </div>
              </div>

				<div class="col-sm-2">&nbsp;
				</div>
                 <p>The Feedback form for this semester is inactive</p>
				
               


<?php
          require('footer.php');

}
//else {
 //header('Location: index.php');
//}


 ?>