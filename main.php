<?php
require_once 'Cellule.php';
require_once 'Foret.php';
require_once 'Simulation.php';

if ($argc != 2) {
    echo "Usage: php main.php <fichier_de_configuration>\n";
    exit(1);
}

$fichierConfig = $argv[1];

$simulation = new Simulation($fichierConfig);
$simulation->demarrer();
