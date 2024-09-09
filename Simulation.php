<?php
class Simulation {
    private $foret;

    public function __construct($fichierConfig) {
        $config = json_decode(file_get_contents($fichierConfig), true);
        $hauteur = $config['dimensions']['hauteur'];
        $largeur = $config['dimensions']['largeur'];
        $feuxInitiaux = $config['feux_initiaux'];
        $probabilite = $config['probabilite_propagation'];
        
        $this->foret = new Foret($hauteur, $largeur, $feuxInitiaux, $probabilite);
    }

    public function demarrer() {
        $etape = 0;
        while ($this->foret->aDesFeux()) {
            echo "Étape : " . $etape . "\n";
            $this->foret->afficherGrille();
            $this->foret->propagerLeFeu();
            $etape++;
        }
        echo "Le feu s'est éteint après " . $etape . " étapes.\n";
    }
}
