<?php  
   include_once('food_galaxy_fns.php'); 
   do_html_header("Food of Merchant:");  
   
   if($_GET['delete_food_id']){
   	 if(!delete_food($_GET['delete_food_id']))
   	 	echo "Error: Failed to delete food";   	 	
   }
   
    display_food_of_merchant(); 
?>



<?php 
   do_html_footer();
?>

<?php
	
	function delete_food($food_id){
		require_once ('food_galaxy_fns.php');
		
		$conn = db_connect();
		$quey = null; $result = null;
		$merchant_id = $_GET['merchant_id'];	
		$query = "delete from food where food_id = '".$food_id."'";
		$result = @$conn->query($query);
	   	if (!$result){
	   		echo  "Error: Can't delete food from database";
	   		return false;
	   	}
	   	$filename = "img/".$food_id.".jpg";
	   	unlink($filename);
		return true;
	} 
	
	function display_food_of_merchant(){
		require_once ('food_galaxy_fns.php');
			
		$conn = db_connect();
		$quey = null; $result = null;
		$merchant_id = $_GET['merchant_id'];	
		$query = "select food_id from food where merchant_id = '".$merchant_id."'";
		$result = @$conn->query($query);
	   	if (!$result) echo  "Error: Can't execute query about food list of merchant";
	   	while($row = $result->fetch_assoc()){   			
	   			echo "<div class=\"col-xs-12 col-sm-6 col-md-4\">
				  <div class=\"thumbnail\">
				    <a href=\"merchant_food_details.php?food_id=".$row['food_id']."\"><img src=\"img/".$row['food_id'].".jpg\" alt=\"...\"></a>
					<div class=\"caption\">
					  <h3>".$row['name']."</h3>
					  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. 
					   Donec id elit non mi porta gravida at eget metus.
					   Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
					   <p>
					      <a href=\"merchant_food_details.php?food_id=".$row['food_id']."\" class=\"btn btn-primary\" role=\"button\">View & Edit</a> 
					      <a href=\"food_of_merchant.php?merchant_id=".$merchant_id."&delete_food_id=".$row['food_id']."\" class=\"btn btn-primary\" role=\"button\">Delete this food</a>				     
					   </p>
				      </div>
				  </div>
				</div>";
			  	array_shift($food_array);
	   	}
	}
?>


 
