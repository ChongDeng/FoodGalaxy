<?php
	if($_POST['UserId'] || $_POST['MerchantId']) { 			
 		$res = send_notification(); 
 		header('Content-Type:text/html;charset=GB2312');
 		if($res == "success") 		
	 		print 'success';
	 	else 
	 	    print $res;		  
	  	exit();  
 	}
 	

 	include ('food_galaxy_fns.php');
	do_html_header("Send Warning Message");
	display_warning_form();	
	
	
?>  

 <script type="text/javascript"> 	
 
	function send_message(type){

		var message = document.getElementById("message").value;
		
		var user_id = null; var merchant_id = null; var post = null;
		if(type == 0){ 
			user_id = "<?php echo $_GET["user_id"];?>";
			post = "message=" + message + "&UserId=" + user_id + 
	           "&type=" + type;
		}
		else if(type == 1){
			merchant_id = "<?php echo $_GET["merchant_id"];?>";
			post = "message=" + message + "&MerchantId=" + merchant_id + 
	           "&type=" + type;
		}				
		
		var action = "action=getText";
		var url = "send_warning_message.php";
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

		

<?php
  do_html_footer(); 
?>


<?php
	function display_warning_form(){
		
		$type = null;
		if($_GET['user_id'])
			$type = 0;
		else if($_GET['merchant_id'])
			$type = 1;
			
		echo '
		<form class="form-horizontal" id ="parent">
		 
		  <div class="form-group">
		    <label for="inputPassword3" class="col-sm-2 control-label">Message</label>
		    <div class="col-sm-10">
		      <textarea rows="10" type="content" class="form-control" id="message" placeholder="Please write the content"></textarea>
		    </div>
		  </div>
		 
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button onclick="send_message('.$type.')" type="button" class="btn btn-primary">Submit</button>
		    </div>
		  </div>
		  
		  <div class="form-group" id="success_message" style="display:none;">
		    <div class="col-sm-offset-2 col-sm-10">
		    	<div class="alert alert-success">
		    		<h3>Success! <a href="view_malign_accordings.php" >Click here to go back</a></h3>
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

		</form>';
  	}
?>

<?php
	function send_notification(){
		
		$type = $_POST['type']; $message = $_POST['message']; $target_id = null; $date = date("Y-m-d");
		if($_POST['UserId'])
			$target_id = $_POST['UserId'];		
		else if($_POST['MerchantId'])		
			$target_id = $_POST['MerchantId'];			
		
		
		require_once ('food_galaxy_fns.php');
		$conn = db_connect();
		$query = "insert into notification values(NULL, 
	          							'".$type."', 
	          							'".$target_id."', 
	          							'".$message."',
	          							'".$date."'          							
	         							)";	
		
   		$result = @$conn->query($query);   		
		if (!$result) return  "Error: can't send notification";		
		
		return "success";
	} 
?>