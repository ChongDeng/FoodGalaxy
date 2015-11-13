<?php

require_once('db_fns.php');

function register($username, $email, $password, $phone){
// register new person with db
// return true or error message

  // connect to db
  $conn = db_connect();

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

  return true;
}

function login($username, $password) {
// check username and password with db
// if yes, return true
// else throw exception

  // connect to db
  $conn = db_connect();

  // check if username is unique
  $result = $conn->query("select * from customer
                         where name = '".$username."'
                         and password = sha1('".$password."')");
  if (!$result) {
     throw new Exception('Could not log you in.');
  }

  if ($result->num_rows>0) {
     return true;
  } else {
     throw new Exception('Could not log you in.');
  }
}

?>
