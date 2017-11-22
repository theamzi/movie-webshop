<?php

include_once "html_headers.php";
include_once "products.php";
include_once "kundkorg.php";
include_once "order.php";
include_once "total.php";

//Startar session
session_start();


if(isset($_POST['tabortfrankundkorg'])) {
	ta_bort_fran_kundkorg($_POST['tabortfrankundkorg']);
	unset($_POST['tabortfrankundkorg']);

} else if(isset($_POST['tillkundkorgen'])) {
	lagg_till_i_kundkorg($_POST['tillkundkorgen']);
	unset($_POST['tillkundkorgen']);
	show_kassa();
} else if(isset($_POST['fragaombestallning'])) {



$logged_in = (isset($_SESSION['login']) && $_SESSION['login'] != '');




	echo html_header();
	if($logged_in) {
	  echo get_betalningssida();
	} else {
	  echo get_betalningssida_med_kundinmatning();
	}
	echo html_footer();

} else if(isset($_POST['bestallninggjord']) ) {

	$orderid = lagg_in_order($_SESSION['kundid']);
	echo html_header();
	show_tack($orderid);
	echo html_footer(); 

} else if(isset($_POST['adderakund_och_bestall']) ) {
	
	$kundid = ny_kund($_POST['fnamn'], $_POST['enamn'], $_POST['gatuadress'], $_POST['postnr'], $_POST['postort'], $_POST['epost']);

	$orderid = lagg_in_order($kundid);
	echo html_header();
	show_tack($orderid);
	echo html_footer();

} else {
	show_kassa();
}

//Det som visas efter order är slutförd
function show_tack($ordernumret) {
	$tack = "<h1>Tack för din order!</h1> <p>Orderinformation finner 
	du nedan. Notera ordernumret för eventuella frågor. Ordernummer: ".$ordernumret."</p>";
    
   

	echo $tack.get_order($ordernumret)."<p><a href='index.php'>Förstasidan</a></p>";

}



if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
	//http://www.php.net/manual/en/book.session.php


} else {

	
}
//Om användare inte är inloggad vid orderbeställning visas detta
function get_betalningssida_med_kundinmatning() {

	$out = '
	<h1>Registrera dig som ny kund</h1>
	<h3>Klicka på Beställ nedan för att skicka din order</h3>
	<form id="nykund" action="" method="POST">'.
	'
	<label for="fornamn">Förnamn</label>
	<input type=text id="fornamn" name="fnamn"/>
	</br>
 	<label for="efternamn">Efternamn</label>
	<input type=text id="efternamn" name="enamn"/>
	</br>
	<label for="adressrad1">Gatuadress</label>
	<input type=text id="adressrad1" name="gatuadress"/>
	</br>
	<label for="postnummer">Postnummer</label>
	<input type=text id="postnummer" name="postnr"/>
	</br>
	<label for="postort">Postort</label>
	<input type=text id="postort" name="postort"/>
	</br>
	<label for="epost">e-post</label>
	<input type=text id="epost" name="epost"/>
	</br>
    <input type="submit" name=submit value="Beställ"/>
    <input type=hidden name=adderakund_och_bestall>
	</form>
<a href=index.php>Tillbaka till huvudsidan</a>
	';

return $out;


}
//Det som sätts in i DB när kund som ej är inloggad utför order
function ny_kund($fnamn,$enamn,$gatuadress, $postnr, $postort, $epost) {

	if($mysqli = connect_db()) {
		
	}
	$sql = "INSERT INTO kund(user, password, epost,  fnamn, enamn, gatuadress, postnr, postort) VALUES ("
		."'".$epost."',"  // epost används som användarnamn för nya kunder...
		."'".$fnamn."',"        // Vi borde ha någon funktion som sätter något annat än förnamn som lösenord
		."'".$epost."',"
		."'".$fnamn."',"
		."'".$enamn."',"
		."'".$gatuadress."'," 
		."'".$postnr."'," 
		."'".$postort."')";

	$mysqli->query($sql);
	//print_r($mysqli->error);
	return $mysqli->insert_id;


}

function get_betalningssida() {

		return "<h1>Klicka på Beställ nedan för att skicka din order</h1><form method=POST action=''><input type=submit value='Beställ'/><input type=hidden name='bestallninggjord'/></form>";

}

function get_bestallning() {
    
    
        
    if(count($_SESSION['kundkorg'])==0) {
	return "";
	} else {
		if($_SESSION['access']=="admin") {
			return "Beställningar är avstängd för Admin. Logga in som annan användare för att testa."
                . "<a href=index.php>Tillbaka till huvudsidan</a>";
		} else {
			return "<form method=POST action=''>"
                ."<input type=submit value='Utför beställning'/>"
                ."<input type=hidden name='fragaombestallning'/></form>"
                ."<a href=index.php>Tillbaka till huvudsidan</a>";
            }
        
	   }
	}

    
function get_kassa() {

	return get_kundkorg_kassa().get_bestallning();
}

function show_kassa() {
	echo html_header();
	echo get_kassa();
	echo html_footer();
}

	


?>