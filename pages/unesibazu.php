<?php
session_start();
require 'config.php';
$user = $_SESSION["username"];
$Title = mysqli_real_escape_String($link, $_REQUEST['Title']);
$Year = mysqli_real_escape_String($link, $_REQUEST['Year']);
$Runtime = mysqli_real_escape_String($link, $_REQUEST['Runtime']);
$Genre = mysqli_real_escape_String($link, $_REQUEST['Genre']);
$Director = mysqli_real_escape_String($link, $_REQUEST['Director']);
$Actors = mysqli_real_escape_String($link, $_REQUEST['Actors']);
$Plot = mysqli_real_escape_String($link, $_REQUEST['Plot']);
$Language = mysqli_real_escape_String($link, $_REQUEST['Language']);
$Poster = mysqli_real_escape_String($link, $_REQUEST['Poster']);
$watched = mysqli_real_escape_String($link, $_REQUEST['Watched']);


// Attempt insert query execution
$sql = "INSERT INTO movies (user, Title, Year, Runtime, Genre, Director, Actors, Plot, Language, Poster, watched) VALUES ('$user', '$Title', '$Year', '$Runtime', '$Genre', '$Director', '$Actors', '$Plot', '$Language', '$Poster', '$watched')";
if(mysqli_query($link, $sql)) {
    echo $user . " " . $Title . " " .  $Year . " " .  $Runtime . " " .  $Genre . " " .  $Director . " " .  $Actors . " " .  $Plot . " " .  $Language . " " .  $Poster . " " .  $watched;
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);

?>