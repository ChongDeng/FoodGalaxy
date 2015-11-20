<?php

if(isset($_GET["action"]) and $_GET["action"]=="getText"){ 	 	
 	if(($_POST['review_content']) && ($_POST['food_id'])) { //write food review 		
 		$res = write_food_review(); 
 		header('Content-Type:text/html;charset=GB2312');
 		if($res == "success") 		
	 		print 'success';
	 	else 
	 	    print $res; 	    
	  	exit();  
 	}
 	
 }
 
 require_once('food_galaxy_fns.php');
 
 do_html_header("Please Write the review!"); 
 
 ?>
 <script type="text/javascript">

 	
 
	function review_process(){		

		var title = document.getElementById("title").value;
		var content = document.getElementById("content").value;
		var food_id = "<?php echo $_GET["food_id"];?>";
		var author_id = "<?php session_start(); echo $_SESSION['valid_user'];?>";
		var date = "<?php $date = date("Y-m-d"); echo $date;?>";
		var type = 0;
		var post = "food_id=" + food_id + "&review_content=" + content + 
		           "&type=" + type +"&author_id=" + author_id +
		           "&title=" + title +"&date=" + date;
		var action = "action=getText";
		var url = "write_food_review.php";

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
					alert("text: " + text);
				}
									
			}
		}		
	}
</script>

   </br></br>
   <div class = "container">
		<form class="form-horizontal" id ="parent">
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">Title</label>
		    <div class="col-sm-10">
		      <input type="title" class="form-control" id="title" placeholder="Please write the title">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputPassword3" class="col-sm-2 control-label">Content</label>
		    <div class="col-sm-10">
		      <textarea rows="10" type="content" class="form-control" id="content" placeholder="Please write the content"></textarea>
		    </div>
		  </div>
		 
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button onclick="review_process()" type="button" class="btn btn-primary">Submit the review</button>
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
 
 <?php
 	 function write_food_review(){	
		require_once ('food_galaxy_fns.php');
		  
		$conn = db_connect();
		$query = "insert into review values(NULL,'".$_POST['type']."','".$_POST['food_id']."','".$_POST['author_id']."','".$_POST['title']."','".$_POST['review_content']."','".$_POST['date']."')";		  	
		$result = $conn->query($query);
		if (!$result) return false;	 
		
		$array = file("sensitive_word_list.txt");
		foreach($array as $line){
			$key_word = trim($line);
			if(strpos($_POST['review_content'], $key_word) !== false){
				$query = "select max(review_id) as max_review_id from review";	  	
				$result = $conn->query($query);
				if (!$result) return false;
				$row = $result->fetch_assoc();
				$max_review_id = $row['max_review_id'];
				
				$query = "insert into malign_according values(NULL, 
		          							0, 
		          							'".$max_review_id."'
		         							)";
			
				$result = $conn->query($query);
				if (!$result) return false;
				break;	 
			}	
		}
		return true;	 
	 } 
 ?>



