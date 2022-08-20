<?php 
require('header.php');
?>

	  <br /><br />
	 <div class="container">
	  <div class="row">
	   <!-- <h3 class="form-signin-heading">Please Login here...</h3><br/>-->
         <div class="col-md-3">&nbsp;
		 </div>
		 <div class="col-md-3">
		 <div class="panel panel-success">
		 <div class="panel-heading">Student Login</div>
		 <div class="panel-body">
		 <form class="form-signin" role="form" action="student.php" method="post"><br/><br/>
                
          				<div class="input-group">
          				  <span class="input-group-addon" id="sizing-addon2"><i class="glyphicon glyphicon-user text-primary"></i></span>
          				  <input type="text" class="form-control" placeholder="Admission Number" name="sid" pattern="[0-9]{2}[0-9a-ZA-Z]{2}[0-9]{1}[a-zA-Z]+[0-9]{4}" title="Only Alphabets, digits are allowed with a maximum of 10 characters" maxlength="10" required autofocus />
          				</div><br/>
          				<div class="input-group">
          				  <span class="input-group-addon" id="sizing-addon2"><i class="glyphicon glyphicon-lock"></i></span>
          				  <input type="password" class="form-control" placeholder="Password" name="pwd" required />
          				</div>
                 <br/>
                 <button class="btn btn-md btn-primary btn-block" type="submit">Log in</button>
                 
               </form>
               <br />
               <p align="right"><a href="forgot.php"> Forgot Password?</a></p>
			   <br />
			   Username: &nbsp; Roll_NO
			   <br />
			   Password: &nbsp;&nbsp; Roll_NO
			   </div>
			   </div>
         </div>
           <div class="col-md-3">
		   &nbsp;
            </div>
          
		  <div class="col-md-3">&nbsp;
        </div>
		</div>
      </div> <!-- /container -->

<?php

require('footer.php');

?>