<?php
class Connexion {
    private static $bdd;

    /**
     * Les paramètres de connexion ne sont plus écrits dans le code.
     * Ils se règlent avec des variables d'environnement (voir le README) ;
     * à défaut, on utilise une base MySQL locale (XAMPP / WAMP / Laragon).
     */
    public static function initBdd() {
        try {
            $hote     = getenv('DB_HOST') ?: '127.0.0.1';
            $port     = getenv('DB_PORT') ?: '3306';
            $dbname   = getenv('DB_NAME') ?: 'alacool';
            $user     = getenv('DB_USER') ?: 'root';
            $password = getenv('DB_PASS') !== false ? getenv('DB_PASS') : '';

            $dsn = "mysql:host=$hote;port=$port;dbname=$dbname;charset=utf8";

            self::$bdd = new PDO($dsn, $user, $password);
            self::$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            // Ne pas afficher le message d'erreur brut : il peut contenir l'hôte ou l'utilisateur.
            error_log("Connexion BDD impossible : " . $e->getMessage());
            die("Erreur : connexion à la base de données impossible.");
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
