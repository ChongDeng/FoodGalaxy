<?php

	if($_POST['user_id'] || $_POST['merchant_id']) { 			
 		$res = add_to_black_list(); 
 		header('Content-Type:text/html;charset=GB2312');
 		if($res == "success") 		
	 		print 'success';
	 	else 
	 	    print $res;		  
	  	exit();  
 	}
 	
	include ('food_galaxy_fns.php');
	do_html_header("Manage malign accordings");
	
	display_malign_customer_reviews();
	display_malign_merchant_food();
	
?>  
	
	<script type="text/javascript"> 
	function block_user(id, type){
		//alert("arg: " + id);					
		
		var post = null;
		if(type == 0)		
			post = "user_id=" + id + "&type=" + type;
		else if(type == 1)
			post = "merchant_id=" + id + "&type=" + type;
		
		var action = "action=getText";
		var url = "view_malign_accordings.php";

		var xmlHttp = false;
		try {
			xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){
		  	try{
		  		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
			}catch(E){
				xmlHttp = false;
			}
		}
		if(!xmlHttp && typeof XMLHttpRequest != 'undefined') {
			xmlHttp = new XMLHttpRequest();
		}
	
		xmlHttp.open("POST",url+"?"+action,true);
		
		xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		
		xmlHttp.send(post);
		
		xmlHttp.onreadystatechange = function(){
			if(xmlHttp.readyState == 4){
				var text = xmlHttp.responseText;
				//alert("str: " + text);
				
				if(text == "success"){
					$("#success_message").show();
					$("#failure_message").hide();
				}
				else{
					$("#success_message").hide();
					$("#failure_message").show();
				}
												
			}
		}
		
	}
	</script>

<?php
	 do_html_footer(); 
?>

<?php
	function display_malign_customer_reviews(){
		echo "<h3>Malign reviews made by customers:</h3>";
		echo '
			<div>
				<div class="form-group" id="success_message" style="display:none;">
				    <div class="col-sm-10">
				    	<div class="alert alert-success">
				    		<h3>Set Success!</h3>
				    	</div>
				    </div>
		  		</div>
		  
				<div class="form-group" id="failure_message" style="display:none;">
					<div class="col-sm-10">
				    	<div class="alert alert-danger">
				    		<h3>Failed! Please try again!</h3>
				    	</div>
				    </div>
				</div> ';
		$conn = db_connect();	
	    $query = "select review.author_id as user_id, name, title, content, date
				  from malign_according,review,customer
				  where malign_according.target_id = review.review_id and malign_according.type = 0 and review.author_id = customer.customer_id
				  order by malign_accord_id desc";	    
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
		    				<button onclick=\"block_user(".$row['user_id'].",0)\" type=\"button\" class=\"col-sm-1 btn btn-primary\">Set black list</button>		    				
		    				
		  				</div>		  
					</form>
					</div>
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
	    $query = "select food.name as food_name,merchant.name as merchant_name, description, merchant.merchant_id as merchant_id 
				  from food, malign_according, merchant
				  where malign_according.target_id = food.food_id and malign_according.type = 1 and merchant.merchant_id = food.merchant_id
				  order by malign_accord_id desc";	    
		$result = @$conn->query($query);		
	   	while($row = $result->fetch_assoc()){	   	
	   		echo " <form class=\"form-horizontal\" id =\"parent\">
		  				<div class=\"form-group\">		    
		    				<div class=\"blog-post col-sm-5\">
	            				<h4 class=\"blog-post-title\">Food: ".$row['food_name']."</h2>
	            				<p class=\"blog-post-meta\">Merchant: <a href=\"#\">".$row['merchant_name']."</a></p>
	            				<p>Food Decrption: ".$row['description']."</p>           
	              			</div>	              			      
		      				<a href=\"send_warning_message.php?merchant_id=".$row['merchant_id']."\" class=\"col-sm-1 btn btn-primary\" role=\"button\">Send Message</a>
		    				<button onclick=\"block_user(".$row['merchant_id'].",1)\" type=\"button\" class=\"col-sm-1 btn btn-primary\">Set black list</button>		    				
		    				 		    			
		  				</div>		  
					</form>
					<hr>"; 
	   	    		
	   	}
	} 
	
	function add_to_black_list(){
		$type = null; $target_id = null;
		if($_POST['user_id']){
			$type = 0;
			$target_id = $_POST['user_id'];
		}
		else if($_POST['merchant_id']){
			$type = 1;
			$target_id = $_POST['merchant_id'];			
		}
		
		require_once ('food_galaxy_fns.php');
		$conn = db_connect();
		$query = "insert into malign_person values(NULL, 
	          							'".$type."', 
	          							'".$target_id."', 
	          							NULL          							
	         							)";		
   		$result = @$conn->query($query);   		
		if (!$result) return  "Error: can't add to black list";		
		
		return "success";
	}
	
?>