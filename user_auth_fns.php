<?php

require_once('db_fns.php');

function register($username, $email, $password, $phone, $address, $type){
// register new person with db
// return true or error message

	// connect to db
	$conn = db_connect();
 	if($type == 0){
		// check if username is unique
	  	$result = $conn->query("select * from customer where name='".$username."'");
	  	if (!$result) {
	    	throw new Exception('Could not execute query');
	  	}
	
	  	if ($result->num_rows>0) {
	    	throw new Exception('That username is taken - go back and choose another one.');
	  	}
	
	  	// if ok, put in db
	  	$result = $conn->query("insert into customer values(NULL, '".$username."', sha1('".$password."'), '".$email."', '".$phone."')");
	  	if (!$result) {
	    	throw new Exception('Could not register you in database - please try again later.');
	  	}
  	}
  	else if($type == 1){
  		// check if username is unique
	  	$result = $conn->query("select * from merchant where name='".$username."'");
	  	if (!$result) {
	    	throw new Exception('Could not execute query');
	  	}
	
	  	if ($result->num_rows>0) {
	    	throw new Exception('That username is taken - go back and choose another one.');
	  	}
	
	  	// if ok, put in db
	  	$query = "insert into merchant values( NULL, 
	          							'".$username."', 
	          							'".sha1($password)."',
	          							'".$email."', 
	          							'".$address."',	          							
	          							'".$phone."',
	          							NULL,
	          							NULL,
	          							NULL
	         							)";	
	  	write_log($query);  	
	  	$result = $conn->query($query);
	  	if (!$result) {
	    	throw new Exception('Could not register you in database - please try again later.');
	  	}  
  	}
    
  return true;
}

function login($username, $password, $type) {
	
	$conn = db_connect();
	if($type == 0){
		  		// check if username is unique
	  	$result = $conn->query("select * from customer
	                         where name = '".$username."'
	                         and password = sha1('".$password."')");
	  	if(!$result)  return -1;
	 
	 
	  	if($result->num_rows>0) {
	  		$row = $result->fetch_assoc();
	     	return $row['customer_id'];     
	  	} 
	  	else 
	  		return -1;
  	}
	else if($type == 1){
		  		// check if username is unique
	  	$result = $conn->query("select * from merchant
	                         where name = '".$username."'
	                         and password = sha1('".$password."')");
	  	if(!$result)  return -1;
	 
	 
	  	if($result->num_rows>0) {
	  		$row = $result->fetch_assoc();
	     	return $row['merchant_id'];     
	  	} 
	  	else 
	  		return -1;
  	}
  
}

?>
