<?php
//Script skapat av Erik Andersson NISA HT14
$connect = mysqli_connect("localhost","root","","db-projekt");

$movie = $_POST['movie'];
$after_rating = $_POST['rating'];

// Hämtar data från tabellen rates beroende på vilken film som valts
$data = mysqli_query($connect, "SELECT * FROM film WHERE movie='$movie'");

//While loop som hämtar variablen data som assosiativ array
while($row = mysqli_fetch_assoc($data))
  
    //Sätter raderna i DB till variabler
{
 $id = $row['filmid'];
 $current_rating = $row['rating'];
 $hits = $row['hits'];
 
}

//Adderar antalet träffar när någon klickar, samt uppdaterar tabellraden hits
$new_hits = $hits + 1;
$upd_hits = mysqli_query($connect, "UPDATE film SET hits = '$new_hits' WHERE filmid='$id'");

//Aderrar nuvarande rating med ny rating som
$before_rating = $current_rating + $after_rating;


//Uppdaterar rating som används för att räkna ut nuvaranade rating
$upd_rating = mysqli_query($connect, "UPDATE film SET rating = '$before_rating' WHERE filmid='$id'");

//Skickar tillbaka användaren direkt till sidan rating.php
header("Location: http://localhost/webbp/projektarbete/rating.php");



?>