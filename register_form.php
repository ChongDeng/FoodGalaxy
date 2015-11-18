<?php
 require_once('food_galaxy_fns.php');
 do_html_header('Registration');
?> 

	
	
	<div class = "container">
		<form class="form-horizontal"  action="register_new.php" method="post">		
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Username (max 16 chars):</label>
		    	<div class="col-sm-10">
		    		<input type="text" class="form-control" name="username" placeholder="" size="16" maxlength="16">
		    	</div>
			</div>
		
		  	<div class="form-group">
		    	<label for="inputPassword3" class="col-sm-2 control-label">Password (between 6 and 16 chars):</label>
		    	<div class="col-sm-10">
		      		<input type="password" class="form-control" name="passwd" placeholder="" size="16" maxlength="16">
		    	</div>
		  	</div>
		  	<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Confirm password:</label>
		    	<div class="col-sm-10">
		    		<input type="password" class="form-control" name="passwd2" placeholder="" size="16" maxlength="16">
		    	</div>
			</div>
		
		  	<div class="form-group">
		    	<label for="inputPassword3" class="col-sm-2 control-label">Email address:</label>
		    	<div class="col-sm-10">
		      		<input type="text"  class="form-control" name="email" placeholder="" size="30" maxlength="100">
		    	</div>
		  	</div>
		  	
		  	<div class="form-group">
		    	<label for="inputPassword3" class="col-sm-2 control-label">Phone:</label>
		    	<div class="col-sm-10">
		      		<input type="text" class="form-control" name="phone" placeholder="" size="30" maxlength="100">
		    	</div>
		  	</div>
		  	
		  	<div class="form-group">
		    	<label for="inputPassword3" class="col-sm-2 control-label">Address (Required for merchnts*):</label>
		    	<div class="col-sm-10">
		      		<input type="text" class="form-control" name="address" placeholder="" size="30" maxlength="100">
		    	</div>
		  	</div>		  	
		  	
		  	
		  	<div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">Register as:</label>
		    	<div class="col-sm-10">
			    	<select class="form-control" name="type"> 		
   						<option value="0">Customer</option>
   						<option value="1">Merchant</option>
			  		</select>
		    	</div>
		  	</div>	
		  	
		  
		  	<div class="form-group">
		    	<div class="col-sm-offset-2 col-sm-10">
		      		<button type="submit" class="btn btn-primary">Register</button>
		    	</div>
		  	</div>
		</form>
  	</div>
  	
 
<?php
 do_html_footer();
?>