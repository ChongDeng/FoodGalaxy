<?php
 require_once('food_galaxy_fns.php');
 do_html_header('Welcome to Food Galaxy, please login');

 //display_site_info(); 
 ?> 

 
 
<div class = "container">
	<form class="form-horizontal" method="post" action="home.php">		
		<div class="form-group">
			<label for="inputEmail3" class="col-sm-2 control-label">Username</label>
		    <div class="col-sm-10">
		    	<input type="text" class="form-control" name="username" placeholder="">
		    </div>
		</div>
		
		  <div class="form-group">
		    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
		    <div class="col-sm-10">
		      <input type="password" class="form-control" name="passwd" placeholder="">
		    </div>
		  </div>
		  
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">Login as:</label>
		    	<div class="col-sm-10">
			    	<select class="form-control" name="type"> 		
   						<option value="0">Customer</option>
   						<option value="1">Merchant</option>
			  		</select>
		    	</div>
		  	</div>
		  	
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <div class="checkbox">
		        <label>
		          <input type="checkbox"> Remember me
		        </label>
		        <label for="inputEmail3" class=" control-label"><a href="register_form.php"><b>Not a member?</b></a></label>
		        <label for="inputEmail3" class=" control-label"><a href="forgot_form.php"><b>Forgot your password?</b></a></label>
		      </div>
		    </div>
		  </div>
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button type="submit" class="btn btn-primary">Sign in</button>
		    </div>
		  </div>
		</form>
  </div>

 
<?php
 do_html_footer();
?>