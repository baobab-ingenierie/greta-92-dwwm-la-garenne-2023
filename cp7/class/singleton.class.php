<?php

/**
 * Mini framework en PHP orienté objet destiné à se
 * connecter à une base de données MySQL/MariaDB.
 */

class Singleton
{
    // Attributs privés
    private static $host = '';
    private static $port = 0;
    private static $dbname = '';
    private static $user = '';
    private static $password = '';
    private static $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );
    private static $cnn = null;

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
        if (self::$host === '' || self::$port === 0 || self::$dbname === '') {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Renvoie un objet PDO de type connexion à la BDD
     * @author Lesly LODIN
     * @version 1.0.0
     * @return PDO - connexion à la BDD
     */
    public static function getPDO(): PDO
    {
        // Si une connexion n'existe pas, alors on la crée
        if (!self::$cnn) {
            // Sinon, on la génère
            if (!self::hasConfiguration()) {
                // Si aucune configuration n'existe
                throw new Exception(__CLASS__ . ' : Vous devez d\'abord définir une configuration (host, port, dbname).');
            } else {
                // Sinon, on crée une nouvelle connexion
                try {
                    $dsn = 'mysql:host=' . self::$host . ';port=' . self::$port . ';dbname=' . self::$dbname . ';charset=utf8';
                    self::$cnn = new PDO($dsn, self::$user, self::$password, self::$options);
                } catch (PDOException $err) {
                    throw new Exception($err->getMessage());
                }
            }
        }
        return self::$cnn;
    }

    /**
     * Destructeur de la classe
     */
    public function __destruct()
    {
        if (self::$cnn) self::$cnn = null;
    }

    /**
     * Interdit le clonage de la classe : une seule connexion
     */
    public function __clone()
    {
        throw new Exception(__CLASS__ . ' : Clonage de cette classe interdit.');
    }
}
