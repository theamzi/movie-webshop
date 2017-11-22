<?php

// Bestämmer funktionen get_kassasumma
function get_kassasumma() {
    //Om sessionen kundkorg är aktiv, utförs följande kod
    if(isset($_SESSION['kundkorg'])) {
   
    //Bestämmer att $idn är en array
    $idn = array();
    //Sätter variabeln total som 0
    $total = 0;
    
    //Skapar en foreach-loop    
    foreach ($_SESSION['kundkorg'] as $key => $value) {
        //Sätter in värdet ifrån $value i arrayen $idn
        array_push($idn, $value['filmid']);
        //var_dump($idn);
                   }
            //Skapar en ny foreach-loop där array $idn sätts in som en string $pidn
            foreach ($idn as $key => $pidn) {
        //Åberopar databasen med sql-fråga
        if ($mysqli = connect_db()) {
            $sql = "SELECT pris FROM film WHERE filmid ='".$pidn."'";
                //
                $result = $mysqli->query($sql) or die;
            //While-loop loopar $row som array utifrån värdet i $result 
            while ($row = $result->fetch_array()) {
                //Bestämmer värdet på total
                $total = $total + $row['pris'];
                
            //var_dump($row);
                
               
            } 
        }
    }
//Returnerar $total
     return "<div class='tot'>"
        ."<table><tr><td>"
        ."<h2>SUMMA: "
        .$total
        .":-</h2>"
        ."</td></tr></table>"
        ."</div>";
}
}
?>