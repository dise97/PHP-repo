<?php
session_start();

// Povlacenje sesije iz fajla validacija.php o tome koji je user zapoceo sesiju
if(isset($_SESSION['username'])){
 $username = $_SESSION['username'];
}

$servername = "localhost";
$user = "root";
$password = "";
$dbname = "users";

// Kreiranje konekcije
$conn = new mysqli($servername, $user, $password, $dbname);
// Provjera konekcije
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT location FROM user_data WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output podataka iz MySql tabele
    while($row = $result->fetch_assoc()) {
        $var = $row["location"]; //varijabla koja ce nam povuci lokaciju 
    }
} else {
    echo "0 results";
}
$conn->close();

$apiKey = "f6a41eb2179bf9fd786db3117dd40066"; // Api key koji smo dobili na OpenWeather
$cityName = $var; // Povlacenje lokacije iz tabele 
$googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?q=" . $cityName . "&lang=hr&units=metric&APPID=" . $apiKey;

$ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);

curl_close($ch);
$data = json_decode($response);
$currentTime = time();
?>


<!doctype html>
<html>
<head>
<link rel="stylesheet" href="styleMAIN.css">
<link rel="stylesheet" href="styleMAIN2.css">
<title>Vremenska prognoza sa Openweathermap u PHP</title>
</head>
<body>
    <div id="tekst" class="report-container">
        <h2>Trenutna prognoza za grad <?php echo $data->name; ?></h2>
        <div class="time">
            <div><?php echo date("l g:i a", $currentTime); ?></div> 
            <div><?php echo date("jS F, Y",$currentTime); ?></div>
            <br>
        </div>
        <div class="weather-forecast">
        <?php echo ucwords($data->weather[0]->description); ?><img
                src="http://openweathermap.org/img/w/<?php echo $data->weather[0]->icon; ?>.png"
                class="weather-icon" /> <br> <?php echo "Trenutna temperatura: " . $data->main->temp; ?>°C <br>
        </div>
        <div class="time">
            <div>Vlažnost zraka: <?php echo $data->main->humidity; ?> %</div>
            <div>Vjetar: <?php echo $data->wind->speed; ?> km/h</div>
            <form action="logout.php">
        <input type="submit" name="redirect" value="Odjava">
    </form>
        </div>
    </div>
</body>
</html>