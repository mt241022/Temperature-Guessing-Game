<?php

class DB
{
    private $db;

    function __construct()
    {
        try {
            $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PW);
        } catch (PDOException $e) {
            echo "Verbindung fehlgeschlagen";
            die(); // beendet das Skript sofort
        }
    }

    function addUser($username, $passwordHash)
    {
        $stmt = $this->db->prepare('INSERT INTO sp_users (username, password) VALUES (:username, :password)');
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $passwordHash);
        $stmt->execute();
    }

    function userExists($username)
    {
        $stmt = $this->db->prepare('SELECT id FROM sp_users WHERE username = :username');
        $stmt->bindValue(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
    }

    function getByUsername($username)
    {
        $stmt = $this->db->prepare('SELECT * FROM sp_users WHERE username = :username');
        $stmt->bindValue(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function getRandomCity()
    {
        $stmt = $this->db->prepare('SELECT city_name, country_code FROM sp_cities ORDER BY RAND() LIMIT 1');
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function saveHighscore($userId, $newScore)
    {
        $stmt = $this->db->prepare('SELECT score FROM sp_highscores WHERE user_id = :id');
        $stmt->bindValue(':id', $userId);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            $insert = $this->db->prepare('INSERT INTO sp_highscores (user_id, score) VALUES (:id, :score)');
            $insert->bindValue(':id', $userId);
            $insert->bindValue(':score', $newScore);
            $insert->execute();
            return true;
        } elseif ($newScore > $row['score']) {
            $update = $this->db->prepare('UPDATE sp_highscores SET score = :score WHERE user_id = :id');
            $update->bindValue(':id', $userId);
            $update->bindValue(':score', $newScore);
            $update->execute();
            return true;
        } else {
            return false;
        }
    }

    function getHighscoreById($userId){
        $stmt = $this->db->prepare('SELECT score FROM sp_highscores WHERE user_id = :id');
        $stmt->bindValue(':id', $userId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function getTopTen(){
        $stmt = $this->db->prepare('SELECT u.username, h.score FROM sp_highscores h JOIN sp_users u ON h.user_id = u.id ORDER BY h.score DESC LIMIT 10');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}