<?php
$conn = new mysqli("localhost", "zerg", "", "Dotify");

if ($conn->connect_error) {
    echo "Error: Unable to connect to server" . PHP_EOL;
    echo "Debuging errno: " . mysqli_connection_errno() . PHP_EOL;
    echo "Debuging error: " . mysqli_connection_error() . PHP_EOL;
    exit;
}

$result = $conn->query("select a.Name as artist, b.Title as album, s.Title as song, s.SongUrl as url, s.Track as track from Artist a, Album b, Song s WHERE a.ArtistId = b.ArtistId and b.AlbumId = s.AlbumId and s.ArtistId = a.ArtistId ORDER by a.Name, b.Title, s.SongId ASC;");
while ($row = $result->fetch_assoc()) {
    if (json_encode($row) == null)
        print($row['song']);
    $output[] = $row;
}

print(json_encode($output));

$conn->close();
?>
