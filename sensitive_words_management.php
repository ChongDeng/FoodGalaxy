<?php

	if(isset($_GET["action"]) and $_GET["action"]=="getText"){
	  	$res = update_list( ); 
	  	if($res == "success") 		
	 		print 'success';
	 	else 
	 	    print $res; 	    
	  	exit();  	
    }
  
	include ('food_galaxy_fns.php');
	do_html_header("View & Edit sensitive words");
?>	
	
	 <script type="text/javascript">
	 	function update_word_list(){
	 		var word_added = document.getElementById("word_added").value;
			var word_deleted = document.getElementById("word_deleted").value;
			var post = "word_added=" + word_added + "&word_deleted=" + word_deleted;
			var action = "action=getText";
			var url = "sensitive_words_management.php";
		
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
	
	<div class = "container"> 
	<table class="table table-bordered table-hover">
		<thead>
			<tr class="active" align="center">
				<th style="text-align:center;">Sensitive Words List</th>				
			</tr>
		</thead>
		
		<tbody>
			<?php   
				$array = file("sensitive_word_list.txt");
				$rendering = array('success', 'warning', 'danger', 'info');
				$index = 0;
				if(count($array)){
					foreach($array as $line){
						echo "<tr class=\"".$rendering[$index]."\">
								<td align=\"center\">".$line."</td>				
							  </tr>";
						$index = ($index + 1) % count($rendering);
					}
				}				
			?>			
		</tbody>
	</table>
  </div>
  
  <div class = "container">
		<form class="form-horizontal" id ="parent">
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">Input the sensitive word to add: </label>
		    <div class="col-sm-10">
		      <input type="title" class="form-control" id="word_added" placeholder="">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">Input the sensitive word to delete: </label>
		    <div class="col-sm-10">
		      <input type="title" class="form-control" id="word_deleted" placeholder="">
		    </div>
		  </div>
		  
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button onclick="update_word_list()" type="button" class="btn btn-primary">Submit</button>
		    </div>
		  </div>
		  
		  <div class="form-group" id="success_message" style="display:none;">
		    <div class="col-sm-offset-2 col-sm-10">
		    	<div class="alert alert-success">
		    		<h3>Updation Success! <a href="sensitive_words_management.php" >Click here to refresh</a></h3>
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
	function update_list( ){		
		
		$word_added = $_POST['word_added'];
		$word_deleted = $_POST['word_deleted'];		
		
		$list = file("sensitive_word_list.txt");
		$new_list = array();		
		
		foreach($list as $line){
			if(trim($line) != $word_deleted) //trim用来去掉文件里的换行符
				array_push($new_list, trim($line));
		}
		if(trim($word_added))		
			array_push($new_list, trim($word_added));		
		
		
		$filename = 'sensitive_word_list.txt';		
		$content = implode("\r\n",$new_list);	
		if(is_writable($filename)){	
			if(false == ($handle = fopen($filename, 'w'))) return "Error: can't open";		
			if(fwrite($handle, $content) === false) return "Error: can't write";					
			fclose($handle);		
		}
		else
			return "Error: no write permission";
		
		return "success";
		
	} 
?>

