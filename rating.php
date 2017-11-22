
<?php

// Script skapat av Erik Andersson NISA HT14.

include_once "html_headers.php";

echo html_header();

echo "<h2>Filmbetyg</h2>";

//Länk tillbaka till startsidan
  echo "<p><a href='http://localhost/webbp/projektarbete/index.php'>Tillbaka till startsidan</a></p>";

//Variabel för uppkoppling till DB
$connect = mysqli_connect("localhost","root","","db-projekt");



//Skapar variabel data som databasens tabell film
$data = mysqli_query($connect,"SELECT * FROM film");

// Kör en while loop och hämtar arrayen $data som en assositav array
while ($row = mysqli_fetch_assoc($data)) {
  
    //Sätter tabellerna i databasen som variabler
    $id = $row['filmid'];
    $name_of_movie = $row['titel'];
    $movie = $row['movie'];
    $current_rating = $row['rating'];
    $hits = $row['hits'];
    $filmbild = $row['filmbild'];
    
    
    //Uträkning för nuvarande betyg
    $result=$current_rating/$hits;
    
    // Skapar ett formulär med filmens namn, filmdbild, option-knappar, filmens "värde", räknar ut och visar filmens nuvarande rating samt avrundar resultatet till 2 decimaler.
    echo  "

<form action='rating2.php' method='POST'>
<img src=.$filmbild width=20%><br> $name_of_movie: <select name='rating'>
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
    
    </select>
    
    <input type='hidden' value='$movie' name='movie'>
    <input type='submit' value='Ge ditt betyg'> Nuvarande betyg:" ; echo round($result,2);
    echo "
    </form>
    <br>
    
    ";

  //Uppdaterar betyg på filmen som används till product.php
$upd_rating = mysqli_query($connect, "UPDATE film SET upd_rating = '$result' WHERE filmid='$id'");  
}



//Länk tillbaka till startsidan
  echo "<a href='http://localhost/webbp/projektarbete/index.php'>Tillbaka till startsidan</a>";
                        
                          
                          



?>
