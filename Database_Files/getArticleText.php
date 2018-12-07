<?php
$conn = new mysqli("localhost", "kragendor", "", "Dotify");

$articleId = $_GET["id"];

if ($conn->connect_error) {
    echo "Error: Unable to connect to server" . PHP_EOL;
    echo "Debugging errno: " . mysqli_connection_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connection_error() . PHP_EOL;
    exit;
}
$result = $conn->query("SELECT a.Title, b.Body FROM Article a, ArticleBody b WHERE a.ArticleId = " . $articleId . " and b.ArticleId = " . $articleId . ";");
if ($result == FALSE) {
    die();
}
$conn->close();

$row = $result->fetch_assoc();

if ($row == null) {
    die("Article not found");
}

$title = $row['Title'];
$text = $row['Body'];
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8"/>
    <title>Dotify | Article</title>
    <link href="https://fonts.googleapis.com/css?family=Lato|Oswald" rel="stylesheet">
  </head>
  <body>
    <h3><?= $title ?></h3>
    <div class="line-break"></div>
    <p><?= $text ?></p>
  </body>
  <style type="text/css" media="screen">
   html {
       background: #000;
       font-family:
   }

   body {
       background-color: #222;
       padding: 2em;
       color:#fff;
   }

   body h3 {
       font-family: 'Oswald';
   }

   body p {
       font-family: 'Lato';
   }

   .line-break {
       background-color: #555;
       width: 100%;
       clear: both;
       height: 3px;
   }
  </style>
</html>
