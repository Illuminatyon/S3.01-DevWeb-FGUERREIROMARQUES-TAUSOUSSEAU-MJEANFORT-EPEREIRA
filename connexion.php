<?php
class Connexion {
    private static $bdd;

    public static function initBdd() {
        try {
                        $host = 'mysql:host=127.0.0.1;dbname=alacool;charset=utf8';
                        $user = 'root';
                        $password = '';

//            $host = 'mysql:host=***SUPPRIME***;dbname=***SUPPRIME***;charset=utf8';
//            $user = '***SUPPRIME***';
//            $password = '***MOT-DE-PASSE-SUPPRIME***';

            self::$bdd = new PDO($host, $user, $password);
            self::$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            die("Erreur : " . $e->getMessage() . "<br>");
        }
    }

    public static function getBdd() {
        if (self::$bdd === null) {
            self::initBdd();
        }
        return self::$bdd;
    }
}
?>