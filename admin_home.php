<?php

// include function files for this application
require_once('food_galaxy_fns.php');
session_start();


//create short variable names
$username = $_POST['username'];
$passwd = $_POST['passwd'];

if ($username && $passwd) {
// they have just tried logging in
	
	$id = admin_login($username, $passwd);
	if($id != -1){
		
    	$_SESSION['valid_admin'] = $username;
    	$_SESSION['name'] = $username;
    	do_html_header('Home Page');	
    	echo '<div class="form-group" id="success_message">
		    <div class="col-sm-offset-2 col-sm-8">
		    	<div class="alert alert-success">
		    		<h3> Administrator log in Success! Now, you can manage the system! </h3>
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

<?php
function admin_login($username, $password, $type) {
	include_once('db_fns.php');
	$conn = db_connect();
	
	$result = $conn->query("select * from admin
	                         where username = '".$username."'
	                         and password = sha1('".$password."')");
	
	if(!$result)  return -1;	 
	 
	if($result->num_rows>0) return 0;
	
	return -1;
  
}

?>
