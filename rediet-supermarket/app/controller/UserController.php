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
                require 'register.php';
            }
        } else {
            require 'register.php';
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
                require 'login.php';
            }
        } else {
            require 'login.php';
        }
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $profile_image = $_POST['profile_image'];
            $id = $_SESSION['user']['id'];

            $result = $this->model->updateUser($username, $email, $profile_image, $id);

            if ($result) {
                $_SESSION['user'] = $this->model->getUser($username);
                header("Location: /profile.php");
            } else {
                require 'update.php';
            }
        } else {
            require 'update.php';
        }
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_SESSION['user']['id'];

            $result = $this->model->deleteUser($id);

            if ($result) {
                session_unset();
                session_destroy();
                header("Location: /register.php");
            } else {
                require 'delete.php';
            }
        } else {
            require 'delete.php';
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        header("Location: /login.php");
    }
}
?>
