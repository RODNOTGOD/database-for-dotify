<?php
$server = $_GET['server'];
$username = $_GET['username'];
$password =  $_GET['password'];
$table = $_GET['table'];
$conn = new mysqli($server, $username, $password, $table);

if ($conn->connect_error) {
    echo "Error: Unable to connect to server" . PHP_EOL;
    echo "Debuging errno: " . mysqli_connection_errno() . PHP_EOL;
    echo "Debuging error: " . mysqli_connection_error() . PHP_EOL;
    exit;
}

$result = $conn->query("select * from " . $_GET['query']);
while ($row = $result->fetch_assoc()) {
    $output[] = $row;
}

print(json_encode($output));

$conn->close();
?>
