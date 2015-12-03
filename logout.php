<?php
	session_start();
	
	$name = $_SESSION['name'];
	
	unset($_SESSION['valid_user']);
	unset($_SESSION['valid_merchant']);
	unset($_SESSION['name']);
	unset($_SESSION['valid_admin']);	
	session_destroy();	
	require_once('food_galaxy_fns.php');
	write_log($name." logged out");
	do_html_header('You have logged out');
?> 
 
<?php
 do_html_footer();
?>