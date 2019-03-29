<?php
include 'php/dbh.php';

if (isset($_GET['id'])) {
    $_SESSION['insertgroup_id'] = intval($_GET['id']);
}

$query = $conn->prepare('SELECT * FROM `group` WHERE `group_id` = :group_id');
$query->execute(array(':group_id' =>  $_SESSION['insertgroup_id']));
$groupResults = $query->fetch(PDO::FETCH_ASSOC);

if (!isset($_SESSION['login'])) {
header('Location:index.php?page=home');
} else { ?>
<div class="container">
    <div class="jumbotron myBackground">
        <div class="card card-right">
            <div class="card-body">
                <h5 class="card-text"><?= $groupResults['name']?></h5>
            </div>
        </div>
        <form class="needs-validation" novalidate method="post" action="php/addusers.php">
            <?php for ($int = 0; $int <= 9; $int++) { ?>
                <div class="form-group">
                    <input class="form-control col-3" name="user_id[]" placeholder="Nickname">
                </div>
            <?php } ?>
            <button class="btn btn-primary" name="submit" type="submit">Add Users</button>
        </form>
    </div>
</div>
<?php } ?>