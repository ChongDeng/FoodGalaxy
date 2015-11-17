<?php
	include ('food_galaxy_fns.php');
	do_html_header("Manage malign accordings");
	
	display_malign_customer_reviews();
	display_malign_merchant_food();
	
?>   	

	
		

<?php
	 do_html_footer(); 
?>

<?php
	function display_malign_customer_reviews(){
		echo "<h3>Malign reviews made by customers:</h3>";
		
		$conn = db_connect();	
	    $query = "select review.author_id as user_id, name, title, content, date
				  from malign_according,review,customer
				  where malign_according.target_id = review.review_id and malign_according.type = 0 and review.author_id = customer.customer_id";	    
		$result = @$conn->query($query);		
	   	while($row = $result->fetch_assoc()){
			echo " <form class=\"form-horizontal\" id =\"parent\">
		  				<div class=\"form-group\">		    
		    				<div class=\"blog-post col-sm-5\">
	            				<h4 class=\"blog-post-title\">Title: ".$row['title']."</h2>
	            				<p class=\"blog-post-meta\">".$row['date']." by <a href=\"#\">".$row['name']."</a></p>
	            				<p>Content: ".$row['content']."</p>            
	              			</div>	              			      
		      				<a href=\"send_warning_message.php?user_id=".$row['user_id']."\" class=\"col-sm-1 btn btn-primary\" role=\"button\">Send Message</a>
		    				<button onclick=\"review_process()\" type=\"button\" class=\"col-sm-1 btn btn-primary\">Set black list</button>		    				
		    				
		  				</div>		  
					</form>
					<hr>";
		    
	   		/*
	   		echo "<div class=\"blog-post\">
	            	<h4 class=\"blog-post-title\">Title: ".$row['title']."</h2>
	            		<p class=\"blog-post-meta\">".$row['date']." by <a href=\"#\">".$row['name']."</a></p>
	            		<p>Content: ".$row['content']."</p>            
	              </div>"; 
	   	    echo "<hr>";
	   	    */		
	   	}
	}

	function display_malign_merchant_food(){
		echo "<h3>Malign food information made by merchants:</h3>";
		
		$conn = db_connect();	
	    $query = "select food.name as food_name,merchant.name as merchant_name, description 
				  from food, malign_according, merchant
				  where malign_according.target_id = food.food_id and malign_according.type = 1 and merchant.merchant_id = food.merchant_id";	    
		$result = @$conn->query($query);		
	   	while($row = $result->fetch_assoc()){	   	
	   		echo " <form class=\"form-horizontal\" id =\"parent\">
		  				<div class=\"form-group\">		    
		    				<div class=\"blog-post col-sm-5\">
	            				<h4 class=\"blog-post-title\">Food: ".$row['food_name']."</h2>
	            				<p class=\"blog-post-meta\">Merchant: <a href=\"#\">".$row['merchant_name']."</a></p>
	            				<p>Food Decrption: ".$row['description']."</p>           
	              			</div>	              			      
		      				<button onclick=\"send_warning_message()\" type=\"button\" class=\"col-sm-1 btn btn-primary\">Send message</button>
		    				<button onclick=\"review_process()\" type=\"button\" class=\"col-sm-1 btn btn-primary\">Set black list</button>		    				
		    				 		    			
		  				</div>		  
					</form>
					<hr>"; 
	   	    echo "<hr>";		
	   	}
	} 
?>