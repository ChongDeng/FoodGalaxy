<?php
	include ('food_galaxy_fns.php');
  
   do_html_header("Recommended Food!");
   display_recommended_food( );   
   do_html_footer();
?>

<?php
	function display_recommended_food( ){
		
	   
	   $conn = db_connect();
	   $query = "select * from food_recommendation_view";	   
	   $result = @$conn->query($query);
	   
	   if (!$result){
	   		echo  "Error: Can't execute query about recommended food";
	   		return false;
	   } 	   
	   
	   $num = @$result->num_rows;
	   if($num == 0){	     
	      return false;
	   }	 
	   while($row = $result->fetch_assoc()){	   		
	   			echo "<div class=\"col-xs-12 col-sm-6 col-md-4\">
					  <div class=\"thumbnail\">
					    <a href=\"food_details.php?food_id=".$row['food_id']."\"><img src=\"img/".$row['food_id'].".jpg\" alt=\"...\"></a>
						<div class=\"caption\">
						  <h3><b>Name: </b>".$row['name']."</h3>
						  <p><b>Description: </b>".$row['description']."</p>
						   <p>
						      <a href=\"food_details.php?food_id=".$row['food_id']."\" class=\"btn btn-primary\" role=\"button\">View Details</a>				     			     
						   </p>
					      </div>
					  </div>
					</div>";   		
	   }  
	}

?>