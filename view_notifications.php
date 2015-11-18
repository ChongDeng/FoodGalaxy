<?php
	
 	include ('food_galaxy_fns.php');
	do_html_header("Notifications sent by administrator");
	
	display_notifications();
?> 

<?php
  do_html_footer(); 
?>

<?php
	
 	function display_notifications(){
 		
 		$type = null; $target_id = null;
 		if($_GET['user_id']){ 	
			$type = 0;
			$target_id = $_GET['user_id'];
 		}
		else if($_GET['merchant_id']){ 
			$type = 1;
			$target_id = $_GET['merchant_id'];
		}
		
		$conn = db_connect();	
	    $query = "select content, date from notification
	              where type = '".$type."' and target_id = '".$target_id."'";
	    
		$result = @$conn->query($query);		
	   	while($row = $result->fetch_assoc()){
			echo " <form class=\"form-horizontal\" id =\"parent\">
		  				<div class=\"form-group\">		    
		    				<div class=\"blog-post col-sm-5\">
	            				
	            				<p class=\"blog-post-meta\">".$row['date']." by <a href=\"#\">System Admnistrator</a></p>
	            				<p>Notification: ".$row['content']."</p>            
	              			</div>	              			      
		      				
		  				</div>		  
					</form>
					</div>
					<hr>";
	   	}
 	}
?> 