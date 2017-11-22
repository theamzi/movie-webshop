<?php
session_start();


include_once "html_headers.php";
include_once "genre.php";
include_once "kundkorg.php";





error_reporting(E_ALL);

//Om användaren tar bort eller lägger till i kundkorgen när denne är inne i specgenre, så skickas denne till index.php, detta är inte en optimal lösning men den fungerar

if(isset($_POST['tabortfrankundkorg'])) {
	ta_bort_fran_kundkorg($_POST['tabortfrankundkorg']);
	unset($_POST['tabortfrankundkorg']);
	header ("location:http://localhost/webbp/projektarbete/index.php");
	}
if(isset($_POST['tillkundkorgen'])) {
	lagg_till_i_kundkorg($_POST['tillkundkorgen']);
	unset($_POST['tillkundkorgen']);
		header ("location:http://localhost/webbp/projektarbete/index.php");
	}
	
if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
//show_specgenre tar med funktioner såsom html_header osv.
show_specgenre();

} else {
//show_logged_in_specgenre tar med funktioner såsom html_header osv. samt visar vem som är inloggad
    
    
show_logged_in_specgenre();
    }


function show_specgenre() {
//Vi valde att inte visa kundkorgen vid sortering av genre då vi ändå skickar användare tillbaka till startsidan när denne lägger något i kundkorgen
	echo html_header();
	//echo get_page_head();
	echo html_footer();
}
function show_logged_in_specgenre()  {
    
//Vi valde att inte visa kundkorgen vid sortering av genre då vi ändå skickar användare tillbaka till startsidan när denne lägger något i kundkorgen
	echo html_header();
	//Hämtar $SESSION och visar namnet på den inloggade
	//echo 'Inloggad som:' .$_SESSION['fnamn'].' '.$_SESSION['enamn'];
	echo get_admin_page_head(); 
	//echo get_page_head();
	echo html_footer();
}


//Nedan följer de olika funktionerna för genre samt hur de skrivs ut
//Till stor del anpassad från funktionen för att visa produkter från products.php
 

//Genre nr 1 - Action

function get_specgenre1() {


    $mysqli = connect_db(); 
 	$sql = "SELECT * FROM film WHERE genreid='1'";
 	$result = $mysqli->query($sql);
    
    ?>
<h1>Action</h1>
 	<table border=1>
    <tr>

<?php
//Användare samma funktion för att skriva ut produkterna som i products.php
$split=0;
while($rows=$result->fetch_array()){
   echo '<td>' .product_entry($rows, ""). 
    '</td>';
        $split++;   
       if ($split%2==0) {
       echo '</tr><tr>';
        }
    }
    ?>
    </tr></table>
<?php
}

//Genre nummer 2 - Drama
function get_specgenre2() {


    $mysqli = connect_db(); 
 	$sql = "SELECT * FROM film WHERE genreid='2'";
 	$result = $mysqli->query($sql);
    
    ?>
<h1>Drama</h1>
 	<table border=1>
    <tr>

<?php
$split=0;
while($rows=$result->fetch_array()){
   echo '<td>' .product_entry($rows, ""). 
    '</td>';
        $split++;   
       if ($split%2==0) {
       echo '</tr><tr>';
        }
    }
    ?>
    </tr></table>
<?php
}
//Genre nummer 3 - Thriller
function get_specgenre3() {


    $mysqli = connect_db(); 
 	$sql = "SELECT * FROM film WHERE genreid='3'";
 	$result = $mysqli->query($sql);
    
    ?>
<h1>Thriller</h1>
 	<table border=1>
    <tr>

<?php
$split=0;
while($rows=$result->fetch_array()){
   echo '<td>' .product_entry($rows, ""). 
    '</td>';
        $split++;   
       if ($split%2==0) {
       echo '</tr><tr>';
        }
    }
    ?>
    </tr></table>
<?php
}
?>