<?php
// Inclusion de la classe
require_once 'class/animal.class.php';

// Test 1 : instanciation
$animal1 = new Animal();
$animal2 = new Animal();
var_dump($animal1);
var_dump($animal2);

// Test 2 : assignation valeur à attribut
// $animal1->name = 'Milou';
// $animal1->female = false;
// $animal2->name = 'Bill';
var_dump($animal1);
var_dump($animal2);

// Test 3 : encapsulation
$animal3 = new Animal();
$animal3->setName('Rantanplan');
$animal3->setDob('1987-01-06');
// $animal3->setDob('avant-hier');
$animal3->setWeight(6.3);
// $animal3->setWeight('trop lourd');
$animal3->setFemale(false);
// $animal3->setFemale('cheval');
echo 'Mon chien s\'appelle ' . $animal3->getName();
var_dump($animal3);

// Test 4 : constructeur
$animal4 = new Animal('Titi', .15, false);
$animal4->setDob('1954-01-11');
var_dump($animal4);

// Test 5 : méthode EAT
$animal5 = new Animal('Sly', 5, false);
var_dump($animal5);
$animal5->eat($animal4);
var_dump($animal4);
var_dump($animal5);

// Test 6  : méthode GETAGE
echo $animal4->getName() . ' est agé de ' . $animal4->getAge() . ' ans.';
