<?php
	session_start();
	unset($_SESSION['valid_user']);
	unset($_SESSION['valid_merchant']);
	unset($_SESSION['name']);	
	session_destroy();
	
	require_once('food_galaxy_fns.php');
	do_html_header('You have logged out');
?> 
 
<?php
 do_html_footer();
?>