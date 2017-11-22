<?php



function html_header($title='Filmfavoriten') {

	return  '<!DOCTYPE HTML>  
	<html>
	<head>
	<meta charset="utf-8" />
	<link href="style.css" rel="stylesheet">
	<title>'.$title.'</title><body class="logo">
   

	';
}

function html_footer() {
	return "<div class='footer'>&nbsp; © Filmfavoriten V.2.0- Utvecklad av Jesper Jonsson, Johanna Tsakiris, Samuel Andersson, Erik Andersson, Edvard Lindgren</div></body></html>";
}




?>