<!DOCTYPE html>
<html>
  <head>
    <title>Bootstrap ʵ��</title>
    <!-- ����ͷ����Ϣ������Ӧ��ͬ�豸 -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- ���� bootstrap ��ʽ�� -->
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
 

    <!-- JavaScript �������ĵ���������ʹҳ������ٶȸ��� -->
    <!-- ��ѡ: ���� jQuery �� -->
    <script src="http://apps.bdimg.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- ��ѡ: �ϲ��� Bootstrap JavaScript ��� -->
    <script src="http://apps.bdimg.com/libs/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  </body>

</html>



