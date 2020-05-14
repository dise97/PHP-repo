<?php
// Postavljenje cookie
$cookie_name = "user";
$cookie_value = "Kolačići!";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); 
?>
<?php
// Zapocinjanje sesije
session_start();
?>
<html lang="en">
<head>
    <title>Vremenska prognoza LOGIN</title>
    <link rel="stylesheet" href="styleINDEX.css">
</head>
<body>
    <div id="cookie">
<?php
// Provjera da li su cookie setani i poruka o statusu
if(!isset($_COOKIE[$cookie_name])) {
    echo "Cookie nazvan '" . $cookie_name . "' nije setovan!";
} else {
    echo "Cookie '" . $cookie_name . "' je setovan!<br>";
    echo "" . $_COOKIE[$cookie_name]."<br>";
}
?> 
    </div>
    <div class="landing">
        <div id="wlcm">Dobro dosli <br> Vremenska prognoza</div>
    </div>
    <div id="basic">
            <div id="loginforma">
                <div class="container">
                <h2 class="pr1">Prijavite se ovdje</h2>
                <form action = "validacija.php" method = "POST">
                    <div class = "form-group">
                        <p class="para">Korisnicko ime</p>
                        <input id="in1" type = "text" name="username" class = "form-control" placeholder="Ime" required>
                    </div>
                    <div class = "form-group">
                        <p class="para">Sifra</p>
                        <input type = "password" name="password" class = "form-control" required><br>
                    </div>
                    <button name="Login" type = "submit" class = "dugmad">Prijava</button>  
                    <?php
                    if(@$_GET['Invalid']==true){
                    ?>
                        <div class="wlcm"><?php echo $_GET['Invalid'] ?></div>
                            <?php
                                   }
                        ?>
                </form>
                <button class="dugmad" onclick="prikazireg()">Niste registrovani?</button>
                </div>
            </div>
        <link rel="stylesheet" href="styleINDEX2.css">
        <div class="container2" id="div">
        <h1>Poštovani korisniče, s ciljem unapređenja pretraživanja ove stranice, koristimo kolačiće!<br>
        Ukoliko nastavite sa korišćenjem stranice, znači da se slažete sa uslovima korišćenja kolačića.</h1>
        <a href="#">Više o ovome pročitajte ovdje.</a>
        <div class="button1" >U redu</div>
        <?php echo "<script language='javascript'>
            window.onload = function() {
  document.getElementById('div').onclick = function() {
    this.style.display = 'none';
  };
};</script>" ?>
    </div>
    </div>
            <div id="prlx2">
            <div id="reg" style="visibility: hidden;">
                <div id="kartica">
                <h2 class="pr1">Registrujte se ovdje</h2>
                <form action = "registracija.php" method = "POST">
                    <div class = "form-group">
                        <p class="para">Korisnicko ime</p>
                        <input type="text" name="username" class="form-control">
                    </div>
                    <div class = "form-group">
                        <p class="para">Sifra</p>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class = "form-group">
                        <p class="para">Lokacija</p>
                        <input type="text" name="location" class="form-control">
                    </div>
                    <button type = "submit" class = "dugmad">Registracija</button>
                    <?php
                    if(@$_GET['Valid']==true){
                    ?>
                        <div class="wlcm"><?php echo $_GET['Valid'];?>
                            <?php
                                   }
                        ?>
                    <?php 
                    if(@$_GET['Invalid2']==true){
                    ?>
                        <div class="wlcm"><?php echo $_GET['Invalid2'] ?></div>
                            <?php
                                   }
                        ?>

                </form>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
<script>
    // Dio koji pomaze da pokazemo registraciju
    function prikazireg(){
        document.getElementById('reg').style.visibility = 'visible';
    }
    </script>
</body>
</html>