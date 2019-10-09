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
        $this->render("transaction");
    }

    public function action_balance() {
        $m = Model::get_model();
        $data = $m->show_balance();
        print_r($data);
        $this->render("user", $data);
    }
}
