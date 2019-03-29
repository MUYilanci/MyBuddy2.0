<?php

include 'php/dbh.php';

if (!isset($_SESSION['login'])) {
    header('Location:index.php');
}

if (isset($_GET['id'])) {
    $group_id = intval($_GET['id']);
} else {
    header('Location:index.php');
}

$query = $conn->prepare('SELECT * FROM `group` WHERE `group_id` = :group_id');
$query->execute(array(':group_id' => $group_id));
$groupResults = $query->fetch(PDO::FETCH_ASSOC);

$query = $conn->prepare('SELECT * FROM `user` WHERE `user_id` NOT IN (SELECT `user_id` FROM `user_group` WHERE `group_id` = :group_id)');
$query->execute(array(':group_id' => $groupResults['group_id']));

?>
<div class="container">
    <div class="jumbotron myBackground">
        <form action="php/debtor.php" method="post">
            <div class="form-group">
                <label for="name">Group Name</label>
                <input class="form-control" name="name" placeholder="<?= $groupResults['name'] ?>" value="<?= $groupResults['name'] ?>" disabled="disabled">
                <input name="id" type="hidden" value="<?= $groupResults['group_id'] ?>">
            </div>
            <div class="form-group">
                <label for="debtor">Debtor</label>
                <select class="form-control" name="debtor">
                    <?php while ($result = $query->fetch(PDO::FETCH_ASSOC)): ?>
                       <option value="<?= $result['user_id'] ?>"><?= $result['name'] ?> <?= $result['sirname'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="payments">Number of Payments</label>
                <input class="form-control" name="payments" placeholder="Number of Payments">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" name="submit">Add Debtor</button>
            </div>
        </form>
    </div>
</div>