<?php

	if($_POST['userid']) { 	
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

 	
 
	function sent_message_to_user(){
		
		var message = document.getElementById("message").value;		
		var user_id = "<?php echo $_GET["user_id"];?>";	
		var type = 0;	
		var post = "message=" + message + "&userid=" + user_id + 
		           "&type=" + type;
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
				alert("str: " + text);
				/*	
				if(text == "success"){
					$("#success_message").show();
					$("#failure_message").hide();
				}
				else{
					$("#success_message").hide();
					$("#failure_message").show();
				}
				*/
				
									
			}
		}
			
	}
</script>

		

<?php
  do_html_footer(); 
?>


<?php
	function display_warning_form(){
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
		      <button onclick="sent_message_to_user()" type="button" class="btn btn-primary">Submit</button>
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
		$type = null; $message = $_POST['message']; $target_id = null;		
		
		if($_POST['userid']){
			$type = 0;
			$target_id = $_POST['userid'];
		}
		else if($_POST['merchant_id']){
			$type = 1;
			$target_id = $_POST['merchant_id'];			
		}
		
		
		$post = "#".$type."#".$message."#".$target_id."#";
		write_log($post);
		return "success";
	} 
?>