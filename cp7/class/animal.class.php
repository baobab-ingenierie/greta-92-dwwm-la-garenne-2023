<?php

/**
 * Classe Animal pour découvrir la POO
 */
class Animal
{
    // Attributs publics

    // Attributs privés
    private $name;
    private $dob;
    private $weight;
    private $female;

    // Constructeur
    public function __construct(string $newName = '', float $newWeight = 0, bool $newFemale = false)
    {
        $this->setName($newName);
        $this->setWeight($newWeight);
        $this->setFemale($newFemale);
    }

    // Mutateurs (ou setters)
    public function setName($newName)
    {
        $this->name = $newName;
    }

    public function setDob($newDob)
    {
        if ($this->is_date($newDob)) {
            $this->dob = $newDob;
        } else {
            throw new Exception(__CLASS__ . ' : L\'argument doit être une date.');
        }
    }

    // L'animal doit peser entre 0 et 20kg
    public function setWeight(float $newWeight)
    {
        if ($newWeight <= 20 && $newWeight >= 0) {
            $this->weight = $newWeight;
        } else {
            throw new Exception(__CLASS__ . ' : L\'animal doit peser entre 0 et 20kg.');
        }
    }

    public function setFemale(bool $newFemale)
    {
        if (is_bool($newFemale)) {
            $this->female = $newFemale;
        } else {
            throw new Exception(__CLASS__ . ' : L\'argument doit être un booléen.');
        }
    }

    // Accesseurs (ou getters)
    public function getName(): string
    {
        return $this->name;
    }

    public function getDob()
    {
        return $this->dob;
    }

    public function getWeight(): float
    {
        return $this->weight;
    }

    public function getFemale(): bool
    {
        return $this->female;
    }

    // Méthodes privées
    private function is_date($value): bool
    {
        return (bool) strtotime($value);
    }

    // Méthodes publiques
    public function eat(Animal $prey)
    {
        // Le prédateur prend le poids de la proie
        $this->setWeight($this->getWeight() + $prey->getWeight());
        // La proie perd tout son poids
        $prey->setWeight(0);
    }

    public function getAge(): int
    {
        // Utilise la classe DateTime
        $today = new DateTime('now');
        $bday = new DateTime($this->getDob());
        $diff = $bday->diff($today);
        return $diff->y;
    }
}
