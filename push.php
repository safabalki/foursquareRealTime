<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



$json = json_decode($_REQUEST["checkin"]);

$id = $json->id;
$user_id = $json->user->id;
$user_firstName = $json->user->firstName;
$user_lastName = $json->user->lastName;  
$user_gender = $json->user->gender;
$user_homeCity = $json->user->homeCity;
$user_photo = $json->user->photo;


$venue_id = $json->venue->id;
$venue_name = $json->venue->name;
$venue_location_address = $json->venue->location->address;
$venue_location_lat = $json->venue->location->lat;
$venue_location_lng = $json->venue->location->lng;
$venue_location_city = $json->venue->location->city;
$venue_location_state = $json->venue->location->state;
$venue_location_postalCode = $json->venue->location->postalCode;

// Dosya yoksa oluşur ve eklemek üzere aç...
$dosya = fopen("push.txt","a");
fclose($dosya);

try {
	$conn = new PDO("mysql:host=localhost;dbname=ofosof_cafedb", "ofosof_safa", "safa5858?");
	$conn->exec("set names utf8");
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql ="INSERT INTO checkins (4sq_id, user_id, user_firstName, user_lastname, user_gender, user_homeCity,user_photo, venue_id, venue_name, venue_location_address, venue_lat, venue_lng, venue_city, venue_state, venue_postalCode,status) VALUES ('$id', '$user_id', '$user_firstName', '$user_lastName', '$user_gender', '$user_homeCity', '$user_photo', '$venue_id', '$venue_name', '$venue_location_address', '$venue_location_lat', '$venue_location_lng', '$venue_location_city', '$venue_location_state', '$venue_location_postalCode',0)";
	$conn->exec($sql);
	echo "Connected successfully"; 
}
catch(PDOException $e)
{
	echo "Connection failed: " . $e->getMessage();
}

?>
