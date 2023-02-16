<?php
require_once 'constants.php';
require_once 'class/model.class.php';
$table = new Model(HOST, PORT, DB, USER2, PASS2, 'owner');
if ($table->insert($_POST) === 1) {
    var_dump($table->getRows());
} else {
    echo 'ERREUR !';
}
