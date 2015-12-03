<?php

// include function files for this application
require_once('food_galaxy_fns.php');
session_start();


//create short variable names
$username = $_POST['username'];
$passwd = $_POST['passwd'];
$type = $_POST['type'];

if ($username && $passwd) {
// they have just tried logging in
	
	$id = login($username, $passwd, $type);
	if($id != -1){
		write_log($username." logged in");
		if($type == 0)
    		$_SESSION['valid_user'] = $id;
    	else if($type == 1)
    		$_SESSION['valid_merchant'] = $id;
    	$_SESSION['name'] = $username;
    	do_html_header('Home Page');	
    	echo '<div class="form-group" id="success_message">
		    <div class="col-sm-offset-2 col-sm-8">
		    	<div class="alert alert-success">
		    		<h3> Log in Success! Now, you can use more service! </h3>
		    	</div>
		    </div>
		  </div>';    	
    	
	}
	else{
		echo '<div class="form-group" id="success_message">
		    <div class="col-sm-offset-2 col-sm-8">
		    	<div class="alert alert-danger">
		    		<h3> logged in Failure. <a href="login.php">Click here to log in again</a></h3>
		    	</div>
		    </div>
		  </div>';  
		
	}
	
  
}



do_html_footer();
?>
