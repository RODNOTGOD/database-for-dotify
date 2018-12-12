<?php
$email = $_GET['email'];
$username = $_GET['username'];
$firstname = $_GET['firstname'];
$lastname = $_GET['lastname'];
$password = $_GET['password'];
$bcrypt_hash = password_hash($password, PASSWORD_DEFAULT);


$conn = new mysqli("localhost", "kragendor", "", "Dotify");

if ($conn->connect_error) {
    echo "Error: Unable to connect to server" . PHP_EOL;
    echo "Debuging errno: " . mysqli_connection_errno() . PHP_EOL;
    echo "Debuging error: " . mysqli_connection_error() . PHP_EOL;
    exit;
}

$stmt = $conn->prepare("INSERT INTO User(FirstName, LastName, Username, Email, PasswordHash) VALUES(?,?,?,?,?)");
$stmt->bind_param("sssss", $firstname, $lastname, $username, $email, $bcrypt_hash);
if ($stmt->execute())
    print json_encode([array("created" => true)]);
else
    print json_encode([array("created" => false)]);
$conn->close();
?>
