<?php

include_once "db_connect.php";
include_once "html_headers.php";


function login_form($msg='') {

		return 	$msg.'<form id="login" method=POST action="">
		<div id=loginruta>
		<p><label for=username>Användarnamn: </label>
		<input type=text name=username value="">
		</p>
		<p><label for=password>Lösenord: </label>
		<input type=password name=password>
		</p>
		<p>
		<input type=submit value="Logga in"/>
		</p>
		</div>
		</form>	';

}


if(isset($_POST['username']) && isset($_POST['password'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	// kolla om användarnamn och lösenord är rätt. check_credentials() returnerar information om användaren i en array.
	if($user_info = check_credentials($username, $password)) {
		session_start(); //starta session
        //Variabler för att visa vem som är inloggad
		$_SESSION['login']='Inloggad som: ';
        $_SESSION['username']=$user_info['fnamn']." ".$user_info['enamn'];
   
        
        
		if($user_info['usertype'] == 'customer') {
			
			$_SESSION['kundid']=$user_info['kundid'];
           

		} elseif ($user_info['usertype'] == 'admin') {
			$_SESSION['username']= 'Admin'. $user_info['admin'];  
			$_SESSION['access'] = 'admin';   // Admin har andra rättigheter (som sätts per sida)
		}
	//skicka användaren till framsidan eller, om det är en annan sida användaren försöker nå. Till den.	
	if(isset($_GET['redirect'])) {
		header ("Location: ".$_GET['redirect']);

	} else {
		header ("Location: index.php");
    }
	
	} else {
	echo html_header('Logga in');
	echo login_form('<div class="errmsg">Inloggning misslyckades</div>');
	echo html_footer();

	}

} else {
	echo html_header('Logga in');
	echo login_form('');
	echo html_footer();

}









?>