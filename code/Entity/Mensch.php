<?php

/**
 * Der Mensch
 *
 *
 */
class Mensch
{
    private int $groesse;
    private string $haarfarbe;
    private string $geschlecht;
    private string $name;
    public function __construct(string $name, int $groesse, string $geschlecht, string $haarfarbe)
    {
        $this->name = $name;
        $this->groesse = $groesse;
        $this->geschlecht = $geschlecht;
        $this->haarfarbe = $haarfarbe;

    }

    public function gehen()
    {
        echo('Ich gehe');
    }

    public function sagName()
    {
        echo('Mein Name ist ' . $this->name);
    }

    public function getgroesse()
    {

        return $this->groesse;
    }



    /**
     * @return string
     */
    public function getHaarfarbe(): string
    {
        return $this->haarfarbe;
    }

    /**
     * @param string $haarfarbe
     */
    public function setHaarfarbe(string $haarfarbe): void
    {
        $this->haarfarbe = $haarfarbe;
    }

    /**
     * @return string
     */
    public function getGeschlecht(): string
    {
        return $this->geschlecht;
    }

    /**
     * @param string $geschlecht
     */
    public function setGeschlecht(string $geschlecht): void
    {
        $this->geschlecht = $geschlecht;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }


}


// Erstelle des Objects $manuel der Class Mensch
$manuel = new Mensch('Manuel', 185, 'm', 'Braun');

echo('Manuel ist' . $manuel->getgroesse());
echo('<br>');

// Zuweisen der Attribute des Objects $manuel
//$manuel->name = 'Manuel';
//$manuel->groesse = 185;
//$manuel->haarfarbe = 'Braun';
//$manuel->geschlecht = 'm';

// Erstelle des Objects $lars der Class Mensch
$lars = new Mensch('Lars', 200, 'm', 'Blond');

// Zuweisen der Attribute des Objects $lars

//$lars->name = 'Lars';
//$lars->geschlecht= 'm';
//$lars->haarfarbe = 'Blond';
//$lars->groesse = 200;

// Erstelle des Objects $tina der Class Mensch
$tina = new Mensch('Tina', 170, 'w', 'Schwarze');

// Zuweisen der Attribute des Objects $tina
//$tina->name = 'Tina';
//$tina->haarfarbe = 'Schwarz';
//$tina->groesse = 170;
//$tina->geschlecht = 'w';

//Ausgabe des Attribute name des Objects $manuel
var_dump($manuel->getName());
echo('<br>');
//Ausgabe des Attribute geschlecht des Objects $lars
var_dump($lars->getGeschlecht());
echo('<br>');
//Ausgabe des Attribute haarfarbe des Objects $tina

var_dump($tina->getHaarfarbe());
echo('<br>');
// Aufrufen der Methode sagName des Objects $tina
$tina->sagName();
echo('<br>');
// Aufrufen der Methode sagName des Objects $lars

$lars->sagName();
echo('<br>');

// Aufrufen der Methode sagName und gehen des Objects $manuel
$manuel->sagName();
echo('<br>');
$manuel->gehen();


