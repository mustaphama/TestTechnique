<?php
class Cellule {
    const FORET = '^';
    const FEU = '#';
    const BRULE = '-';
    
    public $etat;
    
    public function __construct($etat = self::FORET) {
        $this->etat = $etat;
    }
    
    public function estEnFeu() {
        return $this->etat === self::FEU;
    }
    
    public function estCendre() {
        return $this->etat === self::BRULE;
    }
    
    public function allumer() {
        if ($this->etat === self::FORET) {
            $this->etat = self::FEU;
        }
    }
    
    public function eteindre() {
        if ($this->etat === self::FEU) {
            $this->etat = self::BRULE;
        }
    }
}
