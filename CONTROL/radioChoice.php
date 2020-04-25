<?php

require_once('core.php');
ini_set('display_errors', 1);
error_reporting(E_ALL);

$value = $_POST['value'];
$users = model::load("users");

// récupère value du radio et fait une requête en fonction du choix tous, actif, inactif
if ($value == 'option1') {

    $users->readDB('u.users_ID, u.name, u.firstname, u.pseudo, r.label, u.isActive, u.roles_ID', '', 'roles r on r.roles_ID = u.roles_ID');

    if(!empty($users->data)){
        $users->displayLoopResult($users);
    }else{
        echo '<tr><td colspan="7" style="text-align: center"><span><i class="fas fa-user-times"></i> PAS D\'UTILISATEUR</span></td></tr>';
    }


} elseif ($value == 'option2') {

    $users->readDB('u.users_ID, u.name, u.firstname, u.pseudo, r.label, u.isActive, u.roles_ID', 'u.isActive = 1', 'roles r on r.roles_ID = u.roles_ID');

    if(!empty($users->data)){
        $users->displayLoopResult($users);
    }else{
        echo '<tr><td colspan="7" style="text-align: center"><span><i class="fas fa-user-times"></i> PAS D\'UTILISATEUR ACTIF</span></td></tr>';
    }


} else {

    $users->readDB('u.users_ID, u.name, u.firstname, u.pseudo, r.label, u.isActive, u.roles_ID', 'u.isActive = 0', 'roles r on r.roles_ID = u.roles_ID');

    if(!empty($users->data)){
        $users->displayLoopResult($users);
    }else{
        echo '<tr><td colspan="7" style="text-align: center"><span><i class="fas fa-user-times"></i> PAS D\'UTILISATEUR INACTIF</span></td></tr>';
    }

}