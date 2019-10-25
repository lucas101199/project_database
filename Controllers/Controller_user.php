<?php
class Controller_user extends Controller{

    public function action_default() {
        $this->action_home_page();
    }

    //creating the new account
    public function action_account() {
        $m = Model::get_model();
        $data = $m->currency();
        print_r($data);
        $this->render("account", $data);
    }

    // making a transaction
    public function action_transaction() {
        $m = Model::get_model();
        $data = $m->currency_user();
        $data1 = $m->account_user();
        $final = array_merge($data, $data1);
        $this->render("transaction", $final);
    }

    //account of the actual user
    public function action_balance() {
        $m = Model::get_model();
        $data = $m->show_balance();
        $m->update_currency();
        //print_r($data);
        $this->render("user", $data);
    }

    //Create a new account
    public function action_create_account() {
        $m = Model::get_model();
        $currency = $_POST['currency'];
        $m->create_account($currency);
        $this->render("redirect");
    }

    //Create new transaction
    public function action_create_transaction() {
        $m = Model::get_model();
        $m->create_transaction($_POST);
        $this->render("redirect");
    }
}
