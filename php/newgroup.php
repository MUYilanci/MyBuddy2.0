<?php
session_start();
include 'dbh.php';
if (isset($_POST['submit'])) {
    $registername = $_POST['name'];
    $registerdescription = $_POST['description'];
    $admin = 1;

        $query = $conn->prepare('INSERT INTO `group`(`groupname`) VALUES (:registername)');
        $query->execute(array(
            ':registername' => $registername
        ));

        $query1 = $conn->prepare("SELECT group_id FROM `group` WHERE `groupname`=:name");
        $query1->execute(array(
            ':name' => $registername
        ));

        $group_id = $query1->fetch();

        $query2 = $conn->prepare("INSERT INTO user_group (`user_id`, `group_id`) VALUES (:userid, :groupid)");
        $query2->execute(array(
            ':userid' => $_SESSION['user_id'],
            'groupid' => $group_id['group_id']
        ));

        header('Location: ./../index.php?page=home');
} else {
    header('Location: ./../index.php');
}



