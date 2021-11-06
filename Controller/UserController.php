<?php

if (isset($_GET)) {

    $model = new UserModel();
    $users = json_decode($model->getAll());

    foreach ($users as $user) {
        echo "ID: $user->id <br>";
    }
}
