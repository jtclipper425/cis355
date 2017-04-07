<?php
class API
	{
		private static $sql;
		
		public static function setSQL($id)
		{
			if ($id)
			{
				self::$sql = "SELECT * FROM item WHERE item_id=".$id;
			}
			else
			{
				self::$sql = "SELECT * FROM item";				
			}
		}
		
		public static function printJson()
		{	
			include 'database.php';
			
			$pdo = Database::connect();
				
			foreach($pdo->query(self::$sql) as $row)
			{
				$arr = Array('title' => $row['item_title'], 'type' => $row['item_type'], 'quality' => $row['item_quality']);
				echo json_encode($arr);
			}
			
			Database::disconnect();
		}
	}
?>