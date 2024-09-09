<?php
class Foret {
    private $grille = [];
    private $hauteur;
    private $largeur;
    private $probabilitePropagation;

    public function __construct($hauteur, $largeur, $feuxInitiaux, $probabilitePropagation) {
        $this->hauteur = $hauteur;
        $this->largeur = $largeur;
        $this->probabilitePropagation = $probabilitePropagation;
        
        // Initialisation de la grille
        for ($i = 0; $i < $hauteur; $i++) {
            for ($j = 0; $j < $largeur; $j++) {
                $this->grille[$i][$j] = new Cellule();
            }
        }
        
        // Mise à feu initiale
        foreach ($feuxInitiaux as $feu) {
            list($x, $y) = $feu;
            $this->grille[$x][$y]->allumer();
        }
    }

    public function propagerLeFeu() {
        $nouveauxFeux = [];
        
        // Parcourir la grille pour trouver les cases en feu
        for ($i = 0; $i < $this->hauteur; $i++) {
            for ($j = 0; $j < $this->largeur; $j++) {
                if ($this->grille[$i][$j]->estEnFeu()) {
                    // Éteindre le feu dans cette case
                    $this->grille[$i][$j]->eteindre();

                    // Tenter de propager le feu aux cases adjacentes
                    foreach ($this->obtenirCasesAdjacentes($i, $j) as $adj) {
                        if (rand(0, 100) / 100 < $this->probabilitePropagation) {
                            $nouveauxFeux[] = $adj;
                        }
                    }
                }
            }
        }

        // Allumer les nouvelles cases
        foreach ($nouveauxFeux as $case) {
            $this->grille[$case[0]][$case[1]]->allumer();
        }
    }

    private function obtenirCasesAdjacentes($i, $j) {
        $adjacentes = [];
        
        if ($i > 0) $adjacentes[] = [$i - 1, $j]; // Haut
        if ($i < $this->hauteur - 1) $adjacentes[] = [$i + 1, $j]; // Bas
        if ($j > 0) $adjacentes[] = [$i, $j - 1]; // Gauche
        if ($j < $this->largeur - 1) $adjacentes[] = [$i, $j + 1]; // Droite
        
        return $adjacentes;
    }

    public function aDesFeux() {
        for ($i = 0; $i < $this->hauteur; $i++) {
            for ($j = 0; $j < $this->largeur; $j++) {
                if ($this->grille[$i][$j]->estEnFeu()) {
                    return true;
                }
            }
        }
        return false;
    }

    public function afficherGrille() {
        foreach ($this->grille as $ligne) {
            foreach ($ligne as $case) {
                echo $case->etat . " ";
            }
            echo "\n";
        }
    }
}
