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
        $pass  = "root";
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

    public function transactions_user($info) {
        try {
            $r = $this->bd->prepare("SELECT * FROM transactions where from_account=" . $info . " or to_account=" . $info );
            $r->execute();
            return $r->fetchall(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e) {
            die("error" . $e->getcode() . $e->getMessage());
        }
    }

    /* --------------------------------------------------- MEMBER ---------------------------------------------*/

    public function add_member($info) {
        try {
            $r = $this->bd->prepare("INSERT INTO user (name, email, password, admin) 
            VALUES ('" . $info['user'] . "','" . $info['email'] . "','" . $info['password'] . "', 0 )");
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
            return $r->fetch(PDO::FETCH_ASSOC);
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
        }
        catch(PDOException $e) {
            die("error" . $e->getcode() . $e->getMessage());
        }
    }

    /* --------------------------------------------------- ACCOUNT ---------------------------------------------*/

    public function show_balance() {
        try {
            $r = $this->bd->prepare('SELECT number, balance, currency.name, currency.value FROM account JOIN currency 
                                                WHERE account.currency=currency.id AND userId=' . $_SESSION['id_user']) ;
            $r->execute();
            return $r->fetchall(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e) {
            die("error" . $e->getcode() . $e->getMessage());
        }
    }

    public function create_account($currency) {
        try {
            $r = $this->bd->prepare('INSERT INTO account (number, userId, balance, currency) 
                                    VALUES (NULL,' . $_SESSION['id_user'] . ',' . 0 . ',' . $currency . ')');
            $r->execute();
        }
        catch (PDOException $e) {
            die("error" . $e->getCode() . $e->getMessage());
        }
    }

    public function currency_user() {
        try {
            $r = $this->bd->prepare("SELECT DISTINCT currency.name, currency.id FROM account JOIN currency 
                                                WHERE userId=" . $_SESSION['id_user'] . " AND account.currency=currency.id");
            $r->execute();
            return $r->fetchall(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e) {
            die("error" . $e->getCode() . $e->getMessage());
        }
    }

    public function account_user() {
        try {
            $r = $this->bd->prepare('SELECT number FROM account WHERE userId=' . $_SESSION['id_user']);
            $r->execute();
            return $r->fetchall(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e) {
            die("error" . $e->getCode() . $e->getMessage());
        }
    }

    public function create_transaction($data) {
        try {
            $r = $this->bd->prepare('INSERT INTO transactions (from_account, to_account, amount, currency) VALUES 
                                   ('. $data['from'] . ',' . $data['to_account'] . ',' . $data['amount'] . ',' . $data['currency'] . ')');
            $r->execute();
        }
        catch (PDOException $e) {
            die("error" . $e->getCode() . $e->getMessage());
        }
    }

    public function currency() {
        try {
            $r = $this->bd->prepare('SELECT * FROM currency');
            $r->execute();
            return $r->fetchall(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e) {
            die("error" . $e->getCode() . $e->getMessage());
        }
    }

    /* --------------------------------------------------- ADMIN ----------------------------------------------*/

    public function all_account() {
        try {
            $r = $this->bd->prepare("SELECT COUNT(*) as accounts FROM account ");
            $r->execute();
            return $r->fetch(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e) {
            die("error" . $e->getcode() . $e->getMessage());
        }
    }

    public function all_transactions() {
        try {
            $r = $this->bd->prepare("SELECT COUNT(*) as transactions FROM transactions ");
            $r->execute();
            return $r->fetch(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e) {
            die("error" . $e->getcode() . $e->getMessage());
        }
    }

    public function all_users() {
        try {
            $r = $this->bd->prepare("SELECT COUNT(*) as users FROM user WHERE admin=0");
            $r->execute();
            return $r->fetch(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e) {
            die("error" . $e->getcode() . $e->getMessage());
        }
    }

    public function all_money() {
        try {
            $r = $this->bd->prepare("SELECT SUM(balance) as money FROM account");
            $r->execute();
            return $r->fetch(PDO::FETCH_ASSOC);
        }
        catch(PDOException $e) {
            die("error" . $e->getcode() . $e->getMessage());
        }
    }

    public function update_currency() {
        date_default_timezone_set("Europe/Stockholm");
        $XML=simplexml_load_file("http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml");
        //the file is updated at around 16:00 CET

        foreach($XML->Cube->Cube->Cube as $rate){
            try {
                $r = $this->bd->prepare("SELECT TST FROM currency 
                                                    WHERE name='" . $rate["currency"] . "'");
                $r->execute();
                $result = $r->fetch(PDO::FETCH_ASSOC);
                $datetime = date('Y-m-d H:i:s', time());
                $diff = time()-strtotime($result["TST"]);
                if (count($result)==0){
                    $r = $this->bd->prepare("INSERT INTO currency (name, value, TST) VALUES ('" . $rate["currency"] . "'," . 1/$rate["rate"] . ",'" . $datetime . "')");
                    $r->execute();
                }
                elseif (floor($diff/86400) > 0) {
                    $r = $this->bd->prepare("UPDATE currency SET value=" . 1/$rate["rate"] . ", TST='" . $datetime . "' WHERE name='" . $rate["currency"] . "'");
                    $r->execute();
                }
            }
            catch(PDOException $e) {
                die("error" . $e->getcode() . $e->getMessage());
            }
        }
    }
}