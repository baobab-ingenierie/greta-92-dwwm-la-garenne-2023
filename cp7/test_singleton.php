<?php
// Inclusions
require_once 'class/singleton.class.php';
require_once 'constants.php';

// Test 1 : connexion
Singleton::setConfiguration(HOST, PORT, DB, USER1, PASS1);
$conn = Singleton::getPDO();
var_dump($conn);
