<?php

/**
 * Classe fille qui hérite du Singleton et qui permet
 * de réaliser un CRUD sur une table de la BDD en cours
 */

// Inclusions
require_once 'singleton.class.php';

class Model extends Singleton
{
    // Attributs privés
    private $db = null;
    private $table = '';

    /**
     * Constructeur de la classe 
     * @param string $table nom de la table à manipuler
     */
    public function __construct(string $newHost, int $newPort, string $newDbname, string $newUser, string $newPassword, string $newTable, ?array $newOptions = array())
    {
        parent::setConfiguration($newHost, $newPort, $newDbname, $newUser, $newPassword, $newOptions);
        $this->db = parent::getPDO();
        $this->table = $newTable;
    }

    /**
     * Renvoie toutes les lignes de la table suite à une requête
     * SELECT sous la forme d'un tableau associatif
     * @return array résultat de la requête SELECT
     */
    public function getRows(): array
    {
        try {
            // Construit la requête SQL et renvoie les lignes
            $qry = $this->db->query('SELECT * FROM ' . $this->table);
            return $qry->fetchAll();
        } catch (PDOException $err) {
            throw new Exception($err->getMessage());
        }
    }

    /**
     * Renvoie une seule ligne de la table suite à une requête
     * SELECT sous la forme d'un tableau associatif
     * @param string $id - nom de la colonne clé primaire
     * @param string|int $val - valeur associé à la colonne PK
     * @return array - résultat de la requête SELECT
     */
    public function getRow(string $id, $val): array
    {
        try {
            $qry = $this->db->prepare('SELECT * FROM ' . $this->table . ' WHERE ' . $id . ' = ?');
            $qry->execute(array($val));
            return $qry->fetch();
        } catch (PDOException $err) {
            throw new Exception($err->getMessage());
        }
    }

    /**
     * Supprime une seule ligne de la table en cours 
     * @param string $id - nom de la colonne clé primaire
     * @param string|int $val - valeur associé à la colonne PK
     * @return int - nombre de lignes concernées par la suppression
     */
    public function delete(string $id, $val): int
    {
        try {
            $sql = 'DELETE FROM ' . $this->table . ' WHERE ' . $id . ' = :id';
            $qry = $this->db->prepare($sql);
            $qry->execute(array(':id' => $val));
            return $qry->rowCount();
        } catch (PDOException $err) {
            throw new Exception($err->getMessage());
        }
    }
}
