<?php
	if(isset($_GET["action"]) and $_GET["action"]=="getText"){
	  	$res = merchant_update_food( ); 
	  	if($res == "success") 		
	 		print 'success';
	 	else 
	 	    print $res; 	    
	  	exit();  	
  	}
  
	include_once ('food_galaxy_fns.php');
 	do_html_header("Food details"); 
 
 	$food_name = null;
 	$food_price = null;
 	$food_description = null;
 	display_food_info();
?>

<script type="text/javascript"> 
	function update_food(){
		
		var name = document.getElementById("name").value;
		var price = document.getElementById("price").value;
		var description =  document.getElementById("description").value;		
		var food_id = "<?php echo $_GET['food_id'];?>";		

		var post = "name=" + name + "&price=" + price + 
        "&description=" + description+"&food_id="+food_id;
        
		var action = "action=getText";
		var url = "merchant_food_details.php";

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


<div class = "container">
		
		<form class="form-horizontal" id ="parent"  action="" method="post">
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">Food Name </label>
		    <div class="col-sm-10">
		      <input type="title" class="form-control" id="name" value="<?php global $food_name; echo $food_name;?>">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">Food Price </label>
		    <div class="col-sm-10">
		      <input type="title" class="form-control" id="price" value="<?php global $food_price; echo $food_price;?>">
		    </div>
		  </div>
		  
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">Popularity Level</label>
		    <div class="col-sm-10">
		      <label class="control-label">Five Star</label>
		    </div>
		  </div>
		  
		  <div class="form-group">
		    <label for="inputPassword3" class="col-sm-2 control-label">Food Description </label>
		    <div class="col-sm-10">
		      <textarea rows="5" type="content" class="form-control" id="description"><?php global $food_description; echo $food_description;?></textarea>
		    </div>
		  </div>
		  

		 
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button onclick="update_food()" type="button" class="col-sm-3 btn btn-primary">Save</button>
		    </div>
		  </div>
		  
		  <div class="form-group" id="success_message" style="display:none;">
		    <div class="col-sm-offset-2 col-sm-10">
		    	<div class="alert alert-success">
		    		<h3>Food Udpating Success!<a href="food_of_merchant.php?merchant_id=<?php session_start(); echo $_SESSION['valid_merchant'];?>">Click here to go back</a></h3>
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

<?php
  function display_food_info(){
  	require_once ('food_galaxy_fns.php');	
	
	$conn = db_connect();
	$quey = null; $result = null;
	$food_id = $_GET['food_id'];
	$query = "select name, price, description  from food where food_id = '".$_GET['food_id']."'";
	//echo "sql: ".$query."<br>";   
   	$result = @$conn->query($query);
   	if (!$result) echo  "Error: Can't execute query about name duplicating";
   	//echo "result: ".$result->num_rows."<br>";
	if ($result->num_rows > 0){
		$row = $result->fetch_assoc();
		
		global $food_name, $food_price, $food_description;
		$food_name = $row['name'];
		$food_price = $row['price'];
		$food_description = $row['description'];
	}
  } 
  
	function merchant_update_food(){		
		require_once ('food_galaxy_fns.php');	
	
		$food_id = $_POST['food_id'];
		$food_name = $_POST['name'];
		$food_price = $_POST['price'];
		$food_description = $_POST['description'];
		
		$conn = db_connect();
		$quey = null; $result = null;
	

		$query = "update food 
				 set name = '".$food_name."', price = '".$food_price."', description ='".$food_description."'
				 where food_id = ".$food_id;
		//write_log("update food: ".$query);
		//return $query;
		$result = @$conn->query($query);
		if(!$result) return  "Error: Can't add update food info";
		return "success";
  	}
  	
  	
?>


