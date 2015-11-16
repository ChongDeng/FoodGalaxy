<?php
 require_once('food_galaxy_fns.php'); 
 session_start();
 $food_id = $_GET['food_id'];
 do_html_header();

 
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
	
	$food_id = $food_info[0]['food_id'];
	
	echo "<div class=\"form-group\">    			
    			<a href=\"write_food_review.php?food_id=".$food_id."\" class=\"btn btn-primary\" role=\"button\">Write Review</a>        			
  		   </div>
   	       <div class=\"form-group\">    			
    			<a href=\"write_complaints.php?food_id=".$food_id."&customer_id=1\" class=\"btn btn-primary\" role=\"button\">Write Complaints</a>        			
  		   </div>";
	
	echo "<h3>Reviews made by customers:</h3>";
	
	$conn = db_connect();	
    $query = "select * from review where type = 0 and target_id = '".$food_id."'";
    //echo $query;
	$result = @$conn->query($query);
	//echo $result->num_rows;
   	while($row = $result->fetch_assoc()){
   		
   		$query2 = "select name from customer where customer_id = '".$row['author_id']."'";
   		$result2 = @$conn->query($query2);
   		$row2 = $result2->fetch_assoc();
   		$name = $row2['name'];
   		
   		
   		echo "<div class=\"blog-post\">
            	<h4 class=\"blog-post-title\">".$row['title']."</h2>
            		<p class=\"blog-post-meta\">".$row['date']." by <a href=\"#\">".$name."</a></p>
            		<p>".$row['content']."</p>            
              </div>"; 
   	    echo "<hr>";		
   	}
   	
   	echo "<div class=\"form-group\">    			
    			<a href=\"write_food_review.php?food_id=".$food_id."\" class=\"btn btn-primary\" role=\"button\">Write Review</a>        			
  		   </div>
   	       <div class=\"form-group\">    			
    			<a href=\"write_complaints.php?food_id=".$food_id."&customer_id=1\" class=\"btn btn-primary\" role=\"button\">Write Complaints</a>        			
  		   </div>";
   /*
          
	echo "<hr>";
	
	echo "<form role=\"form\" >
  			<div class=\"form-group\">
    			<label for=\"name\">Write youre reveiw:</label>
    			<textarea class=\"form-control\" rows=\"3\" id = \"review_content\"></textarea>    			 			
  			</div>
  			<div class=\"form-group\">
    			<button onclick=\"review_write(".$food_info[0]['food_id'].")\" class=\"btn btn-primary\">Submit</button>       			
  			</div>
		</form>";
		*/
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


?>

<script type="text/javascript">
function review_write(food_id){
	
	var action = "action=getText";
	var url = "write_food_review.php";
    var foodid = food_id;
    var review_content = document.getElementById("review_content").value;
	//type = 0;  0 食物; 1 厂家
    var author_id = 1;	
	post = "food_id="+foodid+"&review_content="+review_content+"&type=0"+"&author_id="+author_id;
	//alert("1");
	//使用GET方法提交数据
	xmlHttp.open("POST",url+"?"+action,false);
	//发送HTTP头信息
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//发送请求,此处与GET方法不同
	//alert("2");
	xmlHttp.send(post);
	//alert("3");
	//指定回调函数
	xmlHttp.onreadystatechange = function(){		
		if(xmlHttp.readyState == 4){
			//alert("3.1");			
			var text = xmlHttp.responseText;
			//alert("content: " + text);
			if(text == "success"){
				alert("success");
			}
			else
				alert("text: " + text);
			/*
			if(text == "success"){
				
				var r=confirm("Press a button!");
				if (r==true){
				  alert("You pressed OK!");
				}
				els{
				  alert("You pressed Cancel!");
				}
				
				alert("success!");								
			}
			else
				alert("Failed!");
			 */
    		//document.getElementById("show_content").innerHTML = text;
		}				  
	}	
	//alert("5");	
}
</script>