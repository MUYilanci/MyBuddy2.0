<?php
include 'php/dbh.php';

$query = $conn->prepare('SELECT * FROM payment p INNER JOIN user_group ug ON p.user_group_id = ug.user_group_id INNER JOIN user u ON ug.user_id = u.user_id   WHERE ug.group_id = :groupid');
$query->execute(array(
    ':groupid' => $_SESSION['group_id']
));
?>
    <a href="?page=newpayment" class="btn btn-success float-right">New Payment</a>
    <br><br>

<?php while ($data = $query->fetch()):
    $query1 = $conn->prepare("
            SELECT * FROM `dept` d
            INNER JOIN user_group ug ON d.user_group_id = ug.user_group_id
            INNER JOIN user u ON ug.user_id = u.user_id    
            WHERE ug.group_id = :groupid AND d.payment_id = :paymentid");
    $query1->execute(array(
        ':groupid' => $_SESSION['group_id'],
        ':paymentid' => $data['payment_id']
    ));
    ?>
    <div id="accordion">
        <div class="card">
            <div class="card-header">
                <a class="card-link" data-toggle="collapse" href="#collapse<?= $data['payment_id'] ?>">
                    <?= $data['description'] . " - " . $data['name'] . " " . $data['surname'] ?><span
                            class="float-right text-success"><?= $data['amount'] ?></span>
                </a>
            </div>
            <?php while ($dept = $query1->fetch()): ?>
                <div id="collapse<?= $data['payment_id'] ?>" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                        <?= $dept['name'] ?> <?= $dept['surname'] ?><span class="float-right text-danger"><?= $dept['amount'] ?></span>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <br>
<?php endwhile; ?>