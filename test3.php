<!DOCTYPE html>
<html>
  <head>
    <title>Bootstrap 实例</title>
    <!-- 包含头部信息用于适应不同设备 -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 包含 bootstrap 样式表 -->
    <link rel="stylesheet" href="http://apps.bdimg.com/libs/bootstrap/3.2.0/css/bootstrap.min.css">
    
    <script type="text/javascript">
		function review_process(){
			alert("3");	
		}
	</script>

  </head>

  <body>
   
 <div class = "container">
		<form class="form-horizontal">
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
		    <div class="col-sm-10">
		      <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
		    <div class="col-sm-10">
		      <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
		    </div>
		  </div>
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <div class="checkbox">
		        <label>
		          <input type="checkbox"> Remember me
		        </label>
		      </div>
		    </div>
		  </div>
		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button type="button" onclick="review_process()" class="btn btn-default">Sign in</button>
		    </div>
		  </div>
		</form>
  </div>
 

    <!-- JavaScript 放置在文档最后面可以使页面加载速度更快 -->
    <!-- 可选: 包含 jQuery 库 -->
    <script src="http://apps.bdimg.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- 可选: 合并了 Bootstrap JavaScript 插件 -->
    <script src="http://apps.bdimg.com/libs/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  </body>

</html>



