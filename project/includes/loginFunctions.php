<?php

// database connection
require_once('db.php');
require_once('session.php');

// retrieves the variables from the ajax request
$username = $_POST['username'];
$password = $_POST['password'];

// prepares the sql query and executes it
$stmt = $con->prepare("SELECT * FROM users WHERE username = ?");
//expects only a string
//binds the variable to the prepared stmt(statement)
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// tripple equals checks if the value and type are the same. If there is one result, then we check the password.
if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    // verifies the password with the hash
    if (password_verify($password, $row['password'])) {
        // puts the user info in the session variable (logs the user in)
        $_SESSION['user'] = [
            'username' => $row['username'],
            'id' => $row['userId'],
        ];

        echo "Logged in successfully!";
    }
    else {

    echo "Incorrect username or password.";
    }
}
?>