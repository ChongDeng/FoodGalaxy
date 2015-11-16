<?php
	if(isset($_GET["action"]) and $_GET["action"]=="getText"){
	  	$res = update_merchant_info_DB( ); 
	  	if($res == "success") 		
	 		print 'success';
	 	else 
	 	    print $res; 	    
	  	exit();  	
  	}
  
	include_once ('food_galaxy_fns.php');
 	do_html_header("Merchant Information"); 
 
 	
 	$merchant_address = null;
    $merchant_phone3 = null;
    $merchant_phone2 = null;
    $merchant_phone1 = null;
    $merchant_name = null;
    display_merchant_info();
?>

<script type="text/javascript"> 
	function update_merchant_info(){
		
		var name = document.getElementById("name").value;
		var address = document.getElementById("address").value;
		
		var phone1 =  document.getElementById("phone1").value;
		var phone2 =  document.getElementById("phone2").value;
		var phone3 =  document.getElementById("phone3").value;	
					
		var merchant_id = "<?php echo $_GET['merchant_id'];?>";		

		var post = "name=" + name + "&address=" + address + 
        "&phone1=" + phone1+"&phone2="+phone2 + "&phone3=" + phone3
        + "&merchant_id=" + merchant_id;
		//alert("post: " + post);
        
		var action = "action=getText";
		var url = "merchant_info_details.php";

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
		    <label for="inputEmail3" class="col-sm-2 control-label">Merchant Name </label>
		    <div class="col-sm-10">
		      <input type="title" class="form-control" id="name" value="<?php global $merchant_name; echo $merchant_name;?>">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label"> Phone1 </label>
		    <div class="col-sm-10">
		      <input type="title" class="form-control" id="phone1" value="<?php global $merchant_phone1; echo $merchant_phone1;?>">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label"> Phone2 </label>
		    <div class="col-sm-10">
		      <input type="title" class="form-control" id="phone2" value="<?php global $merchant_phone2; echo $merchant_phone2;?>">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label"> Phone3 </label>
		    <div class="col-sm-10">
		      <input type="title" class="form-control" id="phone3" value="<?php global $merchant_phone3; echo $merchant_phone3;?>">
		    </div>
		  </div>
		  
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">Popularity Level</label>
		    <div class="col-sm-10">
		      <label class="control-label">Five Star</label>
		    </div>
		  </div>
		  
		  <div class="form-group">
		    <label for="inputPassword3" class="col-sm-2 control-label">Merchant Address </label>
		    <div class="col-sm-10">
		      <textarea rows="5" type="content" class="form-control" id="address"><?php global $merchant_address; echo $merchant_address;?></textarea>
		    </div>
		  </div>
		  

		 
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button onclick="update_merchant_info()" type="button" class="col-sm-3 btn btn-primary">Save</button>
		    </div>
		  </div>
		  
		  <div class="form-group" id="success_message" style="display:none;">
		    <div class="col-sm-offset-2 col-sm-10">
		    	<div class="alert alert-success">
		    		<h3>Merchant Information Updation Success!</a></h3>
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
  function display_merchant_info(){
  	require_once ('food_galaxy_fns.php');	
	
	$conn = db_connect();
	$quey = null; $result = null;
	$merchant_id = $_GET['merchant_id'];
	
	$query = "select * from merchant where merchant_id = '".$merchant_id."'";	
   	$result = @$conn->query($query);
   	if (!$result) echo  "Error: Can't execute query about merchant information";
   	
	if ($result->num_rows > 0){
		$row = $result->fetch_assoc();
		
		global $merchant_address, $merchant_phone3, $merchant_phone2, $merchant_phone1, $merchant_name;
		$merchant_address = $row['address'];
		$merchant_phone3 = $row['phone3'];
		$merchant_phone2 = $row['phone2'];
		$merchant_phone1 = $row['phone1'];
		$merchant_name = $row['name'];
		//echo $merchant_address." ".$merchant_phone3." ".$merchant_phone2." ".$merchant_phone1." ".$merchant_name;
	}
  } 
  
	function update_merchant_info_DB(){		
		require_once ('food_galaxy_fns.php');	
	
		$merchant_id = $_POST['merchant_id'];
		$name = $_POST['name'];
		$address = $_POST['address'];
		$phone1 = $_POST['phone1'];
		$phone2 = $_POST['phone2'];
		$phone3 = $_POST['phone3'];
		
		$conn = db_connect();
		$quey = null; $result = null;
	

		$query = "update merchant  set 
				 name = '".$name."', 
				 address = '".$address."', 
				 phone1 ='".$phone1."',
				 phone2 ='".$phone2."',
				 phone3 ='".$phone3."' 
				 where merchant_id = ".$merchant_id;
		//return $query;
		$result = @$conn->query($query);
		if(!$result) return  "Error: Can't update merchant info";
		return "success";
  	}
  	
  	
?>


