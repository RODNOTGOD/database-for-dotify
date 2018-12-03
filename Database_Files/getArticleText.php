<?php
$conn = new mysqli("localhost", "kragendor", "", "Dotify");

$articleId = $_GET["id"];

if ($conn->connect_error) {
    echo "Error: Unable to connect to server" . PHP_EOL;
    echo "Debugging errno: " . mysqli_connection_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connection_error() . PHP_EOL;
    exit;
}
$result = $conn->query("SELECT b.Body FROM Article a, ArticleBody b WHERE a.ArticleId = " . $articleId . " and b.ArticleId = " . $articleId . ";");
if ($result == FALSE) {
    die();
}
while ($row = $result->fetch_assoc()) {
    $output[] = $row;
}
print(json_encode($output));

$conn->close();
?>
