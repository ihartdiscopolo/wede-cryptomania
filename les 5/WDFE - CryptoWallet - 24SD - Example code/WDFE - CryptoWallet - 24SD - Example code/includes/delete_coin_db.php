<?php

include('db.php');

$coinId = $_POST['coinId'];

$deleteCoin = "DELETE FROM cryptofolio WHERE id =" . $coinId;

if (mysqli_query($con, $deleteCoin)) {
    echo "Successfully added to your cryptofolio!!";
} else {
    echo "Whoops, can not add coin to your cryptofolio:" . $deleteCoin . "<br />" . mysqli_error($con);
}
