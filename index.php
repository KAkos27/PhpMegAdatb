<?php
include_once "Adatbazis.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magyar Kártya</title>
</head>

<body>
    <?php
    $adatbazis = new Adatbazis();
    //$matrix = $adatbazis->adatLeker("kep", "szin");
    //$adatbazis->megjelenit($matrix);
    if ($adatbazis->sorokSzama("kartya") == 0) {
        $adatbazis->karytaFeltolt();
    }
    $adatbazis->modosit("szin", "nev", "green", "zöld");
    $adatbazis->torles("szin", "nev", "zöld");
    $ujMatrix = $adatbazis->adatLeker2("nev", "kep", "szin");
    $adatbazis->megjelenit2($ujMatrix);
    $adatbazis->kapcsolatBezar();
    ?>

</body>

</html>