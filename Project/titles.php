<?php
	session_start();
	$userid = $_SESSION['userid'];
	$db=mysqli_connect("localhost","jtclippe","587052","jtclippe");
	
	if(isset($_POST["rent_btn"]) && isset($_SESSION['userid']))
	{
		date_default_timezone_set('United States/Detroit');
		$date1 = date('Y-m-d H:i:s', time());
		$date2 = date('Y-m-d H:i:s', strtotime('+2 weeks', time()));
		$id = $_POST["rent_btn"];
		
		$sql="INSERT INTO checkouts(cust_id, item_id, checked_out_date, due_date) VALUES('$userid','$id','$date1','$date2')";
        mysqli_query($db,$sql); 
	}
	else if(isset($_POST["return_btn"]))
	{
		date_default_timezone_set('United States/Detroit');
		$date = date('Y-m-d H:i:s', time());
		$id = $_POST["return_btn"];
		
		$sql="UPDATE checkouts SET return_date='$date' WHERE cust_id='$userid' AND item_id='$id'";
        mysqli_query($db,$sql); 
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
		<li role="presentation" class="active"><a href="titles.php"><h3>DVD/Bluray</h3></a></li>
		<li role="presentation"><a href="account.php"><h3>Account</h3></a></li>
		<li role="presentation"><a href="index.php"><h3>Sign In</h3></a></li>
		<li role="presentation"><a href="logout.php"><h3>Sign Out</h3></a></li>
	</ul>
	
	<div>
	<form method="post" action="titles.php">
		<div class="row">
		<?php 
			include 'database.php';
			$pdo = Database::connect();
			$sql = 'SELECT * FROM item ORDER BY item_title ASC';
			foreach ($pdo->query($sql) as $row) {
					$itemid = $row['item_id'];
					$sql2 = "SELECT * FROM checkouts WHERE item_id='$itemid' AND return_date IS NULL";
					$result=mysqli_query($db,$sql2);
					$response = $result->fetch_assoc();
					
					echo '<div class="col-sm-6 col-md-4">';
					echo '<div class="thumbnail">';
					echo '<img class="thumb" src="'. $row['item_image'] .'">';
					echo '<div class="caption">';
					echo '<h3>'. $row['item_title'] .'</h3>';
					echo '<p>'. $row['item_type'] .' '. $row['item_quality'] .'</p>';
					
					if (mysqli_num_rows($result)==0)
					{
						echo"<button type='submit' class='btn btn-success' name='rent_btn' value='$itemid'>Available</button>";
					}
					else if ($response['cust_id'] == $_SESSION['userid'])
					{
						echo"<button type='submit' class='btn btn-danger' name='return_btn' value='$itemid'>Return</button>";
					}
					else
					{
						echo "<button class='btn btn-primary'>Not Available</button>";
					}
					
					echo '</div>';
					echo '</div>';
					echo '</div>';
					}
			Database::disconnect();
		?>
		</div>
	</form>
	</div>
	</div>

	<link href="css/titles.css" rel="stylesheet">	
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>