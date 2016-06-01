<?php
	
	// Kontrollib kas kasutaja on sisse logitud
	function controller_user() {
		if( empty($_SESSION['user']) ) {
			return false;
		}
		return $_SESSION['user'];
	}
	
	//Lisab uue kasutajakonto
	function controller_register($kasutajanimi, $parool) {
		if ($kasutajanimi == '' || $parool == '') {
			message_add('Kasutajanimi ja parooli lahtrid ei saa olla tühjad!');
			return false;
		}
		if ( model_user_add($kasutajanimi, $parool) ) {
			message_add('Teie konto on registreeritud');
			return true;
		}
		message_add('Konto registreerimine ebaõnnestus, kasutajanimi võib olla juba võetud!');
		return false;
	}
	
	//Logib sisse kasutaja
	function controller_login ($kasutajanimi, $parool) {
		if ($kasutajanimi == '' || $parool == '') {
			message_add('Kasutajanimi ja parooli lahtrid ei saa olla tühjad!');
			return false;
		}
		$kasutaja_id = model_user_get($kasutajanimi, $parool);
		if (!$kasutaja_id) {
			message_add('Kasutajanimi või parool on vigane');
			return false;
		}
		session_regenerate_id();
		$_SESSION['user'] = $kasutaja_id;
		message_add('Tere tulemast, '.$kasutajanimi.'!');
		return $kasutaja_id;
	}
	
	//Logib välja kasutaja
	function controller_logout () {	
		if ( isset( $_COOKIE[session_name()] ) ) {
			setcookie( session_name(), '', time() - 42000, '/' );
		}	
		$_SESSION = array();	
		session_destroy();	
		message_add('Teie olete nüüd välja logitud');	
		return true;
		
	}
	
	function controller_gobooking($kinoseansi_id, $aeg) {	
		$sysdate = date('Y-m-d H:i:s');	
		if ( !controller_user() ) {
			message_add('Kasutaja peab olema sisselogitud!');
			return false;
		}		
		if ($kinoseansi_id <= 0) {
			message_add('Sisendandmed on vigased!');
			return false;
		}		
		if ($aeg < $sysdate) {
			message_add('Pileteid ei saa broneerida juba toimunud kinoseansile!');
			return false;
		}	
		if ( model_gobooking($kinoseansi_id, $aeg) ) {
			message_add('Valisite kinoseansi '.$kinoseansi_id.'!');
			return true;
		}		
		message_add('Kinoseansi pileti(te) broneerimine ebaõnnestus');
		return false;		
	}
	
	//Broneerib pileteid valitud kinoseansile
	function controller_booking($kinoseansi_id, $piletid) {		
		if ( !controller_user() ) {
			message_add('Kasutaja peab olema sisselogitud!');
			return false;
		}		
		$vabad_kohad = model_gobooking($kinoseansi_id);
		if ($piletid <= 0 || $kinoseansi_id <= 0 || $vabad_kohad['kohad']<$piletid) {
			message_add('Broneeritavate piletite hulk ei tohi ületada vabade kohtade arvu ja piletite arv peab olema positiivne');
			return false;
		}	
		if ( model_booking($kinoseansi_id, $piletid) ) {
			message_add('Kinoseansile broneeritud piletite arv: '.$piletid);
			return true;
		}	
		message_add('Andmete uuendamine ebaõnnestus!');
		return false;
	}
	
	//Lisab uue kinoseansi kinokavasse
    function controller_add($nimetus, $aeg, $kohad) {
		
		$sysdate = date('Y-m-d H:i:s');
		if ( !controller_user() ) {
			message_add('Kasutaja peab olema sisselogitud!');
			return false;
		}
		// kontrollime, kas sisendväärtused on oodatud kujul või mitte
		if ($aeg == '' || $nimetus == '' || $kohad <= 0 || $aeg < $sysdate ) {
			message_add('Sisestatud sisendandmed on vigased! Kõik vormilahtrid peavad olema täidetud ja kinoseansi algusaeg ei tohi olla möödunud!');
			return false;
		}
		if ( model_add($nimetus, $aeg, $kohad) ) {
			message_add('Kinokavasse õnnestus lisada uus kinoseanss!');
			return true;
		}	
		message_add('Andmete lisamine ebaõnnestus!');
		return false;
	}
	
	//Kustutab kinoseansi kinokavast
	function controller_delete($kinoseansi_id) {	
		if ( !controller_user() ) {
			message_add('Kasutaja peab olema sisselogitud!');
			return false;
		}		
		if ($kinoseansi_id <= 0) {
			message_add('Sisendandmed on vigased!');
			return false;
		}		
		if ( model_delete($kinoseansi_id) ) {
			message_add('Kinokavast kustutati kinoseanss nr. '.$kinoseansi_id);
			return true;
		}
		message_add('Kinoseansi kustutamine ebaõnnestus!');
		return false;
	}
	
	//Tagastab kõik hetkel ootel olevad sõnumid
	function message_list() {
		if ( empty($_SESSION['messages']) ) {
			return array();
		}
		$messages = $_SESSION['messages'];
		$_SESSION['messages'] = array();
		return $messages;
	}
	
	//Lisab järjekorda uue sõnumi kasutajale kuvamiseks
	function message_add($message) {
		if ( empty($_SESSION['messages']) ) {
			$_SESSION['messages'] = array();
		}
		$_SESSION['messages'][] = $message;
	}
	