<?php
function lagg_till_i_kundkorg($id) {

	if(isset($_SESSION['kundkorg'])) {} else {
		$_SESSION['kundkorg'] = array();
	}

	if($mysqli = connect_db()) {
 	$sql = "SELECT * FROM film WHERE filmid='".$id."'";
 	$result = $mysqli->query($sql);
 	while($row = $result->fetch_array()) {
		array_push($_SESSION['kundkorg'], $row);
 	}
 } 
}
 
function ta_bort_fran_kundkorg($id_att_ta_bort) {
	foreach ($_SESSION['kundkorg'] as $key => $value) {
		if($id_att_ta_bort == $key) {
			unset($_SESSION['kundkorg'][$key]);
		}
	}
}

function get_admin_page_head() {
	
	$logged_in = (isset($_SESSION['login']) && $_SESSION['login'] != '');
	if($logged_in) {
		if(isset($_SESSION['access']) && $_SESSION['access'] == 'admin') {
		
	}
	}
	return "";
}

function get_page_head() {
	$logged_in = (isset($_SESSION['login']) && $_SESSION['login'] != '');

	if(isset($_SESSION['kundkorg'])) {
	$kundkorg = get_kundkorg($_SESSION['kundkorg']);
	} else {
		$kundkorg = "";
	}
    
    
    
	if($logged_in) {
		   return  "<a href='logout.php'>Logga ut</a>". $kundkorg."</div>";			
	} else {
		   return "<div class='userinfo'><a href='login.php'>Logga in</a>". $kundkorg."</div>";	
	}


}

// När produkt ligger i kundkorgen
function get_kundkorg() {
	$out = "<div id='kundkorg'>";

   	if(isset($_SESSION['kundkorg'])) {
		foreach ($_SESSION['kundkorg'] as $key => $value) {
		$out .= "<div class='product inbasket'><table><td>"
		."<div"
		."<p><b>".$value['titel']."</b></p>" 
		. "<p>Pris: " .$value['pris']. ":-"."</p>" 
		. "<p>  <img src='." . $value['filmbild'] . "'></p>"	
		. "</div>"
		. "<form class='tabort' action=\"".htmlentities($_SERVER['PHP_SELF'])."\" method=POST><input type=submit value='X'/><input type=hidden name=tabortfrankundkorg value=".$key."/></form>"	
		."</td></table>"
		."</div>";
		}
	}

	$out .= "</div>"."<a href=kassa.php>Gå till kassan</a>";
	return $out;
}
//När kassan är tom
function get_kundkorg_kassa() {
    
	$out = "<div id='kundkorg_i_kassa'>";
	if(count($_SESSION['kundkorg'])==0) {
		echo "<p>Kassan är tom. Gå till <a href='index.php'>framsidan för att handla</a></p>";
         
        //När kassan innehåller produkter
		echo "<p>Kassan innehåller ".count($_SESSION['kundkorg'])." produkter. Gå till <a href='index.php'>framsidan för att fortsätta handla</a><br></p>";
       
	
   //Hur kundkorgen ser ut när användare är i kassan
	}
	if(isset($_SESSION['kundkorg'])) {
			foreach ($_SESSION['kundkorg'] as $key => $value) {
			$out .= "<div class='product incashout'><h1>".$value['titel']."</h1>" 
			. "<p>  <img src='." . $value['filmbild'] . "'></p>"
			. "<p>Pris: " .$value['pris']. ":-"."</p>" 
            ."</div>";
			}
	}
	
	$out .= "</div>".get_kassasumma();
	return $out;
}


	
?>
