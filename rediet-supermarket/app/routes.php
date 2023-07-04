<?php
// routes.php

function call($controller, $action) {
    require_once('app/controllers/' . $controller . 'Controller.php');

    switch($controller) {
        case 'user':
            require_once('app/models/UserModel.php');
            $controller = new UserController(new UserModel());
        break;
        // other controllers here
    }

    $controller->{$action}();
}

// Define your routes here
$controllers = array(
    'user' => ['index', 'register', 'login', 'logout', 'profile'],
    // other controllers here
);

if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
        call($controller, $action);
    } else {
        call('pages', 'error');
    }
} else {
    call('pages', 'error');
}
?>
