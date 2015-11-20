<?php
	if(isset($_GET["action"]) and $_GET["action"]=="getJSON"){
		//����ͷ�ļ�
		header('Content-Type:text/html;charset=GB2312');
		if($_GET['merchant_name']){			
			$res = search_by_merchant_name($_GET['merchant_name']);
		}
		else if($_GET['category_name']){
			;			
		}
		$jsonArray = array();
		for($row = 0; $row < count($res); ++$row){
				$food = array();
				//ȡ�����鵥Ԫ,�������ַ�����URL����
				$food[0] = $res[$row]['food_id']; 
				$food[1] = $res[$row]['food_name'];
				$food[2] = $res[$row]['description'];
				$food[3] = $res[$row]['price'];
				$food[4] = $res[$row]['popularity_level'];				
				//������ת��ΪJSON����
				$jsonArray[] = json_encode($food);
		}
		//����JSON����		
		$json = "{food:[".implode(",",$jsonArray)."]}";
		//���JSON����
		print $json;
		
		exit();
	}
  	
	require_once('food_galaxy_fns.php');
	require_once('ajax.php');
	
  	// The shopping cart needs sessions, so start one  
   
   $search_key = $_GET['search_key'];
   do_html_header('');
   display_search_settings_layout();
   
?>

<script type="text/javascript">

	var jsonObj = null;
	
	function search_food(type){
		$action = null;
		if(type == "category_type"){
			var category_name = document.getElementById("category_name").value;
			action = "action=getJSON&category_name=" + category_name;
		}
		else if(type == "merchant_type"){			
			var merchant_name = document.getElementById("merchant_name").value;
			action = "action=getJSON&merchant_name=" + merchant_name;
		}
				
		//����Ҫ�ύ�ű��ĵ�ַ
		var url = "advanced_search_result.php";
		
		//ָ���ص�����
		//xmlHttp.onreadystatechange = showJSON;
		xmlHttp.onreadystatechange = show_food;
		//ʹ��GET�����ύ����
		xmlHttp.open("GET",url+"?"+action,true);
		//��������
		xmlHttp.send(null);
	}

	function show_food(){		
	   	//�ύ������״̬
	      if (xmlHttp.readyState == 4) {
	      //HTTP�����״̬
	         if (xmlHttp.status == 200) {		      
	            //ʹ��eval()����JSON����
	            jsonObj = eval("(" + xmlHttp.responseText + ")");
	            var result_html = '';
	            for(var i=0;i<jsonObj.food.length;i++){   	         	
	   	         	var row = Array(5);
	            	row[0]=jsonObj.food[i][0];
			    	row[1]=jsonObj.food[i][1];
			    	row[2]=jsonObj.food[i][2];
			    	row[3]=jsonObj.food[i][3];
			    	row[4]=jsonObj.food[i][4];			    	
			    	
	            	result_html += '<div class="col-xs-12 col-sm-6 col-md-4">'
		            				+ '<div class="thumbnail">'
		            					+ '<a href="food_details.php?food_id=' + row[0] + '"><img src="img/' + row[0] + '.jpg" alt="..."></a>'
		            					+ '<div class="caption">'
		            						+ '<h3>' + row[1] + '</h3>'
		            						+ '<p>' + row[2] + '</p>'
		            						+ '<p>'
		            							+ '<a href="food_details.php?food_id=' + row[0] + '" class="btn btn-primary" role="button">View Details</a>'
		            						+ '</p>'
		            					+ '</div>'
		            				+ '</div>'
		            	         + '</div>';
	            }	            

	            var search_result = document.getElementById("search_result");
	            search_result.innerHTML = result_html;	        
				  
	         } else {
	        	 $("#failure_message").show();
	         }
	      }
	}
	
	
	   
</script>	

<div class="form-group" id="failure_message" style="display:none;">
		    <div class="col-sm-offset-2 col-sm-10">
		    	<div class="alert alert-danger">
		    		<h3>Failed! Please try again!</h3>
		    	</div>
		    </div>
</div>  		

 <div id="search_result"></div>   

<?php
	//display_search_result_by_name($search_key);   
   do_html_footer(); 
?>

<?php
	function display_search_settings_layout(){
		echo '
				
  		
  		<div class = "container">
			<form class="form-inline">
			  <div class="form-group">
			    <label class="sr-only" for="merchant_name">Amount (in dollars)</label>
			    <div class="input-group">		     
			      <input type="text" class="form-control" id="merchant_name" placeholder="Search merchant name">		     
			    </div>
			  </div>
			  <button onclick="search_food(\'merchant_type\')" type="button" class="btn btn-primary">Search</button>
			</form>
  		
			<form class="form-inline">
			  <div class="form-group">
			    <label class="sr-only" for="category_name">Amount (in dollars)</label>
			    <div class="input-group">		     
			      <input type="text" class="form-control" id="category_name" placeholder="Search category name">		     
			    </div>
			  </div>
			  <button onclick="search_food(\'category_type\')" type="button" class="btn btn-primary">Search</button>
			</form>
			
			<label class="checkbox-inline">
					  <input type="checkbox" id="inlineCheckbox1" value="option1"> Sort by Price
					</label>
					
			<label class="checkbox-inline">
					  <input type="checkbox" id="inlineCheckbox2" value="option2"> Sort by Popularity Level
			</label>
			<button type="submit" class="btn btn-primary">Apply</button>
			
  		</div>
  		<hr> 		
 
		';
	}
	
	
	function search_by_merchant_name($merchant_name){
	 				
		// query database for the books in a category
	   	if ((!$merchant_name) || ($merchant_name == '')) {
	    	 return false;
	   	}
	   
	   	include_once('db_fns.php');
	   	include_once('galaxy_fns.php');	  
	   	$conn = db_connect();	  
	   	$query = "select food.name as food_name, food_id, description, price, food.popularity_level as popularity_level
				 from food, merchant
				 where merchant.merchant_id = food.merchant_id and merchant.name = '".$merchant_name."'";
	      
	   	$result = @$conn->query($query);	   
	   	if (!$result){
	   		return  "Error: Can't execute query about food";	   		
	   	} 	   
	   
	   	$num = @$result->num_rows;
	   	if($num == 0){	     
	      return false;
	   	}
	  
		$res_array = array();
   		for ($count=0; $row = $result->fetch_assoc(); $count++) {
     		$res_array[$count] = $row;
     		//write_log("cnt: ".$count);	 
   		}
   		return $res_array;
	 
	}

?>
