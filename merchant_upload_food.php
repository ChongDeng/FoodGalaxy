<?php
  include ('food_galaxy_fns.php');
  // The shopping cart needs sessions, so start one 
   do_html_header("Upload New food");  
   
   /*
   if(isset($_FILES["file"]["tmp_name"])){
	//�����ļ���ŵ�Ŀ¼
	$dir = "uploader/";
	//�����µ��ļ���,�˴�ʹ��ԭ�ļ���
	$filename = $_FILES["file"]["name"];
	//ʹ��move_uploaded_file()���ϴ�����ʱ�ļ�,�ƶ�����Ŀ¼
	if(move_uploaded_file($_FILES["file"]["tmp_name"],$dir.$filename)){
		echo "�ϴ��ļ��ɹ�!";
		echo $_FILES["file"]["tmp_name"];
	}else{
		echo "�ϴ��ļ�ʧ��!";		
	}
	
}
*/

?>

<script type="text/javascript"> 
	function upload(){
		
		name = document.getElementById("name").value;
		price = document.getElementById("price").value;
		description =  document.getElementById("description").value;	
		var category = document.getElementById("category").value;		
		var new_category = document.getElementById("new_category").value;
		var file_path = document.getElementById("file_path").value;

		alert("file_path: " + file_path);
		
		if(new_category == '')
			alert("1");
		else
			alert("2");
	}
</script>		
		
<div class = "container">
		<form class="form-horizontal" id ="parent"  action="" method="post" enctype="multipart/form-data" name="sendfile">
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">Food Name </label>
		    <div class="col-sm-10">
		      <input type="title" class="form-control" id="name" placeholder="Please enter the name">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">Food Price </label>
		    <div class="col-sm-10">
		      <input type="title" class="form-control" id="price" placeholder="Please enter the price">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputPassword3" class="col-sm-2 control-label">Food Description </label>
		    <div class="col-sm-10">
		      <textarea rows="5" type="content" class="form-control" id="description" placeholder="Please enter the description"></textarea>
		    </div>
		  </div>
		  
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">Food Category</label>
		    <div class="col-sm-10">
			      <select class="form-control" id="category">
<?php
	$conn = db_connect();	
    $query = "select * from food_category";
    //echo $query;
	$result = @$conn->query($query);
	//echo $result->num_rows;
   	while($row = $result->fetch_assoc())   		
   		echo "<option value=\"".$row['food_category_id']."\">".$row['name']."</option>";				  
?>
			  	</select>
		    </div>
		  </div>		  

		  
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">Or, create a new category</label>
		    <div class="col-sm-10">
		      <input type="title" class="form-control" id="new_category" placeholder="Please enter the new category">
		    </div>
		  </div> 
		  
		 <div class = "container">		
		  <div class="form-group">
		    <label for="file_path" class="col-sm-4 control-label">Choose the photo file</label>
		    <div class="col-sm-4">
		      <input type="file" class="form-control" id="file_path" name="file">
		    </div>		  
		  </div>	
  		</div>
		  
		  <br><br>
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button onclick="upload()" type="button" class="btn btn-primary">Submit</button>
		    </div>
		  </div>
		  
		  <div class="form-group" id="success_message" style="display:none;">
		    <div class="col-sm-offset-2 col-sm-10">
		    	<div class="alert alert-success">
		    		<h3>Success! <a href="food_details.php?food_id=<?php echo $_GET["food_id"];?>" >Click here to reiew your comments</a></h3>
		    	</div>
		    </div>
		  </div>
		  
		   <div class="form-group" id="failure_message" style="display:none;">
		    <div class="col-sm-offset-2 col-sm-10">
		    	<div class="alert alert-danger">
		    		<h3>Failed! Please try again!</h3>
		    	</div>
		    </div>
		  </div>  
		  

		</form>
  </div>
  






<?php
  do_html_footer(); 
?>