<?php

require_once('core.php');
ini_set('display_errors', 1);
error_reporting(E_ALL);

if(isset($_POST['search'])){
    $searchEmployee = $_POST['search'];
    $users = model::load("users");
    $users->readDB('u.users_ID, u.name, u.firstname, u.pseudo, r.label, u.isActive', " CONCAT(u.pseudo, ' ', u.name, ' ', u.firstname,' ') LIKE '%".$searchEmployee."%'", 'roles r on r.roles_ID = u.roles_ID');

    foreach ($users->data as $k)
    {
        echo '<tr>';
        echo '<tr>';
        if($k->isActive == 1){
            echo '<td><span class="dot-success"></span></td>';
        }else{
            echo '<td><span class="dot-danger"></span></td>';
        }
        echo '<td hidden>'.$k->users_ID.'</td>';
        echo '<td>'.$k->name.'</td>';
        echo '<td>'.$k->firstname.'</td>';
        echo '<td>'.$k->pseudo.'</td>';
        echo '<td>'.$k->label.'</td>';
        echo '<td><button type="button" class="btn btn-warning btn-sm update" id="'.$k->users_ID.'">Modifier</button></td>';
        echo '<td><button type="button" class="btn btn-primary btn-sm" id="activation">Activer/desactiver</button></td>';
        echo '</tr>';
    }

}






