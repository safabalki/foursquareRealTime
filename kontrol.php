<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set("log_errors", 1);
ini_set("error_log", "log.txt");
error_reporting(E_ALL);

	if (file_exists("push.txt"))
	{
		try {
			
			
			$db = new PDO("mysql:host=localhost;dbname=ofosof_cafedb;charset=utf8", "ofosof_safa", "safa5858?");
			
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$sql = "SELECT * FROM checkins where status = 0";
			$users = array();
			$checkins = $db->query($sql, PDO::FETCH_ASSOC);

			if ( $checkins->rowCount() ){

			     foreach( $checkins as $checkin ){

		           array_push($users,$checkin);
		           $query = $db->prepare("UPDATE checkins SET
							status = 1
							WHERE user_id = :userId");
					$update = $query->execute(array(
					     "userId" => $checkin["user_id"],
					));

			     }
			}

			echo json_encode($users);
			unlink("push.txt");

		}
		catch(PDOException $e)
		{
			echo "Connection failed: " . $e->getMessage();
		}

	}else{
		echo "bos";
	}



 ?>