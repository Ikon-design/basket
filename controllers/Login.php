<?php
class Login extends Controller {
    public function index(){
        $this->loadModel(Logins);
        if (isset($_POST['password'])){
            if ($_POST['password'] == ''){
                $_SESSION['loged'] = true;
                header('location: /sweat/read');
            }
        }
        $this->render('index');
    }
}