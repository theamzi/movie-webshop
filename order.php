<?php

function get_order($orderid) {
		$productidn = "";
		if($mysqli = connect_db()) {
			$sql = "SELECT `bestallt` FROM `order` WHERE ordernr='".$orderid."'";
			$result = $mysqli->query($sql);
			//print_r($sql);
			//print_r("<br>");
			//print_r($mysqli->error);
			while($row = $result->fetch_array()) {
			//	print_r($row);
					$productidn = $row['bestallt'];
	 		}
	 		//print_r($productidn);
			//print_r("<br>");
		 	$orderrader = explode(",", $productidn);
		 	$out ="";
		 	foreach ($orderrader as $key => $value) {
		 		$out .= get_product($value);
		 	}
            
		}
		return "<table class=order>"
            . "<th>Titel</th>"
            . "<th>Artikelnummer"
            . "<th>Beskrivning</th>"
            . "<th>Pris</th>"
            . $out
            . "</table>";
}

function get_product($id) {

$out = "";

if($mysqli = connect_db()) {
 	$sql = "SELECT * FROM film WHERE filmid = ".$id;
 	$result = $mysqli->query($sql);
 	//print_r($sql);
	//print_r("<br>");
 	//print_r($mysqli->error);

 	while($row = $result->fetch_array()) {
 		//print_r($row);
 		$out .= product_row($row);
 	}
 }
return $out;

} 


    
 function product_row($ar) {

     return  "<tr>"
	. "<td>" .$ar['titel']."</td>" 
	. "<td>" .$ar['filmid']."</td>" 
	. "<td>" .$ar['beskrivning']."</td>" 
	. "<td>" .$ar['pris'].":-</td>"
         
	. "</tr>";
 }

function lagg_in_order($kundid) {
	if(isset($_SESSION['kundkorg'])) {
				
				$produkt_idn = array();
				$ordernr = date("Ymd-His"); //vi gör ett ordernummer av en tidsstämpel... inte snyggt, men funkar
				$ordersumma = 0;
				
				foreach ($_SESSION['kundkorg'] as $key => $value) {
				  array_push($produkt_idn, $value['filmid']);
				}
				//print_r($produkt_idn);
				$orderrader = 1;
				foreach ($produkt_idn as $key => $produkt_id) {
					$orderrader++;
				if($mysqli = connect_db()) {
				 	$sql = "SELECT * FROM film WHERE filmid='".$produkt_id."'";
				 	$result = $mysqli->query($sql);
				 	//print_r($mysqli->error);
				 		while($row = $result->fetch_array()) {
				 			$ordersumma = $ordersumma + $row['pris'];
                   
	 					}
	 				}
	 			}
        
	 			if($mysqli = connect_db()) {

	 				$sql = "INSERT INTO `order`(`ordernr`, `kundid`, `bestallt`, `summa`) VALUES ("
	 					."'".$ordernr."',"
	 					."".$kundid."," 
	 					."'".implode(",", $produkt_idn)."'," 
	 					."'".$ordersumma."'" 
	 					.")";
		 		
					$result = $mysqli->query($sql);
					//print_r($mysqli->error);

				 }

                       
	 			//rensa upp
	 			unset($_SESSION['kundkorg']);
			}
			return $ordernr;
	}

?>