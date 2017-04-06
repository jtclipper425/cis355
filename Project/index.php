<?php
session_start();
//connect to database
$db=mysqli_connect("localhost","jtclippe","587052","jtclippe");
if(isset($_POST['login_btn']))
{
    $username=mysqli_real_escape_string($db, $_POST['username']);
    $password=mysqli_real_escape_string($db, $_POST['password']);
    //$password=md5($password); //Remember we hashed password before storing last time
    $sql="SELECT * FROM customers WHERE cust_username='$username' AND cust_password='$password'";
		
    $result=mysqli_query($db,$sql);
    if(mysqli_num_rows($result)==1)
    {
		$response = $result->fetch_assoc();
        $_SESSION['message']="You are now Logged In";
		$_SESSION['userid']=$response['cust_id'];
        header("location:home.php");
		exit();
    }
   else
   {
                $_SESSION['message']="Username and Password combiation incorrect";
    }
}
else if (isset($_POST['register_btn']))
{
	header("location:register.php");
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
		<li role="presentation" class="active"><a href="index.php"><h3>Sign In</h3></a></li>
		<li role="presentation"><a href="logout.php"><h3>Sign Out</h3></a></li>
	</ul>
	
	<form method="post" action="index.php">
		<div class="panel panel-default" style="margin-left: 40; margin-right:1000">
			<div class="input-group input-group-lg">
			   <span class="input-group-addon" id="sizing-addon1"></span>
			   <input type="text" placeholder="Username" name="username" class="form-control" aria-describedby="sizing-addon1"></td>
			</div>
			<div class="input-group input-group-lg">
			   <span class="input-group-addon" id="sizing-addon1"></span>
			   <input type="password" placeholder="Password" name="password" class="form-control"  aria-describedby="sizing-addon1"></td>
			</div>
		</div>
		
		<div style="margin-left: 40; margin-right:40">
			<button type="submit" class="btn btn-success" name="login_btn" class="Log In">Sign In</button>
		</div>
		
		<div style="margin-left: 40; margin-right:40">
			<button type="submit" class="btn btn-danger" name="register_btn" class="Register">Register</button>
		</div>
	</form>

	<link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>