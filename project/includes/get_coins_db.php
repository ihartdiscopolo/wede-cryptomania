<?Php 
	
	header('Content-Type: application/json');

	include('db.php');

	$userId = $_SESSION['user']['id'];

	$getAllCoins = "SELECT * FROM cryptofolio WHERE userId = '$userId'";

	$resultGetAllCoins = mysqli_query($con, $getAllCoins);

	$allCoinsArray = array(); 

	while ($rowAllCoins = mysqli_fetch_assoc($resultGetAllCoins)) {

		$allCoinsArray[] = $rowAllCoins;
	}
	
	
	echo json_encode($allCoinsArray);
		 

?>