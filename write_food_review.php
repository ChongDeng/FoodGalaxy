<?php
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
		var url = "galaxy_fns.php";

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



