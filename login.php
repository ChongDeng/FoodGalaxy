<!DOCTYPE html>
<html lang="en">
  <head>
    
        <title>Food Galaxy Manager</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="">
    <link rel="shortcut icon" href="favicon.png">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://manager.wasify.com/assets/css/public.css" rel="stylesheet">
  </head>
  <body>
    <div class="container container-body" id="managerLogin">
      <div class="row">
        <div class="col-sm-offset-4 col-sm-4 text-center">
          <div style="margin-top:25%">
            <div class="loginLogo"><img class="img-responsive" src="https://manager.wasify.com/assets/img/logo-big.png"></div>
                          <div class="alert alert-danger">Wrong username or password, please try again</div>
                        <form class="form-signin" role="form" action="login" method="post">
              <div class="form-group">
                <input type="email" class="form-control" id="email" name="email" maxlength="50" placeholder="Email" value="">
                <input type="password" class="form-control" id="pass" name="pass" maxlength="20" placeholder="Password" value="">
                
              </div>
              <button type="submit" class="btn btn-lg btn-success btn-block" name="commandLogin" value="1">Login</button>
              <div class="loginLinks">
                <a href="#">Forgotten password?</a>
                <br><a href="#" rel="nofollow" data-toggle="modal" data-target="#signUp">Not a user yet? Try Food Galaxy!</a>
              </div>
            </form> 
          </div>
        </div>
      </div>
    </div>
  </body>
</html>