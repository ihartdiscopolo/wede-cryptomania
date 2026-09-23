<?Php 
	
	include('db.php');

	print_r($_POST);

	$coinId = $_POST['coinId'];
	$coinAmount = $_POST['amount'];

	$saveCoin = "UPDATE cryptofolio SET amount = '$coinAmount' WHERE id = '$coinId'";

	if (!mysqli_query($con, $saveCoin)){
		echo "Whoops, can not add a coin to your cryptofolio.." . $addCoin . "<br />" . mysqli_error( $con );
	}

?>