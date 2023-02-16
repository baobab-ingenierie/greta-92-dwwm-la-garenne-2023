<?php
// Inclusions
require_once 'class/singleton.class.php';
require_once 'class/model.class.php';
require_once 'constants.php';

// Singleton

// Test 1 : connexion
Singleton::setConfiguration(HOST, PORT, DB, USER1, PASS1);
$conn = Singleton::getPDO();
var_dump($conn);

// Test 1bis : déconnexion
Singleton::disconnect();

// Model

// Test 2 : instanciation
$table1 = new Model(HOST, PORT, DB, USER2, PASS2, 'owner');

// Test 3 : getRows
var_dump($table1->getRows());

// Test 4 : getRow
var_dump($table1->getRow('id_own', 3));

// Test 5 : delete
echo 'Nb lignes supprimées : ' . $table1->delete('id_own', 100);
