<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Login Form</title>
  <style type="text/css">
      body{
        margin: 0;
        padding: 0;
        font-family: sans-serif;
        background: url(m.jpg) no-repeat;
        background-size: cover;
      }
      .login-box{
        width: 280px;
        position: absolute;
        top: 50%;
        left: 50%;
        background: #1a1a1a;
        box-sizing: border-box;
        padding: 20px;
        border-radius: 20px;
        box-shadow: 0 15px 25px rgba(0,0,0,.5);
        transform: translate(-50%,-50%);
        color: white;
     }
     .login-box h1{
        float: left;
        font-size: 40px;
        border-bottom: 6px solid #4caf50;
        margin-bottom: 30px;
        padding: 10px;
     }
     .textbox{
        width: 100%;
        overflow: hidden;
        font-size: 20px;
        padding: 8px 0;
        border-bottom: 10px 0;
        border-bottom: 1px solid #4caf50;
     }
     .textbox input{
        border: none;
        outline: none;
        background: none;
        color: white;
        font-size: 15px;
        width: 140px;
        float: left;
        margin: 0 8px;
     }
     .btn{
        width: 100%;
        background: none;
        border: 2px solid #4caf50;
        color: white;
        padding: 4px;
        font-size: 18px;
        cursor: pointer;
        margin: 12px 0;
     }
     .login-box p{
        font-size: 18px;
        color: white;
     }
     .login-box a{
        color: #4caf50;
     }
  </style>
</head>
<body>
  <div class="login-box">
  	<h1>Login</h1>
	 
  <form method="post" action="login.php">
  	<?php include('errors.php'); ?>
  	<div class="textbox">
  		<input type="text" placeholder="Username" name="username" >
  	</div>
  	<div class="textbox">
  		<input type="password" placeholder="Password" name="password">
  	</div>
  		<button type="submit" class="btn" name="login_user">Login</button>
  	<p>
  		Not yet a member? <a href="register.php">Click here</a>
  	</p>
   </div> 
  </form>
</body>
</html>
