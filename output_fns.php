<?php

function do_html_header($title) {
  // print an HTML header
?>
  <html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css">
    
    <!-- 
    <link rel="icon" href="favicon.ico">     
    <link href="css/style.css" rel="stylesheet">
    
    <link rel="shortcut icon" href="https://www.wasify.com/assets/assets/favicon.ico">
    <link rel="apple-touch-icon" href="https://www.wasify.com/assets/assets/icons/apple-touch-icon-iphone.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="https://www.wasify.com/assets/assets/icons/apple-touch-icon-ipad.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="https://www.wasify.com/assets/assets/icons/apple-touch-icon-iphone-retina-display.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="https://www.wasify.com/assets/assets/icons/apple-touch-icon-ipad-retina-display.png" />
            -->
    
    
    <style>    	
    	body { padding-top: 70px; }
    	
    	.navbar-header .logo  { padding-top: 10px; }
    	
    </style>
  </head>

  <body>
  	<nav class="navbar navbar-inverse navbar-fixed-top">
  		<div class="container-fluid">
  			<div class="navbar-header logo">
  				<a  class="navbar-brand" href="#">
  					<img alt="Brand" src="img/logo.jpg" style="width: 100px">
  				</a>
  			</div>
  			
  			<ul class="nav navbar-nav">
  				<li class="active"><a href="#">Food Recommendation <span class="sr-only"></span></a></li>
  				<li><a href="#">Message Box</a></li>
  				<li class="dropdown"><a href="#"  class="dropdown-toggle" 
  				data-toggle="dropdown" role="button" aria-expanded="false">
  				Dropdown <span class="caret"></span></a>
		          <ul class="dropdown-menu" role="menu">
		            <li><a href="#">hello</a></li>		            
		            <li class="divider"></li>
		            <li><a href="#">world</a></li>		           
		          </ul>
        		</li>
  			</ul>
  			<form class="navbar-form navbar-left" role="search" action="show_food.php" method="get">
        		<div class="form-group">
          			<input type="text" class="form-control" name = "search_key" placeholder="Search food name, or category">
        		</div>
        		<button type="submit" class="btn btn-primary">Search</button>
      		</form>
      		<button type="button" class="btn btn-primary navbar-btn" data-toggle="modal" data-target="#login">
  				Log in
  			</button>
      		<button type="button" class="btn btn-primary navbar-btn navbar-right">Sign in</button>
      		<p class="navbar-text"><b>Welcome to Food Galaxy</b></p>
  		</div>
  	</nav>
  	
	<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content login">
          <img src="https://www.wasify.com/assets/images/isotipo.png" class="logo" alt="wasify">
          <h2>Log in to FoodGalaxy</h2>
          <form class="form-signin col-md-6 col-md-offset-3" role="form" method="post" action="login.php"> 
            <div class="form-signin">
              <label class="sr-only" for="email">Account email</label>
              <input type="text" class="form-control" id="email" name="email" maxlength="50" placeholder="Account email" value="">
              <label class="sr-only" for="pass">Password</label>
              <input type="password" class="form-control" id="pass" name="pass" maxlength="20" placeholder="Password" value="" data-toggle="fixed-tooltip"> 
            </div>
                        <br>
            <button class="btn btn-success btn-block" type="submit" name="commandLogin" value="1">Log in</button>
            <div class="loginLinks">
              <a href="https://manager.wasify.com/forgotten_password" rel="nofollow">Forgotten password?</a>
              <a href="#" rel="nofollow" data-toggle="modal" data-target="#signUp">Not a client yet? Try FoodGalaxy!</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  	
<?php
  if($title) {
    do_html_heading($title);
  }
}

function do_html_footer() {
  // print an HTML footer
?>
  <script src="http://apps.bdimg.com/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  </body>
  </html>
<?php
}

function do_html_heading($heading) {
  // print heading
?>
  <h2 align="center"><?php echo $heading;?></h2>
<?php
}

function do_html_URL($url, $name) {
  // output URL as link and br
?>
  <br /><a href="<?php echo $url;?>"><?php echo $name;?></a><br />
<?php
}

function display_site_info() {
  // display some marketing info
?>
  <ul>
  <li>This is food review web system!</li>
  <li>Enjoy it!</li>
  <li>Share your stories with others!</li>
  </ul>
<?php
}

function display_login_form() {
?>
  <p><a href="register_form.php">Not a member?</a></p>
  <form method="post" action="member.php">
  <table bgcolor="#cccccc">
   <tr>
     <td colspan="2">Members log in here:</td>
   <tr>
     <td>Username:</td>
     <td><input type="text" name="username"/></td></tr>
   <tr>
     <td>Password:</td>
     <td><input type="password" name="passwd"/></td></tr>
   <tr>
     <td colspan="2" align="center">
     <input type="submit" value="Log in"/></td></tr>
   <tr>
     <td colspan="2"><a href="forgot_form.php">Forgot your password?</a></td>
   </tr>
 </table></form>
<?php
}

