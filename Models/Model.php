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
        $pass  = 'root';
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


    /* --------------------------------------------------- MEMBER ---------------------------------------------*/

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

    /* --------------------------------------------------- ACCOUNT ---------------------------------------------*/

    public function show_balance() {
        try {
            $r = $this->bd->prepare('SELECT number, balance, currency.name FROM account JOIN currency WHERE userId=' . $_SESSION['id_user']);
            $r->execute();
            return $r->fetchall(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e) {
            die("error" . $e->getcode() . $e->getMessage());
        }
    }

    public function create_account($balance, $currency) {
        try {
            $r = $this->bd->prepare('INSERT INTO account (number, userId, balance, currency) VALUES (NULL,' . $_SESSION['id_user'] . ',' . $balance . ',' . $currency . ')');
            print_r($r);
            $r->execute();
        }
        catch (PDOException $e) {
            die("error" . $e->getCode() . $e->getMessage());
        }
    }
}