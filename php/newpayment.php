<?php
session_start();
include 'dbh.php';
if (isset($_POST['submit'])) {
    $registerdescription = $_POST['description'];
    $amount = $_POST['amount'];
    $date = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d'), date('Y')));
} else {
    header('Location: ./../index.php');
}

try {
$query = $conn->prepare("SELECT user_group_id, group_id FROM `user_group` WHERE user_id = :userid AND group_id = :groupid");
$query->execute(array(
    ':userid' => intval($_SESSION['user_id']),
    ':groupid' => intval($_SESSION['group_id'])
));

$query2 = $conn->prepare("SELECT * FROM `user_group` WHERE group_id = :groupid");
$query2->execute(array(
    ':groupid' => intval($_SESSION['group_id'])
));

$resultgroup = $query2->fetchAll(PDO::FETCH_ASSOC);
$result = $query->fetch(PDO::FETCH_ASSOC);

$query1 = $conn->prepare('INSERT INTO `payment`(`user_group_id`, `amount`, `description`, `date`)
        VALUES (:usergroupid, :amount, :registerdescription, :datee)');
$query1->execute(array(
    ':usergroupid' => $result['user_group_id'],
    ':amount' => $amount,
    ':registerdescription' => $registerdescription,
    ':datee' => $date
));

$query4 = $conn->prepare('SELECT payment_id FROM `payment` WHERE `user_group_id` = :usergroupid AND `amount` = :amount AND description = :registerdescription');
$query4->execute(array(
    ':usergroupid' => $result['user_group_id'],
    ':amount' => $amount,
    ':registerdescription' => $registerdescription
));

$paymentidr = $query4->fetch();
$paymentid = $paymentidr['payment_id'];

for ($i = 0; $i < $query2->rowCount(); $i++) {
    $debt = $_POST['price_' . $i];
    $userid = $_POST['userid_' . $i];

    $query5 = $conn->prepare("SELECT * FROM user_group WHERE user_id = :userid AND group_id = :groupid");
    $query5->execute(array(
        ':userid' => $userid,
        ':groupid' => intval($_SESSION['group_id'])
    ));
    $usergroup = $query5->fetch();
    $query3 = $conn->prepare('INSERT INTO `dept` (payment_id, user_group_id, amount) VALUES (:paymentid, :usergroupid, :amount)');
    $query3->execute(array(
        ':paymentid' => $paymentid,
        ':usergroupid' => $usergroup['user_group_id'],
        ':amount' => $debt
    ));
}

    header('Location: ./../index.php?page=display&id=' . $_SESSION['group_id']);
} catch (PDOException $e) {
   header('Location: ./../index.php?page=newpayment');

}