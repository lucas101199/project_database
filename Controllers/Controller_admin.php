<?php

class Controller_admin extends Controller {

    public function action_default() {
        $this->action_home_page();
    }

    public function action_all() {
        $m = Model::get_model();
        $data = $m->all_account();
        $data1 = $m->all_transactions();
        $data2 = $m->all_users();
        $data3 = $m->all_money();
        $final = array_merge($data, $data1, $data2, $data3);
        $this->render("admin", $final);
    }
}