<?php
	require_once('food_galaxy_fns.php'); 
	do_html_header("Cusomter's complaints!"); 
?>

<?php
	$conn = db_connect();   
    
    $query = "select food_name, content, date, name from
			(
				customer				 
					natural join					
				(select name as food_name, content, date, customer_id
				 from (food join complaint on food_id = target_id) 
				 where merchant_id = ".$_GET['merchant_id']." and type = 0) as y 
			)";
   
    //echo $query;
	$result = @$conn->query($query);
	if($result->num_rows == 0)
		echo '<div class="form-group" id="success_message">
		    <div class="col-sm-offset-2 col-sm-8">
		    	<div class="alert alert-success">
		    		<h3> Great, no complaints from customers! </h3>
		    	</div>
		    </div>
		  </div>'; 
   	while($row = $result->fetch_assoc()){
   	
   		
   		echo "<div class=\"blog-post\">
            	<h4 class=\"blog-post-title\">"."<b>Food name: ".$row['food_name']."</b></h2>
            		<p class=\"blog-post-meta\">by <a href=\"#\">".$row['name']."</a>,at ".$row['date']."</p>
            		<p>".$row['content']."</p>            
              </div>"; 
   	    echo "<hr>";		
   	}
   	
?>

<?php
	do_html_footer();
?>