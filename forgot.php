<?php
require('header.php');
?>

 <div class= "row">
	    <div class="col-md-4">&nbsp;</div>
		 <div class="col-md-4">
		 <div class="panel panel-primary">
		 <div class="panel-heading">Forgot Password </div>
		 <div class="panel-body">
	   <form class="form-signin" role="form" action="reqotp.php" method="post">
	   </br><input type="mail" class="form-control" placeholder="Email Address" name="email" required />
       </br><input type="text" class="form-control" placeholder="Username/Admission number" name="uid" required />
	   </br> <button class="btn btn-md btn-primary btn-block" type="submit">Request OTP</button>
		</div><!-- >end of panel body<!-->
		</div><!-- >end of panel<!-->
		</div>
	
		 <div class="col-md-4">&nbsp;</div>
		 </div>
 
	  </form>

<?php
require('footer.php');
?>