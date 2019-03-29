<?php
session_start();
include 'dbh.php';
$f = 0;
if ($_POST['email'] == "") {
    $_SESSION['error'] = "No Value Given";
    header("Location: ../?page=adduser");
}
else{
    $email = $_POST['email'];

    $query = $conn->prepare("SELECT user_id FROM `user` WHERE email = :email");
    $query->execute(array(
        ':email' => $email
    ));

    if ($query->rowCount() == 1){
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $query1 = $conn->prepare("SELECT * FROM `user_group` WHERE group_id = :group_id AND user_id = :userid");
        $query1->execute(array(
            ':group_id' => $_SESSION['group_id'],
            ':userid' => $result['user_id']
        ));

        if ($query1->rowCount() == 0){
            $query3 = $conn->prepare("INSERT INTO `user_group` (user_id, group_id) VALUES (:user_id, :group_id)");
            $query3->execute(array(
                ':user_id' => $result['user_id'],
                ':group_id' => $_SESSION['group_id']
            ));
            $_SESSION['error'] = "User already in group";
            header("Location: ../?page=display&id=".$_SESSION['group_id']);
        }
        else{
            $_SESSION['error'] = "User already in group";
            header("Location: ../?page=adduser");
        }
        $f++;
    }
    else {
        $_SESSION['error'] = "Email Not Found";
        header("Location: ../?page=adduser");
    }
}
