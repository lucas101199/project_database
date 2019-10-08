<?php

class Model{

    private $bd;

    private static $instance = null;

    /**
     * Constructeur créant l'objet PDO et l'affectant à $bd
     */
    private function __construct() {
        $dsn   = "mysql:host=localhost;dbname=onconception";
        $login = "root";
        $mdp   = 'root';
        try {
            $this->bd = new PDO($dsn,$login,$mdp);
            $this->bd->query("SET NAMES 'utf8'");
            $this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e) {
            die("erreur" . $e->getcode() . $e->getMessage());
        }

    }

    public static function get_model() {
        if(is_null(self::$instance))
            self::$instance = new Model();
        return self::$instance;

    }

    /* --------------------------------------------------- PRINT PRODUCT ---------------------------------*/

    public function get_all() {
        $r = $this->bd->prepare('SELECT * FROM content');
        $r->execute();
        return $r->fetchall(PDO::FETCH_ASSOC);
    }

    /* --------------------------------------------------- MEMBER ---------------------------------*/

    public function add_content($info1, $info) {
        try {
            $r = $this->bd->prepare("INSERT INTO content (name, type) VALUES ('" . $info1 ."','" . $info['type'] . "')");
            $r->execute();
        }
        catch(PDOException $e) {
            die("erreur" . $e->getcode() . $e->getMessage());
        }
    }

    public function update_number($num) {
        try {
            $r = $this->bd->prepare('UPDATE numbe SET videos=' . $num['vid'] . ', vues=' . $num['vues'] . ', km=' . $num['km'] .', tera=' . $num['tera'] . ', cafe=' . $num['cafe']);
            $r->execute();
        }
        catch(PDOException $e) {
            die("erreur" . $e->getcode() . $e->getMessage());
        }
    }

    public function check_user($data) {
        try {
            $r = $this->bd->prepare("SELECT * FROM dmin WHERE name= '" . $data['user'] . "' and password= '" . $data['password'] . "'");
            $r->execute();
            print_r($r);
            return $r->fetch(PDO::FETCH_ASSOC);
            //$count = $r->rowCount();
            //print_r($count);
            //return $count;
        }
        catch(PDOException $e) {
            die("erreur" . $e->getcode() . $e->getMessage());
        }
    }

    public function exist_user($user) {
        try {
            $r = $this->bd->prepare("SELECT * FROM User WHERE name= '" . $user . "'");
            $r->execute();
            return $r->fetch(PDO::FETCH_ASSOC);
            //$count = $r->rowCount();
            //print_r($count);
            //return $count;
        }
        catch(PDOException $e) {
            die("erreur" . $e->getcode() . $e->getMessage());
        }
    }

    public function print_number() {
        $r = $this->bd->prepare('SELECT * FROM numbe');
        $r->execute();
        return $r->fetch(PDO::FETCH_NUM);
    }

}
?>