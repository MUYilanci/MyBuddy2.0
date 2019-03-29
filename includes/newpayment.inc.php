<?php
include 'php/dbh.php';

$query = $conn->prepare("SELECT * FROM `user_group` ug LEFT JOIN `user` u ON ug.user_id = u.user_id WHERE ug.group_id = :group_id;");
$query->execute(array(
    ':group_id' => $_SESSION['group_id']
));

$f = 0;
if (!isset($_SESSION['login'])) {
    header('Location:index.php');
} else { ?>
    <div class="container">
        <div class="jumbotron myBackground">
            <form action="php/newpayment.php" method="post" onkeypress="return event.keyCode != 13;">
                <div class="form-group">
                    <label for="name">Payment Name</label>
                    <input class="form-control col-3" name="description" placeholder="Payment Name">
                </div>
                <div class="form-group">
                    <label for="name">Payment amount</label>
                    <input type="number" id="price" class="form-control col-3" name="amount" placeholder="Payment Amount">
                </div>
                <div class="deelnemersbetaling">
                    <hr>
                    <?php while ($data = $query->fetch()): ?>
                        <fieldset id="checkArray">
                            <div class="row index_<?= $f ?>">
                                <div class="col-5 mb-2">
                                    <input type="hidden" name="userid_<?= $f ?>" value="<?= $data['user_id'] ?>"/>
                                    <input id="user_<?= $data['user_id'] ?>" type="checkbox" name="user_<?= $f ?>"> <?= $data['name'] ?> <?= $data['surname'] ?> :</input>
                                </div>
                                <div class="col-3 mb-2">
                                    <input type="number" id="percentage_<?= $data['user_id'] ?>" class="form-control" style="width: 100%;" type="text" name="percentage_<?= $f ?>" value="1">
                                </div>
                                <div class="col-3 mb-2">
                                    <input id="price_<?= $data['user_id'] ?>" class="form-control" style="width: 100%;" type="text" name="price_<?= $f ?>" readonly>
                                    <br>
                                </div>
                            </div>
                        </fieldset>
                        <?php $f++; endwhile; ?>
                    <div class="row mt-2">
                        <div class="offset-5 col-3 text-right">
                            <p>Totaal: €</p>
                        </div>
                        <div class="col-3">
                            <input class="form-control" id="total" style="width: 100%;" type="text" name="total" disabled>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary bottom" name="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php } ?>



