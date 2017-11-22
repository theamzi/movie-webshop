<?php


include_once "html_headers.php";
include_once "kundkorg.php";
include_once "products.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">		
	</head>
	<body>
	<?php
	//Hämta in värde för typ av genre
		$genretyp=$_POST['genre'];
	?>
        
        <a href="http://localhost/webbp/projektarbete/index.php"><h3>Startsida</h3></a><br> 
        <a href="http://localhost/webbp/projektarbete/rating.php"><h3>Betyg</h3></a>
        
	<h3>Välj genre och klicka sedan på sortera</h3>
	<form action="specgenre.php" method="post">
	<select name="genre">
         <!-- Användaren kan välja olika "genres", beroende på vilken genre användaren väljer kommer den valda genren fortfarande visas som aktiv i option-menyn -->
                  <option value="action"<?php if ($genretyp=="action") echo "selected" ?>>Action</option>
                  <option value="drama"<?php if ($genretyp=="drama") echo "selected" ?>>Drama</option>
                  <option value="thriller"<?php if ($genretyp=="thriller") echo "selected" ?>>Thriller</option>
                  </select>	
		<input type="submit" name="skicka" value="Sortera">
	</form>
	<br/>
	
	<?php
	
	//Genre väljs när anvandaren klickar på skicka
	if(isset($_POST["skicka"]))
	{
		{
			//En switch där de olika cases hämtar en specifik function från "specgenre.php"
			//En rubrik för varje typ av genre skrivs ut tillsammans med den associerade funktionen
			switch ($genretyp)
			{
			case "action":
			echo get_specgenre1();
			break;
		
			case "drama":
			echo get_specgenre2();
			break;
		
			case "thriller":
			echo get_specgenre3();
			break;
		
			}
		}
	}

	?>
	</body>
</html>