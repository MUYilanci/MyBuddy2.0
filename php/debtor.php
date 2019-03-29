<?php
session_start();
include 'dbh.php';
if (isset($_POST['submit'])) {
    $groupId = $_POST['id'];
    $debtor = $_POST['debtor'];
    $payments = $_POST['payments'];
} else {
    header('Location: ./../index.php');
}

try {
    $query = $conn->prepare('INSERT INTO `user_group`(`user_id`, `group_id`, `number_of_payments`) VALUES (:user_id, :group_id, :number_of_payments)');
    $query->execute(array(
        ':user_id' => $debtor,
        ':group_id' => $groupId,
        ':number_of_payments' => $payments
    ));
    header('Location: ./../index.php?page=display&id=' . $groupId);
} catch (PDOException $e) {
    header('Location: ./../index.php?page=display&id=' . $groupId);
}