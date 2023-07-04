<?php
session_start();

class UserController {
    protected $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $profile_image = $_POST['profile_image'];
            
            $result = $this->model->register($username, $email, $password, $profile_image);
            
            if ($result) {
                header("Location: /login.php");
            } else {
                require 'app/views/register.php';
            }
        } else {
            require 'app/views/register.php';
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->model->getUser($username);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                header("Location: /profile.php");
            } else {
                require 'app/views/login.php';
            }
        } else {
            require 'app/views/login.php';
        }
    }

    public function profile() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $profile_image = $_POST['profile_image'];

            $result = $this->model->updateUser($username, $email, $profile_image, $_SESSION['user']['id']);
            
            if ($result) {
                $_SESSION['user'] = $this->model->getUser($username);
                require 'app/views/profile.php';
            } else {
                require 'app/views/error.php';
            }
        } else {
            require 'app/views/profile.php';
        }
    }

    public function logout() {
        session_unset();
        session_destroy();

        header("Location: /login.php");
    }
}
?>
