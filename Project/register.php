<?php
session_start();
//connect to database
$db=mysqli_connect("localhost","jtclippe","587052","jtclippe");
if(isset($_POST['register_btn']))
{
	$fullname=mysqli_real_escape_string($db, $_POST['fullname']);
    $username=mysqli_real_escape_string($db, $_POST['username']);
    $email=mysqli_real_escape_string($db, $_POST['email']);
    $password=mysqli_real_escape_string($db, $_POST['password']);
    $password2=mysqli_real_escape_string($db, $_POST['password2']);  
     if($password==$password2)
     {
            //$password=md5($password); //hash password before storing for security purposes
            $sql="INSERT INTO customers(cust_name, cust_email, cust_username, cust_password) VALUES('$fullname','$email', '$username','$password')";
            mysqli_query($db,$sql); 
			
            header("location:index.php");  //redirect home page
    }
}
?>
<html>
  <head>
    <title>Jaelyn's Personal Media Library</title>
  </head>
  <body>
  	<div style="margin-left: 40">
		<h1>Jaelyn's Personal Media Library</h1>
	</div>
	
	<ul class="nav nav-tabs" style="margin-bottom: 25">
		<li role="presentation"><a href="home.php"><h3>Home</h3></a></li>
		<li role="presentation"><a href="titles.php"><h3>DVD/Bluray</h3></a></li>
		<li role="presentation"><a href="account.php"><h3>Account</h3></a></li>
		<li role="presentation"><a href="index.php"><h3>Sign In</h3></a></li>
		<li role="presentation"><a href="logout.php"><h3>Sign Out</h3></a></li>
	</ul>
	
	<form method="post" action="register.php">
		<div class="panel panel-default" style="margin-left: 40; margin-right:1000">

			 
			   <input type="text" placeholder="Full Name" name="fullname" class="form-control" aria-describedby="sizing-addon1">



			   <input type="text" placeholder="Username" name="username" class="form-control" aria-describedby="sizing-addon1">



			   <input type="text" placeholder="Email Address" name="email" class="form-control" aria-describedby="sizing-addon1">



			   <input type="password" placeholder="Password" name="password" class="form-control"  aria-describedby="sizing-addon1">


			   <input type="password" placeholder="Confirm Password" name="password2" class="form-control"  aria-describedby="sizing-addon1">

		</div>
		
		<div style="margin-left: 40; margin-right:40">
			<button type="submit" class="btn btn-success" name="register_btn" class="Register">Register</button>
		</div>
	</form>

	<link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>