<?php
require_once 'animal.class.php';

class Human extends Animal
{
    // L'homme doit peser entre 0 et 200kg
    public function setWeight(float $newWeight)
    {
        if ($newWeight <= 200 && $newWeight >= 0) {
            $this->weight = $newWeight;
        } else {
            throw new Exception(__CLASS__ . ' : L\'homme doit peser entre 0 et 200kg.');
        }
    }

    public function getWeight(): float
    {
        return $this->weight;
    }
}
