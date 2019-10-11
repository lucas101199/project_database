<?php
class Controller_user extends Controller{

    public function action_default() {
        $this->action_home_page();
    }

    //Page for creating the new account
    public function action_account() {
        $this->render("account");
    }

    //Page for making a transaction
    public function action_transaction() {
        $m = Model::get_model();
        $data = $m->currency_user();
        $data1 = $m->account_user();
        $final = array_merge($data, $data1);
        print_r($final);
        $this->render("transaction", $final);
    }

    //show all the account of the actual user
    public function action_balance() {
        $m = Model::get_model();
        $data = $m->show_balance();
        print_r($data);
        $this->render("user", $data);
    }

    //Create a new account
    public function action_create_account() {
        $m = Model::get_model();
        $currency = $_POST['currency'];
        print_r($_POST);
        $m->create_account($currency);
        $this->render("redirect");
    }

    //Create new transaction
    public function action_create_transaction() {
        $m = Model::get_model();
        print_r($_POST);
        $m->create_transaction($_POST);
        $this->render("redirect");
    }
}
