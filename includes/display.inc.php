<?php

include 'php/dbh.php';

if (!isset($_SESSION['login'])) {
    header('Location:index.php');
}

if (isset($_GET['id'])) {
    $_SESSION['group_id'] = intval($_GET['id']);
} else {
    header('Location:index.php');
}
$group_id  = $_SESSION['group_id'];
$query = $conn->prepare('SELECT * FROM `group` WHERE `group_id` = :group_id');
$query->execute(array(':group_id' => $_SESSION['group_id']));
$groupResults = $query->fetch(PDO::FETCH_ASSOC);
$st1 = $conn->prepare('SELECT * FROM `payment`');
$st1->execute(); ?>
<div class="container">
    <div class="jumbotron myBackground">
        <div class="card card-right">
            <div class="card-body">
                <h5 class="card-text"><?= $groupResults["groupname"] ?></h5>
            </div>
        </div>
        <br>
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active show" href="#payment" role="tab" data-toggle="tab">Payments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#users" role="tab" data-toggle="tab">Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#explore" role="tab" data-toggle="tab">Balance</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active show" id="payment">
                <br><?php include 'tab_table_expense.inc.php'; ?>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="users">
                <br><?php include 'tab_table_explore.inc.php'; ?>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="explore">
                <br><?php include 'tab_table_balance.inc.php'; ?>
            </div>
        </div>
    </div>
</div>
