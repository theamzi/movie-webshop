<?php

include_once "db_connect.php";
include_once "html_headers.php";


function get_product_name($id) {
$out = "";

if($mysqli = connect_db()) {
 	$sql = "SELECT * FROM film WHERE filmid='".$id."'";
 	$result = $mysqli->query($sql);
 	print_r($mysqli->error);
 	while($row = $result->fetch_array()) {
 		//print_r($row);
 		$out .= $row['titel'];
 	}
 } 

return $out;
}
//Information om produkterna
function product_entry($ar, $class='product') {
	return "<div class='".$class."'><h1>".$ar['titel']."</h1>" 
	
	. "<p>" .$ar['beskrivning']."</p>" 
        
         . "<a href='http://www.imdb.com/title/" . $ar["imdbid"] . "'><img src='http://ia.media-imdb.com/images/G/01/imdb/images/logos/imdb_fb_logo-1730868325._CB379391653_.png' width=20%> </a>"
         . "<p>" ."<h4>Kundernas betyg: " .$ar['upd_rating']. "</h4>"."</p>"
	
	. "<p>  <img src='." . $ar['filmbild'] . "'></p>"
        
	
    
. "<iframe width='400' height='225' src='http://www.youtube.com/embed/". $ar["youtubeid"] . "' frameborder='0' allowfullscreen></iframe>"
        . "<p>Pris: " .$ar['pris']. ":-"."</p>" 
	. "<form method=POST action='".htmlentities($_SERVER['PHP_SELF'])."'><input type=submit value='Lägg i kundkorgen'/><input name='tillkundkorgen' type=hidden value='".$ar['filmid']."'/></form>"
        
        
	."</div>";

}

// Skriver ut informationen från product_entry
function get_products() {

//Anslutar till DB och hämtar från tabellen film
    $mysqli = connect_db(); 
 	$sql = "SELECT * FROM film";
 	$result = $mysqli->query($sql);
    
    //Skapar tabell och rad
    ?>

 	<table border=1>
    <tr>

<?php
    //Sätter variabel split till 0
$split=0;
    /* Skapar en while loop, där result hämtar metoden fetch_array.  */
while($rows=$result->fetch_array()){
   echo '<td>' .product_entry($rows, ""). /* Skriver ut poster från funktionen                                                      product_entry */ 
    '</td>';
    
    // räknar upp från värdet split(0) som gavs ovan
        $split++;   
    /* om split genom 2 är samma sak som 0 så skall raden brytas och påbörja en ny rad,  detta gör att 2 produkter skrivs ut innan raden bryts */
       if ($split%2==0) {
       echo '</tr><tr>';
        }
    }
    ?>
    </tr></table><!-- avslutandet av rad och table --> 
<?php
// avslutar funktionen
}




?>