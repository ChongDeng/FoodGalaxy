<?php

function get_foods_of_category($search_key) {
	
   // query database for the books in a category
   if ((!$search_key) || ($search_key == '')) {
     return false;
   }
   
   $conn = db_connect();
   $query = "select * from food where catogery_name = '".$search_key."'";
   
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   
   $num_books = @$result->num_rows;
   if ($num_books == 0) {
      return false;
   }   
   $result = db_result_to_array($result);
   return $result;
}

function display_foods_of_category($food_array) {
	//display all books in the array passed in
  	if (!is_array($food_array)) {
    	echo "<p>No Foods currently available in this category</p>";
  	} 
  	else{
		while(count($food_array) >= 3){
	  		$obj1 = $food_array[0];
	  		$obj2 = $food_array[1];
	  		$obj3 = $food_array[2];
	  		//echo $obj1['food_id'].$obj2['food_id'].$obj3['food_id'];
	  	
		  	echo "<div class=\"col-xs-12 col-sm-6 col-md-4\">
			  <div class=\"thumbnail\">
			    <a href=\"food_details.php?food_id=".$obj1['food_id']."\"><img src=\"img/".$obj1['food_id'].".jpg\" alt=\"...\"></a>
				<div class=\"caption\">
				  <h3>".$obj1['name']."</h3>
				  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. 
				   Donec id elit non mi porta gravida at eget metus.
				   Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
				   <p>
				      <a href=\"food_details.php?food_id=".$obj1['food_id']."\" class=\"btn btn-primary\" role=\"button\">View Details</a> 
				      <a href=\"#\" class=\"btn btn-default\" role=\"button\">Button</a>				     
				   </p>
			      </div>
			  </div>
			</div>
			
			<div class=\"col-xs-12 col-sm-6 col-md-4\">
			  <div class=\"thumbnail\">
			    <a href=\"food_details.php?food_id=".$obj2['food_id']."\"><img src=\"img/".$obj2['food_id'].".jpg\" alt=\"...\"></a>
				<div class=\"caption\">
				  <h3>".$obj2['name']."</h3>
				  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. 
				   Donec id elit non mi porta gravida at eget metus.
				   Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
				   <p>
				      <a href=\"food_details.php?food_id=".$obj2['food_id']."\" class=\"btn btn-primary\" role=\"button\">View Details</a> 
				      <a href=\"#\" class=\"btn btn-default\" role=\"button\">Button</a>				     
				   </p>
			     </div>
			  </div>
			</div>
			<div class=\"col-xs-12 col-sm-6 col-md-4\">
			  <div class=\"thumbnail\">
			    <a href=\"food_details.php?food_id=".$obj3['food_id']."\"><img src=\"img/".$obj3['food_id'].".jpg\" alt=\"...\"></a>
				<div class=\"caption\">
				  <h3>".$obj3['name']."</h3>
				  <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. 
				   Donec id elit non mi porta gravida at eget metus.
				   Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
				   <p>
				      <a href=\"food_details.php?food_id=".$obj3['food_id']."\" class=\"btn btn-primary\" role=\"button\">View Details</a> 
				      <a href=\"#\" class=\"btn btn-default\" role=\"button\">Button</a>				     
				   </p>
			     </div>
			  </div>
			</div>";
		  	array_shift($food_array);	
		  	array_shift($food_array);
		  	array_shift($food_array);
	  	}	
  	}
  	echo "<hr />";
}

?>