function display_registration_form() {
?>
 <form method="post" action="register_new.php">
 <table bgcolor="#cccccc">
   
   <tr>
     <td>Username <br />(max 16 chars):</td>
     <td valign="top"><input type="text" name="username"
         size="16" maxlength="16"/></td></tr>
   <tr>
     <td>Password <br />(between 6 and 16 chars):</td>
     <td valign="top"><input type="password" name="passwd"
         size="16" maxlength="16"/></td></tr>
   <tr>
     <td>Confirm password:</td>
     <td><input type="password" name="passwd2" size="16" maxlength="16"/></td></tr>
   <tr>
     <td>Email address:</td>
     <td><input type="text" name="email" size="30" maxlength="100"/></td></tr>
   <tr>
     <td>Phone:</td>
     <td><input type="text" name="phone" size="30" maxlength="100"/></td></tr>
    
   <tr>
     <td colspan=2 align="center">
     <input type="submit" value="Register"></td></tr>
 </table></form>
<?php

}

function display_user_urls($url_array) {
  // display the table of URLs

  // set global variable, so we can test later if this is on the page
  global $bm_table;
  $bm_table = true;
?>
  <br />
  <form name="bm_table" action="delete_bms.php" method="post">
  <table width="300" cellpadding="2" cellspacing="0">
  <?php
  $color = "#cccccc";
  echo "<tr bgcolor=\"".$color."\"><td><strong>Bookmark</strong></td>";
  echo "<td><strong>Delete?</strong></td></tr>";
  if ((is_array($url_array)) && (count($url_array) > 0)) {
    foreach ($url_array as $url)  {
      if ($color == "#cccccc") {
        $color = "#ffffff";
      } else {
        $color = "#cccccc";
      }
      //remember to call htmlspecialchars() when we are displaying user data
      echo "<tr bgcolor=\"".$color."\"><td><a href=\"".$url."\">".htmlspecialchars($url)."</a></td>
            <td><input type=\"checkbox\" name=\"del_me[]\"
                value=\"".$url."\"/></td>
            </tr>";
    }
  } else {
    echo "<tr><td>No bookmarks on record</td></tr>";
  }
?>
  </table>
  </form>
<?php
}

function display_user_menu() {
  // display the menu options on this page
?>
<hr />
<a href="member.php">Home</a> &nbsp;|&nbsp;
<a href="add_bm_form.php">Add BM</a> &nbsp;|&nbsp;
<?php
  // only offer the delete option if bookmark table is on this page
  global $bm_table;
  if ($bm_table == true) {
    echo "<a href=\"#\" onClick=\"bm_table.submit();\">Delete BM</a> &nbsp;|&nbsp;";
  } else {
    echo "<span style=\"color: #cccccc\">Delete BM</span> &nbsp;|&nbsp;";
  }
?>
<a href="change_passwd_form.php">Change password</a>
<br />
<a href="recommend.php">Recommend URLs to me</a> &nbsp;|&nbsp;
<a href="logout.php">Logout</a>
<hr />

<?php
}

function display_add_bm_form() {
  // display the form for people to enter a new bookmark in
?>
<script type="text/javascript">
var myReq = getXMLHTTPRequest();
</script>
<form>
<table width="250" cellpadding="2" cellspacing="0" bgcolor="#cccccc">
<tr><td>New BM:</td>
<td><input type="text" id="new_url" name="new_url" value="http://"
     size="30" maxlength="255"/></td></tr>
<tr><td colspan="2" align="center">
    <input type="button" value="Add bookmark"
           onClick=" javascript:addNewBookmark();"/></td></tr>
</table>
</form>
<div id="displayresult"></div>
<?php
}

function display_password_form() {
  // display html change password form
?>
   <br />
   <form action="change_passwd.php" method="post">
   <table width="250" cellpadding="2" cellspacing="0" bgcolor="#cccccc">
   <tr><td>Old password:</td>
       <td><input type="password" name="old_passwd"
            size="16" maxlength="16"/></td>
   </tr>
   <tr><td>New password:</td>
       <td><input type="password" name="new_passwd"
            size="16" maxlength="16"/></td>
   </tr>
   <tr><td>Repeat new password:</td>
       <td><input type="password" name="new_passwd2"
            size="16" maxlength="16"/></td>
   </tr>
   <tr><td colspan="2" align="center">
       <input type="submit" value="Change password"/>
   </td></tr>
   </table>
   <br />
<?php
}

function display_forgot_form() {
  // display HTML form to reset and email password
?>
   <br />
   <form action="forgot_passwd.php" method="post">
   <table width="250" cellpadding="2" cellspacing="0" bgcolor="#cccccc">
   <tr><td>Enter your username</td>
       <td><input type="text" name="username" size="16" maxlength="16"/></td>
   </tr>
   <tr><td colspan=2 align="center">
       <input type="submit" value="Change password"/>
   </td></tr>
   </table>
   <br />
<?php
}

function display_recommended_urls($url_array) {
  // similar output to display_user_urls
  // instead of displaying the users bookmarks, display recomendation
?>
  <br />
  <table width="300" cellpadding="2" cellspacing="0">
<?php
  $color = "#cccccc";
  echo "<tr bgcolor=\"".$color."\">
        <td><strong>Recommendations</strong></td></tr>";
  if ((is_array($url_array)) && (count($url_array)>0)) {
    foreach ($url_array as $url) {
      if ($color == "#cccccc") {
        $color = "#ffffff";
      } else {
        $color = "#cccccc";
      }
      echo "<tr bgcolor=\"".$color."\">
            <td><a href=\"".$url."\">".htmlspecialchars($url)."</a></td></tr>";
    }
  } else {
    echo "<tr><td>No recommendations for you today.</td></tr>";
  }
?>
  </table>
<?php
}

?>
