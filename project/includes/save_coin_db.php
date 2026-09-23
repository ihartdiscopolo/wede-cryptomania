<?Php 
	
	include('db.php');

	print_r($_POST);

	$transId = $_POST['transId'];
	$coinAmount = $_POST['amount'];

	$saveCoin = "UPDATE cryptofolio SET amount = '$coinAmount' WHERE transId = '$transId'";

	if (mysqli_query($con, $saveCoin)){
		echo "Coin amount updated successfully!";
	} else {
		echo "Whoops, can not add a coin to your cryptofolio.." . $addCoin . "<br />" . mysqli_error( $con );
	}

?>