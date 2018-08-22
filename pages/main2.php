<?php
require 'config.php';
 echo '<html>
        <head>
        <title>Ispis baze</title>
        <meta charset="utf-8">
        <link href="../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
        </head>
        </html>';
      
$sql = "SELECT * FROM movies";
$result = $link->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["user"] . " - Title: " . $row["Title"] . " - Year: " . $row["Year"] . " - Runtime: " . $row["Runtime"] . " - Genre: " . $row["Genre"] . " - Director: " . $row["Director"] . " - Actors: " . $row["Actors"] . " - Plot: " . $row["Plot"] . " - Language: " . $row["Language"] . " - Poster: " . $row["Poster"] . " - watched: " . $row["watched"] . " - created_at: " . $row["created_at"] . "<br>";
    }
} else {
    echo "0 results";
}
$link->close();
?>