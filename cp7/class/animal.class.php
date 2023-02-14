<?php

/**
 * Classe Animal pour découvrir la POO
 */
class Animal
{
    // Constantes de classe
    const ENV_AIR = 'air';
    const ENV_EAU = 'eau';
    const ENV_TERRE = 'terre';
    const LIST_AIR = 'air,aérien,volant,atmosphère,ciel';
    const LIST_EAU = 'eau,lac,lacustre,mer,marin,océan,rivière,fleuve,aquarium,aquatique';
    const LIST_TERRE = 'terre,montagne,arbre,plaine,colline,savane,grotte';

    // Attributs privés
    private $name;
    protected $dob;
    protected $weight;
    private $female;
    private $type = '';

    // Attribut statique
    protected static $nb = 0;

    // Constructeur
    public function __construct(string $newName = '', float $newWeight = 0, bool $newFemale = false)
    {
        $this->setName($newName);
        $this->setWeight($newWeight);
        $this->setFemale($newFemale);
        self::$nb++;
    }

    // Destructeur
    public function __destruct()
    {
        self::$nb--;
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

    public function setType(string $newType): void
    {
        if (in_array($newType, explode(',', self::LIST_AIR))) {
            $this->type = self::ENV_AIR;
        } else if (in_array($newType, explode(',', self::LIST_EAU))) {
            $this->type = self::ENV_EAU;
        } else if (in_array($newType, explode(',', self::LIST_TERRE))) {
            $this->type = self::ENV_TERRE;
        };
    }

    // Accesseurs (ou getters)
    public function getType(): string
    {
        return $this->type;
    }

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

    public function move(): string
    {
        if ($this->getType() === self::ENV_AIR) {
            return 'voler';
        } else if ($this->getType() === self::ENV_EAU) {
            return 'nager';
        } else if ($this->getType() === self::ENV_TERRE) {
            return 'marcher';
        } else {
            return 'se déplacer';
        }
    }

    public function move2(): string
    {
        switch (true) {
            case $this->getType() === self::ENV_AIR:
                return 'voler';
                break;
            case $this->getType() === self::ENV_EAU:
                return 'nager';
                break;
            case $this->getType() === self::ENV_TERRE:
                return 'marcher';
                break;
            default:
                return 'se déplacer';
        }
    }

    public function move3(): string
    {
        // ternaire + nb instances
        return $this->getType() === self::ENV_AIR ?  'voler' : ($this->getType() === self::ENV_EAU ?  'nager' : ($this->getType() === self::ENV_TERRE ? 'marcher' : 'se déplacer'));
    }

    public static function countInstances(): int
    {
        return self::$nb;
    }
}
