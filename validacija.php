<?php

session_start();

$con = mysqli_connect("localhost","root","","users");

// Provjera konekcije
if (mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
	exit();
}

// Provjera input vrijednosti od strane korisnika
$name = mysqli_real_escape_string($con, trim($_POST['username']));
$pass = mysqli_real_escape_string($con, trim($_POST['password']));

$s = "SELECT * FROM user_data WHERE username = '$name' && password = '$pass'";
$result = mysqli_query($con, $s);
$num = mysqli_num_rows($result);

if($num == 1){
  // Kreiranje sesije za logovanog usera
  $_SESSION['username'] = $name;
  // Prosljeđivanje na glavnu stranicu
  header("Location:stranica.php");
}else{
  // Prosljeđivanje na index stranicu ako podaci nisu validni
  header("location:index.php?Invalid= Pogrešan unos korisnika/šifre");
}


?>