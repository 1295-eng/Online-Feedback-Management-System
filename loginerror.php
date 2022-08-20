
	<script type='text/javascript'>
	alert('Username and/or Password is incorrect. Please Try again.');
  	document.location.href = "index.php";	
	</script>;

<!--

//<?php 
//require('header.php');
//?>

 <div class="container">
       <div class="row">
	    <h3 class="form-signin-heading">Please Login here...</h3><br/>
		<h3 style="color:red">please enter valid credentials..</h3>
         <div class="col-md-3">&nbsp;
		 </div>
		 <div class="col-md-3">
		 <div class="panel panel-success">
		 <div class="panel-heading">Student</div>
		 <div class="panel-body">
		 <form class="form-signin" role="form" action="student.php" method="post"><br/><br/>
                
          				<div class="input-group">
          				  <span class="input-group-addon" id="sizing-addon2"><i class="glyphicon glyphicon-user text-primary"></i></span>
          				  <input type="text" class="form-control" placeholder="Username" name="sid" pattern="[0-9]{5}[a-zA-Z]+[0-9]{4}" title="Only Alphabets, digits are allowed with a maximum of 10 characters" maxlength="10" required autofocus />
          				</div><br/>
          				<div class="input-group">
          				  <span class="input-group-addon" id="sizing-addon2"><i class="glyphicon glyphicon-lock"></i></span>
          				  <input type="password" class="form-control" placeholder="Password" name="pwd" required />
          				</div>
                 <br/>
                 <button class="btn btn-md btn-primary btn-block" type="submit">Log in</button>
               </form>
			   </div>
			   </div>
         </div>
           <div class="col-md-3">
		   <div class="panel panel-success">
		 <div class="panel-heading">Staff/ Admin</div>
		 <div class="panel-body">
               <form class="form-signin" role="form" action="staff.php" method="post"><br/><br/>
                
          				<div class="input-group">
          				  <span class="input-group-addon" id="sizing-addon2"><i class="glyphicon glyphicon-user text-primary"></i></span>
          				  <input type="text" class="form-control" placeholder="Username" name="sname" required autofocus />
          				</div><br/>
          				<div class="input-group">
          				  <span class="input-group-addon" id="sizing-addon2"><i class="glyphicon glyphicon-lock"></i></span>
          				  <input type="password" class="form-control" placeholder="Password" name="spwd" required />
          				</div>
                 <br/>
                 <button class="btn btn-md btn-primary btn-block" type="submit">Log in</button>
               </form>
			   </div>
			   </div>
            </div>
          
		  <div class="col-md-3">&nbsp;
        </div>
      </div> <!-- /container -->

//<?php

//require('footer.php');

//?>
-->