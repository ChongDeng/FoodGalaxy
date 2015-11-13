<?php
 require_once('food_galaxy_fns.php');
 session_start();
 $food_id = $_GET['food_id'];
 do_html_header();

 if($_GET[review_content]){
 	write_review($_GET[review_content]);
 }
 
 $food_info = get_food_details($food_id);
 display_food_details($food_info);
 
 display_food_reviews($food_info);
 
 
 do_html_footer();
?>

<?php
function display_food_details($food_info){

echo 	"<div class=\"panel panel-default\">	     
	      <div class=\"panel-heading\">Food information</div>
	      <div class=\"panel-body\">
	        <p><b>Food description:</b>".$food_info[0]['description']."</p>
	      </div>	     
	      <table class=\"table\">
	       
	        <tbody>
	          <tr>
	            <td>Name: </td>   <td>".$food_info[0]['name']."</td>
	          </tr>
	          <tr>
	            <td>Category: </td>  <td>".$food_info[0]['catogery_name']."</td>
	          </tr>
	          <tr>
	            <td>Merchant Name: </td>  <td>".$food_info[0]['merchant_id']."</td>
	          </tr>
	          <tr>
	            <td>Price: </td>  <td>".$food_info[0]['price']."</td>
	          </tr>
	          <tr>
	            <td>Popularity Level: </td>  <td>".$food_info[0]['popularity_level']."</td>
	          </tr>
	        </tbody>
	      </table>
	</div>";

}

function display_food_reviews($food_info){
	
	echo "<b>Reviews made by customers</b>:\n";
	
	echo "<hr>";
	
	echo "<form role=\"form\" action=\"food_details.php?food_id=".$food_info[0][food_id]."\" method=\"get\">
  			<div class=\"form-group\">
    			<label for=\"name\">Write youre reveiw:</label>
    			<textarea class=\"form-control\" rows=\"3\" name = \"review_content\"></textarea>    			 			
  			</div>
  			<div class=\"form-group\">
    			<button type=\"submit\" class=\"btn btn-primary\">Submit</button>       			
  			</div>
		</form>";
}

function get_food_details($food_id) {
	
   // query database for the books in a category
   if ((!$food_id) || ($food_id == '')) {
     return false;
   }
   
   $conn = db_connect();
   $query = "select * from food where food_id = '".$food_id."'";
   
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

function write_review($review_content){
	// query database for the books in a category
   if(!$review_content)   return false;
  
   $conn = db_connect();
   
    // if ok, put in db
  $result = $conn->query("insert into review values(NULL, '".$username."', sha1('".$password."'), '".$email."', '".$phone."')");
  if (!$result) {
    throw new Exception('Could not register you in database - please try again later.');
  }

  return true;
}

?>