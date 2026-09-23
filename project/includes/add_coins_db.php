<?Php 
	
	include('db.php');

	// print_r($_POST); 

	$coinId = $_POST['coin_id'];
	$coinName = $_POST['coin_name'];
	$coinPrice = $_POST['coin_price'];
	$amountCoins = $_POST['amount_coins'];
	$userId = $_SESSION['user']['id'];

	$addCoin = "INSERT INTO cryptofolio (coinId, name, price, amount, userId) 
			VALUES ('$coinId', '$coinName', '$coinPrice', '$amountCoins', '$userId')";

	if( mysqli_query($con, $addCoin) )
	{
		echo "Successfully added to your cryptofolio";
	}
	else
	{
		echo "Oops, can not add a coin to your cryptofolio:" . $addCoin . "<br />" . mysqli_error($con);
	}
?>