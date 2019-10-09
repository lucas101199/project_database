<?php
class Controller_home extends Controller{

    public function action_default() {
        $this->action_home_page();
    }

    public function action_home_page() {
        $this->render("home");
    }
}
