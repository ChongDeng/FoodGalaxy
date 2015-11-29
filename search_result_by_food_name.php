<?php
   include ('food_galaxy_fns.php');   
   $search_key = $_GET['search_key'];
   do_html_header("Search Results: ".$search_key);
   display_search_result_by_name($search_key);   
   do_html_footer();
?>

<?php
	function display_search_result_by_name($search_key) {
		
	   // query database for the books in a category
	   if ((!$search_key) || ($search_key == '')) {
	     return false;
	   }
	   
	   $conn = db_connect();
	   $query = "select * from food;";	   
	   $result = @$conn->query($query);
	   
	   if (!$result){
	   		echo  "Error: Can't execute query about food";
	   		return false;
	   } 	   
	   
	   $num = @$result->num_rows;
	   if($num == 0){	     
	      return false;
	   }
	   $is_search_mached = false;  
	   while($row = $result->fetch_assoc()){
	   		if(strpos($row['name'], $search_key) !== false){
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
	   			$is_search_mached = true;
	   		}
	   }
	   
	   if(!$is_search_mached){
	   	 echo '<div class="form-group" id="success_message">
		    <div class="col-sm-offset-2 col-sm-8">
		    	<div class="alert alert-danger">
		    		<h3> No results!</h3>
		    	</div>
		    </div>
		  </div>';  
	   }	 
	}

?>