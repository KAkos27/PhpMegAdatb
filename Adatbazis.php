<?php
class Adatbazis
{
    private $host = "localhost";
    private $felhasznaloNev = "root";
    private $jelszo = "";
    private $adatbazis = "magyarkartya";
    private $kapcsolat;
    public function __construct()
    {
        $this->kapcsolat = new mysqli(
            $this->host,
            $this->felhasznaloNev,
            $this->jelszo,
            $this->adatbazis
        );
        $this->kapcsolat->query("SET NAMES UTF8");
    }

    public function adatLeker($oszlop, $tabla)
    {
        $sql = "SELECT $oszlop FROM $tabla";
        return $this->kapcsolat->query($sql);
    }
    public function megjelenit($matrix)
    {
        while ($sor = $matrix->fetch_row()) {
            echo "<img src=\"forras/$sor[0]\" alt=\"forras/$sor[0]\">";
        }
    }
    public function adatLeker2($oszlop1, $oszlop2, $tabla)
    {
        $sql = "SELECT $oszlop1, $oszlop2 FROM $tabla";
        return $this->kapcsolat->query($sql);
    }
    public function megjelenit2($matrix)
    {
        echo "<table>";
        echo "<tr><th>NÉV</th><th>KÉP</th></tr>";
        while ($sor = $matrix->fetch_row()) {
            echo "<tr><td>$sor[0]</td><td><img src='forras/$sor[1]' alt='semmi'></td></tr>";
        }
        echo "</table>";
    }
    public function modosit($tabla, $oszlop, $regi, $uj)
    {
        $sql = "UPDATE $tabla SET $oszlop = '$uj' WHERE $oszlop = '$regi'";
        return $this->kapcsolat->query($sql);
    }
    public function torles($tabla, $oszlop, $ertek)
    {
        $sql = "DELETE FROM $tabla WHERE $oszlop='$ertek'";
        return $this->kapcsolat->query($sql);
    }
    public function sorokSzama($tabla)
    {
        $sql = "SELECT * FROM $tabla";
        return $this->kapcsolat->query($sql)->num_rows;
    }

    public function karytaFeltolt()
    {
        $szinOsszeg = $this->sorokSzama("szin") + 1;
        $formaOsszeg = $this->sorokSzama("forma") + 1;
        for ($szinIndex = 1; $szinIndex < $szinOsszeg; $szinIndex++) {
            for ($formaIndex = 1; $formaIndex < $formaOsszeg; $formaIndex++) {
                $sql = "INSERT INTO kartya(szinAzon, formaAzon) VALUES ('$szinIndex','$formaIndex')";
                $this->kapcsolat->query($sql);
            }
        }
    }

    public function kapcsolatBezar()
    {
        $this->kapcsolat->close();
    }
}
