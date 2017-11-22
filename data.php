<?php
require_once "db_connect.php";
require_once "products.php";

function uppdatera_data() {
if($mysqli = connect_db()) {

	$sql = 'SELECT * FROM `order` WHERE 1';
	$result = $mysqli->query($sql);
	$stats = array();
 	print_r($mysqli->error);

 	while($row = $result->fetch_array()) {

 		$bestallt = $row['bestallt'];
 		$productidn = explode(",", $bestallt);
 		
 		foreach ($productidn as $key => $value) {

 			$stats[get_product_name($value)]++;  // vi räknar en kula som såld
 		}
 	}

		$data = array();
		$labels = array();

	foreach ($stats as $key => $value) {

		array_push($data, $value);
 		array_push($labels, $key);
	} 		
 	


		// Skriv ut ett felmeddelande om filen inte går att läsa samt avsluta.
		$fil= fopen("tmp/forsaljningsdata.tsv","w");

		if(!$fil) die ("Filen kan ej öppnas");

		fwrite($fil, "labels");
		fwrite($fil, "\t");
		fwrite($fil, "antal\n");


		for($i=0;$i<count($labels); $i++) {
			fwrite($fil, $labels[$i]);
			fwrite($fil, "\t");
			fwrite($fil, $data[$i]."\n");
		}
			
		fclose($fil);
	}
}


?>