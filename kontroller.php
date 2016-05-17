<?php
require_once("kood/funktsioonid.php");
include_once('vaated/header.html');
$mode="";
if (!empty($_GET["mode"])) {
	$mode=$_GET["mode"];
}

switch($mode){
	case "login":
		include('vaated/login.php');
	break;
	case "signup":
		include('vaated/signup.php');
	break;
    case "todoview":
		include("vaated/todoview.php");
	break;
	case "logout":
		include("vaated/esileht.php");
	break;
	default:
		include('vaated/esileht.php');
	break;
}
include_once('vaated/footer.html');


?>