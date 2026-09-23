<?php

include('db.php');

$transId = $_POST['transId'];

$deleteCoin = "DELETE FROM cryptofolio WHERE transId =" . $transId;

if (mysqli_query($con, $deleteCoin)) {
    echo "Successfully deleted from your cryptofolio!!";
} else {
    echo "Whoops, can not delete the coin from your cryptofolio.. :" . $deleteCoin . "<br />" . mysqli_error($con);
}
