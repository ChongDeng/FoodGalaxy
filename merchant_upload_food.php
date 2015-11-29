<?php

  if(isset($_GET["action"]) and $_GET["action"]=="getText"){
  	$res = merchant_upload_food( ); 
  	if($res == "success") 		
 		print 'success';
 	else 
 	    print $res; 	    
  	exit();  	
  }
 
  $filename;
  if(isset($_FILES["file"]["tmp_name"])){
		//定义文件存放的目录
		$dir = "temp_files/";
		//定义新的文件名,此处使用原文件名
		global $filename;		
		$filename = "temp".time()."_".$_FILES["file"]["name"];	
		global $filename;	
		//$filename = $_FILES["file"]["name"];
		//echo "<br>".$filename."<br>";	
		//使用move_uploaded_file()把上传的临时文件,移动到新目录
		if(move_uploaded_file($_FILES["file"]["tmp_name"],$dir.$filename)){
			echo "Success in uploading picture!";
			echo $_FILES["file"]["tmp_name"];
			
		}else{
			echo "Error, Please choose food picture!";		
		}
		unset($_FILES["file"]["tmp_name"]);
  }
  
  
 
  include_once ('food_galaxy_fns.php');
  // The shopping cart needs sessions, so start one 
   do_html_header("Upload New food");  
   
   

?>

