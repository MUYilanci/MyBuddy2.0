<?php
session_start();
include 'dbh.php';


foreach ($_POST['user_id'] as $key => $user) {
    if($user != null) {
        $query = $conn->prepare('SELECT user_id FROM `user` WHERE nickname = :nickname');
        $query->execute(array(
            ':nickname' => $user));
        $user_id = $query->fetch();


        $query1 = $conn->prepare('INSERT INTO user_group(user_id, group_id) VALUES (:user_id, :group_id)');
        $query1->execute(array(
            ':user_id' => $user_id['user_id'],
            ':group_id' => $_SESSION['insertgroup_id']
        ));
    }
}
header("Location: ../?page=home");
