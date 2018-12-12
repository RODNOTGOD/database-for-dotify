<?php
$conn = new mysqli("localhost", "zerg", "", "Dotify");

if ($conn->connect_error) {
    echo "Error: Unable to connect to server" . PHP_EOL;
    echo "Debugging errno: " . mysqli_connection_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connection_error() . PHP_EOL;
    exit;
}

$result = $conn->query("SELECT ArticleId, Title FROM Article;");
while ($row = $result->fetch_assoc()) {
    $output[] = $row;
}
print(json_encode($output));

$conn->close();
?>
