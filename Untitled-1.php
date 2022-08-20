 <div class="container">
       <div class= "row">
	    <div class="col-md-4">&nbsp;</div>
		 <div class="col-md-4">
		 <div class="panel panel-primary">
		 <div class="panel-heading">GET OTP </div>
		 <div class="panel-body">
	   <form class="form-signin" role="form" action="reqotp.php" method="post">
	   <input type="text" class="form-control" placeholder="Admission Number" name="sid" pattern="[0-9]{5}[a-zA-Z]+[0-9]{4}" title="Only Alphabets, digits are allowed with a maximum of 10 characters" maxlength="10" required autofocus />
	   </br><input type="mail" class="form-control" placeholder="Email Address" name="email" required />
	   </br> <button class="btn btn-md btn-primary btn-block" type="submit">Request OTP</button>
		</div><!-- >end of panel body<!-->
		</div><!-- >end of panel<!-->
		</div>
	
		 <div class="col-md-4">&nbsp;</div>
		 </div>
 
	  </form> 