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

    /**
     * Insère une seule ligne dans la table en cours
     * @param array $post - tableau clés/valeurs de type $_POST
     * @return int - nombre de lignes concernées par l'insertion
     */
    public function insert(array $post = array()): int
    {
        if (empty($post)) {
            throw new Exception(__CLASS__ . ' : Le tableau ne doit pas être vide.');
        } else {
            // Remplit 3 tableaux : colonnes, valeurs et paramètres SQL
            foreach ($post as $key => $val) {
                $cols[] = $key;
                $vals[] = $val;
                $params[] = '?';
            }
            // Ecrit la requête SQL
            $sql = 'INSERT INTO ' . $this->table . '(' . implode(',', $cols) . ') ';
            $sql .= 'VALUES(' . implode(',', $params) . ')';
            try {
                $qry = $this->db->prepare($sql);
                $qry->execute($vals);
                return $qry->rowCount();
            } catch (PDOException $err) {
                throw new Exception($err->getMessage());
            }
        }
    }

    /**
     * Insère une seule ligne dans la table en cours
     * @param array $post - tableau clés/valeurs de type $_POST
     * @return int - nombre de lignes concernées par l'insertion
     */
    public function insert2(array $post = array()): int
    {
        if (empty($post)) {
            throw new Exception(__CLASS__ . ' : Le tableau ne doit pas être vide.');
        } else {
            // Ecrit la requête SQL
            try {
                $qry = $this->db->prepare('INSERT INTO ' . $this->table . '(' . implode(',', array_keys($post)) . ') VALUES(' . implode(',', array_fill(0, count($post), '?')) . ')');
                $qry->execute(array_values($post));
                return $qry->rowCount();
            } catch (PDOException $err) {
                throw new Exception($err->getMessage());
            }
        }
    }

    /**
     * Met à jour une seule ligne dans la table en cours
     * @param array $post - tableau clés/valeurs de type $_POST
     * @param string $id - nom de la colonne clé primaire
     * @param string|int $val - valeur associé à la colonne PK
     * @return int - nombre de lignes concernées par la mise à jour
     */
    public function update(array $post = array(), string $id, $valId): int
    {
        if (empty($post)) {
            throw new Exception(__CLASS__ . ' : Le tableau ne doit pas être vide.');
        } else {
            // Construit les tableaux pour générer le code SQL
            foreach ($post as $key => $val) {
                $cols[] = $key . ' = ?';
                $vals[] = $val;
            }
            $vals[] = $valId;
            $sql = 'UPDATE ' . $this->table . ' SET ';
            $sql .= implode(',', $cols);
            $sql .= ' WHERE ' . $id . ' = ?';
            // Prépare et exécute la requête
            try {
                $qry = $this->db->prepare($sql);
                $qry->execute($vals);
                return $qry->rowCount();
            } catch (PDOException $err) {
                throw new Exception($err->getMessage());
            }
        }
    }
}
