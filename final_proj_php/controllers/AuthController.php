<?php

namespace App\Controllers;

use App\Core\App;

class AuthController {

    public function login_form() {
        return view('login');
    }

    public function login()
    {
//        checks the user credentials at login

        $user = App::get('database')->getOneByField('users', $_POST);
        if(!$user) {
            return redirect('/login');
        }

        if($_POST['password'] != $user->password){
            return redirect('/login');
        }

        $_SESSION['user'] = $user;


        return redirect('http://localhost:8080/#/home');

    }


    public function register_form(){
        return view('register');
    }

    public function register()
    {

        if($_POST['password'] != $_POST['password_confirmation'] || !$_POST['password']) {
            return redirect('/register');
        }
        unset($_POST['password_confirmation']);
        $_POST['password'] = md5($_POST['password']);

        App::get('database')->insert('users', $_POST);

        dd('Replace this with rederict to protected area of your web app');
    }

    public function logout()
    {
        unset($_SESSION['user']);
        return redirect('http://localhost:8081/login');
    }
}