<script type="text/javascript"> 
	function upload(){

		var has_uploaded_picture = "<?php
										$dir_name = "temp_files";
										$dir = scandir($dir_name);
										if(count($dir) == 2) echo "false";
				 						else echo count($dir);
									?>";
		
		if(has_uploaded_picture == "false"){
			alert("Error! Please upload the picture first!");
			return;
		}
		
		
		var name = document.getElementById("name").value;
		var price = document.getElementById("price").value;
		var description =  document.getElementById("description").value;	
		var category = document.getElementById("category").value;		
		var new_category = document.getElementById("new_category").value;
		var file_path = "<?php echo $filename;?>";		
		var merchant_id = "<?php session_start(); echo $_SESSION['valid_merchant'];?>";

		var post = "name=" + name + "&price=" + price + 
        "&description=" + description +"&category=" + category +
        "&new_category=" + new_category +"&file_path=" + file_path +
        "&merchant_id=" + merchant_id;
		var action = "action=getText";
		var url = "merchant_upload_food.php";
		//alert("merchant: " + merchant_id);
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
		//使用GET方法提交数据
		xmlHttp.open("POST",url+"?"+action,true);
		//发送HTTP头信息
		xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		//发送请求,此处与GET方法不同
		xmlHttp.send(post);
		//指定回调函数
		xmlHttp.onreadystatechange = function(){
			if(xmlHttp.readyState == 4){
				var text = xmlHttp.responseText;
				//alert("str:" + text);
											
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
		
<div class = "container">

		<form class="form-horizontal" id ="parent"  action="" method="post" enctype="multipart/form-data" name="sendfile">
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">Upload picture</label>
		    <div class="col-sm-8">
		      <input type="file" class="form-control" name="file" id="file_path" placeholder="Choose the file"></input>		      
		    </div>
		    <button type="submit" class="btn btn-primary col-sm-1">Upload</button>
		  </div>
		</form>
		
		<form action="" method="post" enctype="multipart/form-data" name="sendfile">
		  
		</form>
		
		  
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
   		//echo "<option value=\"".$row['food_category_id']."\">".$row['name']."</option>";
   		echo "<option>".$row['name']."</option>";				  
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
		  
		 
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button onclick="upload()" type="button" class="btn btn-primary">Submit</button>
		    </div>
		  </div>
		  
		  <div class="form-group" id="success_message" style="display:none;">
		    <div class="col-sm-offset-2 col-sm-10">
		    	<div class="alert alert-success">
		    		<h3>Success! <a href="food_of_merchant.php?merchant_id=<?php session_start(); echo $_SESSION['valid_merchant'];?>" >Click here to reiew your food</a></h3>
		    	</div>
		    </div>
		  </div>
		  
		   <div class="form-group" id="failure_message" style="display:none;">
		    <div class="col-sm-offset-2 col-sm-10">
		    	<div class="alert alert-danger">
		    		<h3>Failed! May by you haven't uploaded photos yet!</h3>
		    	</div>
		    </div>
		  </div>  
		  

		</form>
  </div>

<?php
  do_html_footer(); 
?>
<?php
	function merchant_upload_food(){
		require_once ('food_galaxy_fns.php');
		$catogery_name = $_POST['category'];
		
		//$sql = "insert into review values(NULL,'".$_POST['name']."','".$_POST['price']."','".$_POST['description']."','".$_POST['category']."','".$_POST['new_category']."','".$_POST['file_path']."')";
		
		$conn = db_connect();
		//turning off autocommit
  		$conn->autocommit(FALSE);
  		
		$quey; $result;
		if(trim($_POST['new_category'])){		//判断是否为空	
   			$query = "select * from food_category where name = '".trim($_POST['new_category'])."'";
   
   			$result = @$conn->query($query);
   			//千万不能这些写  if($result)	return "Error: Do not try to create an existent category";
			if (!$result) return  "Error: Can't execute query about name duplicating";
			if ($result->num_rows > 0)  return "Error: Do not try to create an existent category";
			else{
				$query = "insert into food_category values(NULL,	          							
	          							'".$_POST['new_category']."'
	         							)";
				$result = @$conn->query($query);
				if(!$result) return  "Error: Can't Create a new category";
				
				$query = "select name from food_category where food_category_id =
							(select max(food_category_id) from food_category)";
				$result = @$conn->query($query);   			
				if(!$result) return  "Error: Can't execute query of new category name";
				$row = $result->fetch_assoc();
				$catogery_name =  $row['name'];
			}
		}		
				
		$query = "insert into food values(NULL, 
	          							'".$catogery_name."', 
	          							'".$_POST['name']."', 
	          							'".$_POST['merchant_id']."', 
	          							'".$_POST['price']."',
	          							NULL,'".$_POST['description']."'
	         							)";
		//return $query;
		$result = @$conn->query($query);
		if(!$result) return  "Error: Can't add new food into database";
		
		$query = "select max(food_id) as max_food_id from food";
		$result = @$conn->query($query);   			
		if(!$result) return  "Error: Can't execute query of max food id";
		$row = $result->fetch_assoc();
		$max_food_id =  $row['max_food_id'];
		
		$file_to_be_delteted = "temp_files/".$_POST['file_path'];	
		$postfix = substr(strrchr($file_to_be_delteted, '.'), 1);
		$file_to_be_created = "img/".$max_food_id.".".$postfix;		
		//write_log("file: " + $file_to_be_created);	
		if(!copy($file_to_be_delteted, $file_to_be_created))
			return "Error: Can't create photo file in the corresponding dir";
		unlink($file_to_be_delteted);	
		
		//write_log("begin================");
		$array = file("sensitive_word_list.txt");
		foreach($array as $line){
			$key_word = trim($line);
			if(strpos($_POST['description'], $key_word) !== false){			
				
				$query = "insert into malign_according values(NULL, 
		          							1, 
		          							'".$max_food_id."'
		         							)";
				write_log($query);
				$result = $conn->query($query);
												
				if (!$result) return false;
				break;	 
			}	
		}
		// end transaction
		$conn->commit();
  		$conn->autocommit(TRUE);
  				
	    //write_log("end=======================");
		//return 
		//return $max_food_id." ".$file_to_be_delteted." " .$file_to_be_created;
		/*
		var post = "name=" + name + "&price=" + price + 
        "&description=" + description +"&category=" + category +
        "&new_category=" + new_category +"&file_path=" + file_path +
        "&merchant_id=" + merchant_id;
	   */
		//merchant_id
		//$sql = "insert into review values(NULL,'".$_POST['name']."','".$_POST['price']."','".$_POST['description']."','".$_POST['category']."','".$_POST['new_category']."','".$_POST['file_path']."')";
		//return $sql;
		return "success";
	} 
?>