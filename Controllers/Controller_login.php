<?php
class Controller_sign extends Controller{

    public function action_default() {
        $this->action_home_page();
    }

    //print the form for log into the website
    public function action_login_form() {
        $this->render("home");
    }

    //print the form for create a new user
    public function action_sign_up_form() {
        $this->render("sign_up");
    }

    //check if the user is already register
    public function action_check_user() {
        $m = Model::get_model();
        $data = $m->check_user($_POST);
        if (! empty($data)) {

            $_SESSION['username'] = $_POST['user'];
            $_SESSION['id_user'] = $data['id'];
            print_r($_SESSION);
            $this->render("home");
        }

        else {
            echo'wrong username or password';
            $this->render("home");
        }
    }

    //create a new user
    public function action_add_member() {
        $m = Model::get_model();
        $data = $m->exist_user($_POST["user"]);

        if (! empty($data)) {
            print_r("this username already exist");
            $this->render("sing_up");
        }

        if (isset($_POST["email"]) and isset($_POST["user"]) and isset($_POST["password"])) {
            $m->add_member($_POST);
            $this->render("home");
        }
    }

    //destroy the session when someone log out
    public function action_destroy() {
        session_destroy();
        unset($_SESSION);
        print_r('destroy session');
        $this->render('home');
    }
}
