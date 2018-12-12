<?php

$email = $_GET['email'];


$conn = new mysqli("localhost", "kragendor", "", "Dotify");

if ($conn->connect_error) {
    echo "Error: Unable to connect to server" . PHP_EOL;
    echo "Debuging errno: " . mysqli_connection_errno() . PHP_EOL;
    echo "Debuging error: " . mysqli_connection_error() . PHP_EOL;
    exit;
}

$stmt = $conn->prepare("SELECT Email from User WHERE Email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

echo json_encode([array("exists" => $result->num_rows > 0)]);
?>