<?php
function connect_db(){
	global $connection;
	$host="localhost";
	$user="test";
	$pass="t3st3r123";
	$db="test";
	$connection = mysqli_connect($host, $user, $pass, $db) or die("ei saa ühendust mootoriga- ".mysqli_error());
	mysqli_query($connection, "SET CHARACTER SET UTF8") or die("Ei saanud baasi utf-8-sse - ".mysqli_error($connection));
}

function logi(){
	global $connection;
	if(!empty($_SESSION["user"])){
		header("Location: ?page=todoview");
	}else{


		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			if($_POST["user"] == '' || $_POST["pass"] == ''){
				$errors =array();
				if(empty($_POST["user"])) {
					$errors[] = "Palun sisestage kasutajanimi!";
				}
				if(empty($_POST["pass"]))
					$errors[] = "Palun sisestage parool!";
				}else{
					$kasutaja = mysqli_real_escape_string ($connection, $_POST["user"]);
					$parool = mysqli_real_escape_string ($connection, $_POST["pass"]);


					$sql = "SELECT id FROM 10153400_pr_users WHERE username='$kasutaja' AND password=sha1('$parool')";


					$result = mysqli_query($connection, $sql);
					$rida = mysqli_num_rows($result);

					if($rida){
						$_SESSION["user"] = $_POST["user"];
						header("Location: ?page=todoview");
					}else{
						header("Location: ?page=login");
					}
				}

			}else{


			}
		}
include('views/login.html');
	}
	
function logout(){
	$_SESSION=array();
	session_destroy();
	header("Location: ?");
}


?>