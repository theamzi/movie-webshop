<?php

include_once "html_headers.php";
include_once "products.php";
include_once "kundkorg.php";
include_once "genre.php";

session_start();

error_reporting(E_ALL);

if(isset($_POST['tabortfrankundkorg'])) {
	ta_bort_fran_kundkorg($_POST['tabortfrankundkorg']);
	unset($_POST['tabortfrankundkorg']);
}

if(isset($_POST['tillkundkorgen'])) {
	lagg_till_i_kundkorg($_POST['tillkundkorgen']);
	unset($_POST['tillkundkorgen']);
}

if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
	//http://www.php.net/manual/en/book.session.php;
show_start_screen();

} else {

show_logged_in();
	
}

function show_start_screen() {

	echo html_header();
	echo get_page_head();
	echo get_products();
	
	echo html_footer();
}



function show_logged_in()  {

	echo html_header();
	echo get_admin_page_head();
    
    //Anropar inloggad som användare.
    echo "Inloggad som: ";
    echo $_SESSION['username'];
    echo "<br>";
     
    echo get_page_head();
    

	echo get_products();
	
	echo html_footer();

}
	


?>