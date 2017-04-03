<?php
	session_start();
	$userid = $_SESSION['userid'];
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
		<li role="presentation"><a href="index.php"><h3>Home</h3></a></li>
		<li role="presentation"><a href="titles.php"><h3>DVD/Bluray</h3></a></li>
		<li role="presentation" class="active"><a href="account.html"><h3>Account</h3></a></li>
	</ul>
	
	
	<div class="panel panel-default" style="margin-left: 40; margin-right:40">
		<div class="panel-heading">Checked Out</div>
		 
		<table class="table">
			<?php 
			   include 'database.php';
			   $pdo = Database::connect();
			   $sql = "SELECT item.item_image, item.item_title, checkouts.due_date FROM checkouts JOIN item ON checkouts.item_id=item.item_id JOIN customers ON checkouts.cust_id=customers.cust_id WHERE customers.cust_id='$userid' AND checkouts.return_date IS NULL";
			   foreach ($pdo->query($sql) as $row) {
						echo '<tr>';
						echo '<td><img src="'. $row['item_image'] . '"></td>';
						echo '<td>'. $row['item_title'] . '</td>';
						echo '<td> Due: '. date_format(date_create($row['due_date']), 'M d, Y') .'</td>';
						echo '</td>';
						echo '</tr>';
				}
				?>
		</table>
	</div>
	
	<div class="panel panel-default" style="margin-left: 40; margin-right:40">
	<div class="panel-heading">Account Information</div>
		<table class="table">
			<tr>
				<th>Name</th>
				<th>Username</th>
				<th>Email</th>
			</tr>
			<tr>
			<?php 
					$sql = "SELECT * FROM customers WHERE customers.cust_id='$userid'";
					foreach ($pdo->query($sql) as $row) {
						echo '<td>'. $row['cust_name'] .'</td>';
						echo '<td>'. $row['cust_username'] .'</td>';
						echo '<td>'. $row['cust_email'] .'</td>';
					}
					Database::disconnect();
		?>
			</tr>
		</table>
	</div>

	<link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>