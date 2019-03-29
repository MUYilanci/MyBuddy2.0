<?php
include 'php/dbh.php';

$query = $conn->prepare("SELECT * FROM `user_group` ug LEFT JOIN `user` u ON ug.user_id = u.user_id WHERE ug.group_id = :group_id;");
$query->execute(array(
    ':group_id' => $_SESSION['group_id']
));

?>
<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th>Name</th>
        <th>E-mail</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php while ($data = $query->fetch()): ?>
        <tr>
            <td><?= $data['name'] ?> <?= $data['surname'] ?></td>
            <td><?= $data['email'] ?></td>
            <td>
                <?php if ($data['user_id'] != $_SESSION['user_id']) { ?>
                    <form action='php/deleteuser.php' method='post'>
                        <input type="hidden" name="user_id" value="<?= $data['user_id'] ?>">
                        <button class="button1 delete" title="Delete" data-toggle="tooltip"><i
                                    class="material-icons">&#xE5C9;</i></button>
                    </form>
                <?php } ?>
            </td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>
<a href="index.php?page=adduser"><img src="images/miniadd.png" class="bottom" alt="Make Group"></a>