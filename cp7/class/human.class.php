<?php
require_once 'animal.class.php';

class Human extends Animal
{
    // Constantes de classe
    const PATTERN_NAME = '/^[A-Za-zÀ-ÿ\- ]{1,30}$/';

    // Attributs privés
    private $fname = '';

    // Constructeur
    public function __construct(string $newFname, $newDob)
    {
        // Assigne valeurs aux attributs 
        $this->setFname($newFname);
        $this->setDob($newDob);

        // Incrémente le nb d'instances du parent
        parent::$nb++;
    }

    public function getFname(): string
    {
        return $this->fname;
    }

    // Pour être valable, le prénom ne doit contenir que des lettres
    // de l'alphabet (y compris accents), espace et tiret
    public function setFname(string $newFname): void
    {
        if (preg_match(self::PATTERN_NAME, $newFname) === 1) {
            $this->fname = $newFname;
        } else {
            throw new Exception(__CLASS__ . ' : Le prénom ne doit contenir que des lettres de l\'alphabet accents compris, espace et tiret');
        }
    }

    // L'homme doit peser entre 0 et 200kg
    // Surcharge de la méthode mère
    public function setWeight(float $newWeight)
    {
        if ($newWeight <= 200 && $newWeight >= 0) {
            $this->weight = $newWeight;
        } else {
            throw new Exception(__CLASS__ . ' : L\'homme doit peser entre 0 et 200kg.');
        }
    }
}
