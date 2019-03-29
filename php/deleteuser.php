<?php
session_start();
include 'dbh.php';
$user_id = $_POST['user_id'];

$query = $conn->prepare("DELETE FROM `user_group` WHERE user_id = :user_id AND group_id = :group_id");
$query->execute(array(
    'user_id' => $user_id,
    'group_id' => $_SESSION['group_id']
));

$_SESSION['error'] = "User already in group";
header("Location: ../?page=display&id=".$_SESSION['group_id']);