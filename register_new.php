<?php
  // include function files for this application
  require_once('food_galaxy_fns.php');

  //create short variable names
  $email=$_POST['email'];
  $username=$_POST['username'];
  $passwd=$_POST['passwd'];
  $passwd2=$_POST['passwd2'];
  $phone=$_POST['phone'];
  $type = $_POST['type'];
  $address = $_POST['address'];
  // start session which may be needed later
  // start it now because it must go before headers
  session_start();
  try   {
    // check forms filled in
    /*
    if (!filled_out($_POST)) {
      throw new Exception('You have not filled the form out correctly - please go back and try again.');
    }
    */

    // email address not valid
    if (!valid_email($email)) {
      throw new Exception('That is not a valid email address.  Please go back and try again.');
    }

    // passwords not the same
    if ($passwd != $passwd2) {      
      throw new Exception('The passwords you entered do not match - please go back and try again.');
    }

    // check password length is ok
    // ok if username truncates, but passwords will get
    // munged if they are too long.
    if ((strlen($passwd) < 6) || (strlen($passwd) > 16)) {
      throw new Exception('Your password must be between 6 and 16 characters Please go back and try again.');
    }

    // attempt to register
    // this function can also throw an exception   
    register($username, $email, $passwd, $phone, $address, $type);
    // register session variable
    /*
    if($type == 0)
    	$_SESSION['valid_user'] = $username;
    else if($type == 1)
    	$_SESSION['valid_merchant'] = $username;
	*/
    // provide link to members page
    do_html_header('Registration successful');
    //echo 'Your registration was successful.  Now, you can use more service!';
    echo '<div class="form-group" id="success_message">
		    <div class="col-sm-offset-2 col-sm-8">
		    	<div class="alert alert-success">
		    		<h3>Registration Success! <a href="login.php">Please click here to log in</a></h3>
		    	</div>
		    </div>
		  </div>';
    //do_html_url('member.php', 'Go to member page');

   // end page
   do_html_footer();
  }
  catch (Exception $e) {
     do_html_header('Problem!');
     echo $e->getMessage();
     do_html_footer();
     exit;
  }
?>
