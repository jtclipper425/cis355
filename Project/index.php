<?php
	session_start();
	$userid = $_SESSION['userid'];
?>
<html>
  <head>
	<title>Jaelyn's Personal Media Library</title>
  </head>
  <body>
	<form action="index.php" method="post">
  	<div style="margin-left: 40">
		<h1>Jaelyn's Personal Media Library</h1>
	</div>
	
	<ul class="nav nav-tabs" style="margin-bottom: 25">
		<li role="presentation" class="active"><a href="index.html"><h3>Home</h3></a></li>
		<li role="presentation"><a href="titles.php"><h3>DVD/Bluray</h3></a></li>
		<li role="presentation"><a href="account.php"><h3>Account</h3></a></li>
	</ul>
	
	
	<div class="panel panel-default" style="margin-left: 40; margin-right:40">
		<div class="panel-heading">Popular Titles</div>
		 
		<table class="table">
			<tr>
				<th>Title</th>
				<th>Type</th> 
				<th>Quality</th>
			</tr>
			<?php 
			   include 'database.php';
			   $pdo = Database::connect();
			   $sql = 'SELECT * FROM item ORDER BY item_rental_count DESC LIMIT 5';
			   foreach ($pdo->query($sql) as $row) {
						echo '<tr>';
						echo '<td>'. $row['item_title'] . '</td>';
						echo '<td>'. $row['item_type'] . '</td>';
						echo '<td>'. $row['item_quality'] . '</td>';
						echo '</td>';
						echo '</tr>';
				}
			?>
		</table>
	</div>
	<div class="panel panel-default" style="margin-left: 40; margin-right:40">
		<div class="panel-heading">Recent Checkouts</div>
		<table class="table">
			<tr>
				<th>Name</th>
				<th>Email</th>
			</tr>
		<?php 
					$sql = 'SELECT checkouts.checkout_id, customers.cust_name, customers.cust_email FROM checkouts JOIN customers ON checkouts.cust_id=customers.cust_id ORDER BY checkouts.checkout_id DESC LIMIT 5';
					foreach ($pdo->query($sql) as $row) {
						echo '<tr>';
						echo '<td>'. $row['cust_name'] . '</td>';
						echo '<td>'. $row['cust_email'] . '</td>';
						echo '</td>';
						echo '</tr>';
					}
		   Database::disconnect();
		?>
		</table>
	</div>

	<link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	</form>
  </body>
</html>