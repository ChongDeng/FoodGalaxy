<?php	
	 if(isset($_GET["action"]) and $_GET["action"]=="getText"){
	  	$res = write_complaint( ); 
	  	if($res == "success") 		
	 		print 'success';
	 	else 
	 	    print $res; 	    
	  	exit();  	
 	}


 require_once('food_galaxy_fns.php');
 
 do_html_header("Please write the complaints!"); 
 
 ?>
 <script type="text/javascript">

 	
 
	function complaint_process(){		

		
		var content = document.getElementById("content").value;
		var food_id = "<?php echo $_GET["food_id"];?>";
		var author_id = "<?php echo $_GET["customer_id"];?>";		
		var date = "<?php $date = date("Y-m-d"); echo $date;?>";
		var type = 0;
		var post = "food_id=" + food_id + "&complaint_content=" + content + 
		           "&type=" + type +"&author_id=" + author_id +
		           "&date=" + date;
		var action = "action=getText";
		var url = "write_complaints.php";

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

   </br></br>
   <div class = "container">
		<form class="form-horizontal" id ="parent">
		 
		  <div class="form-group">
		    <label for="inputPassword3" class="col-sm-2 control-label">Complaint Content</label>
		    <div class="col-sm-10">
		      <textarea rows="10" type="content" class="form-control" id="content" placeholder="Please write the content"></textarea>
		    </div>
		  </div>
		 
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button onclick="complaint_process()" type="button" class="btn btn-primary">Submit the complaint</button>
		    </div>
		  </div>
		  
		  <div class="form-group" id="success_message" style="display:none;">
		    <div class="col-sm-offset-2 col-sm-10">
		    	<div class="alert alert-success">
		    		<h3>Success!<a href="food_details.php?food_id=<?php echo $_GET["food_id"];?>" > Click here to go back! </a></h3>
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
	function write_complaint(){
		
		require_once ('food_galaxy_fns.php');
		$conn = db_connect();
		$query = "insert into complaint values(NULL, 
	          							'".$_POST['author_id']."', 
	          							'".$_POST['type']."', 
	          							'".$_POST['food_id']."',	          							
	          							'".$_POST['complaint_content']."',
	          							'".$_POST['date']."'
	         							)";		
   		$result = @$conn->query($query);   		
		if (!$result) return  "Error: can't insert a complaint into db";
			
		return "success";
	} 
?>

