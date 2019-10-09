<?php

class Model{

    private $bd;

    private static $instance = null;

    /**
     * Constructor creating the PDO object and affect this to $bd
     */
    private function __construct() {
        $dsn   = "mysql:host=localhost;dbname=project";
        $login = "root";
        $pass   = 'root';
        try {
            $this->bd = new PDO($dsn,$login,$pass);
            $this->bd->query("SET NAMES 'utf8'");
            $this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e) {
            die("error" . $e->getcode() . $e->getMessage());
        }

    }

    public static function get_model() {
        if(is_null(self::$instance))
            self::$instance = new Model();
        return self::$instance;

    }

    /* --------------------------------------------------- PRINT TRANSACTIONS ---------------------------------*/

    public function get_all() {
        $r = $this->bd->prepare('SELECT * FROM content');
        $r->execute();
        return $r->fetchall(PDO::FETCH_ASSOC);
    }

    /* --------------------------------------------------- MEMBER ---------------------------------*/

    public function add_member($info) {
        try {
            $r = $this->bd->prepare("INSERT INTO user (name, email, password) VALUES ('" . $info['user'] ."','" . $info['email'] . "','" . $info['password'] . "')");
            $r->execute();
        }
        catch(PDOException $e) {
            die("error" . $e->getcode() . $e->getMessage());
        }
    }

    public function check_user($data) {
        try {
            $r = $this->bd->prepare("SELECT * FROM user WHERE name= '" . $data['user'] . "' and password= '" . $data['password'] . "'");
            $r->execute();
            print_r($r);
            return $r->fetch(PDO::FETCH_ASSOC);
            //$count = $r->rowCount();
            //print_r($count);
            //return $count;
        }
        catch(PDOException $e) {
            die("error" . $e->getcode() . $e->getMessage());
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
            die("error" . $e->getcode() . $e->getMessage());
        }
    }
}