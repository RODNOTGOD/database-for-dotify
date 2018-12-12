<?php

$username = $_GET['username'];
$password = $_GET['password'];

$conn = new mysqli("localhost", "kragendor", "", "Dotify");

if ($conn->connect_error) {
    echo "Error: Unable to connect to server" . PHP_EOL;
    echo "Debuging errno: " . mysqli_connection_errno() . PHP_EOL;
    echo "Debuging error: " . mysqli_connection_error() . PHP_EOL;
    exit;
}

$stmt = $conn->prepare("SELECT PasswordHash as hash from User WHERE Username = ? or Email = ?");
$stmt->bind_param("ss", $username, $username);
$stmt->execute();
$result = $stmt->get_result();

$row = $result->fetch_assoc();
$hash = $row['hash'];

if (password_verify($password, $hash)) {
    echo json_encode([array("login" => true)]);
} else {
    echo json_encode([array("login" => false)]);
}
?>
