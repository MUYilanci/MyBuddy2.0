<?php
include 'php/dbh.php';
if (!isset($_SESSION['login'])) { ?>
    <div class="container">
        <div class="jumbotron myBackground">
            <h1 class="whitney">Welkom</h1>
            <h3 class="gotham">Log in om verder te gaan</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur tempor felis ut rhoncus placerat.
                Maecenas sit amet dui condimentum, vulputate tortor in, ultrices orci.
                Pellentesque erat odio, egestas at mattis nec, sagittis eget dui. Morbi sit amet placerat arcu. Etiam
                ornare diam at lacus viverra, ut tempus leo luctus.
                Nullam ut arcu vitae metus porta aliquam eu at eros. Nullam ante erat, condimentum non fermentum sit
                amet, convallis vitae nulla. Maecenas iaculis leo sed diam laoreet aliquet.
                Vestibulum tincidunt metus id elit vehicula, at mattis risus hendrerit. Cras facilisis bibendum diam,
                vitae dictum ex mattis mollis.
                Praesent suscipit, est facilisis gravida sodales, justo neque ornare nisl, quis imperdiet dolor ipsum
                non urna. Nam egestas a erat ac tincidunt.
                Nullam dapibus mauris non mattis tempor. In hac habitasse platea dictumst. Suspendisse sed mollis risus.
                Praesent tincidunt eget risus sit amet maximus.</p>
            </p>
            <p><a class="btn btn-primary btn-lg" href="?page=login" role="button">Login/Register &raquo;</a></p>
        </div>
    </div>
<?php } else {
    $st1 = $conn->prepare("SELECT g.* FROM `group` AS g LEFT JOIN `user_group` AS ug ON ug.group_id = g.group_id WHERE ug.user_id=:userid");
    $st1->execute(array(
        ':userid' => $_SESSION['user_id']
    )); ?>
    <div class="container">
        <div class="jumbotron myBackground">
            <div class="card card-right">
                <div class="card-body my-card">
                    <h5 class="card-text"><?= $_SESSION["name"] ?> <?= $_SESSION["surname"] ?></h5>
                </div>
            </div>
            <br><br><br>
            <hr>
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                </tr>
                </thead>
                <tbody>
                <?php while ($data = $st1->fetch()): ?>
                    <tr onclick="window.location='?page=display&id=<?= $data["group_id"] ?>'">
                        <td><?= $data['groupname'] ?></td>
                    </tr>
                <?php
                endwhile;
                ?>
                </tbody>
            </table>
            <br><br>
            <a href="index.php?page=newgroup"><img src="images/miniadd.png" class="bottom" alt="Make Group"></a>
        </div>
    </div>
<?php } ?>