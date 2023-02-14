<?php

/**
 * Mini framework en PHP orienté objet destiné à se
 * connecter à une base de données MySQL/MariaDB.
 */

class Singleton
{
    // Attributs privés
    private static string $host = '';
    private static int $port = 0;
    private static string $dbname = '';
    private static string $user = '';
    private static string $password = '';
    private static array $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );

    /**
     * Constructeur laissé vide volontairement !
     * On ne veut pas créer plus d'une instance de cette classe.
     */
    public function __construct()
    {
    }

    /**
     * Permet de passer les paramètres de connexion à la classe
     * en cours : Singleton !
     * 
     * @param string $newHost - nom ou adresse IP du serveur de BDD
     * @param int $newPort - port d'écoute du serveur de BDD
     * @param string $newDbname - nom de la BDD
     * @param string $newUser - nom de l'utilisateur pour connexion
     * @param string $newPassword - mot de passe de connexion
     * @param array $newOptions - options de connexion
     */
    public static function setConfiguration(string $newHost, int $newPort, string $newDbname, string $newUser, string $newPassword, ?array $newOptions = array())
    {
        self::$host = $newHost;
        self::$port = $newPort;
        self::$dbname = $newDbname;
        self::$user = $newUser;
        self::$password = $newPassword;
        self::$options += $newOptions;
    }

    /**
     * Valide si une configuration est définie ou non
     * @return bool - true si on a une config, false sinon
     * 
     */

    public static function hasConfiguration(): bool
    {
        // true si host et dbname pas vide et port <> 0
    }
}
