<table class="table m-t-20" id="grouptable">
    <tr>
        <th>Wie</th>
        <th>Saldo</th>
        <th>Uitgaven</th>
    </tr>
    <?php
    $query2 = $conn->prepare("SELECT * FROM user_group WHERE group_id=:group_id");
    $query2->execute(array(
        ":group_id" => $group_id
    ));

    foreach ($query2 as $result2) {
        $query = $conn->prepare("
        SELECT U.name,
        (SELECT SUM(amount) FROM payment WHERE user_group_id=UG.user_group_id) AS expense,
        (SELECT SUM(amount) FROM dept WHERE user_group_id=UG.user_group_id) AS topay
        FROM payment AS P
        RIGHT JOIN user_group AS UG
        ON P.user_group_id = UG.user_group_id
        RIGHT JOIN `user` AS U
        ON UG.user_id = U.user_id
        RIGHT JOIN `group` AS G
        ON UG.group_id = G.group_id
        WHERE G.group_id = :group_id
        AND UG.user_group_id = :user_group_id
        GROUP BY UG.user_group_id");
        $query->execute(array(
            ":group_id" => $group_id,
            ":user_group_id" => $result2['user_group_id']
        ));

        foreach ($query as $result) {

            $query1 = $conn->prepare("SELECT SUM(amount) AS user_dept FROM dept WHERE user_group_id=:id");
            $query1->execute(array(
                ":id" => $result2['user_group_id']
            ));
            $result1 = $query1->fetch();
            $saldo = $result['expense'] - $result1['user_dept'];

            if ($saldo < 0) {
                ?>
                <tr>
                    <td>
                        <?= $result['name'] ?>
                    </td>
                    <td class="text-danger">
                        &euro; <?= $saldo ?>
                    </td>
                    <td>
                        <?php if (empty($result['expense'])){
                            echo "&euro; 0";
                        }
                        else {
                            echo "&euro; ". $result['expense'];
                        }?>
                    </td>
                </tr>
                <?php
            } else {
                ?>
                <tr>
                    <td>
                        <?= $result['name'] ?>
                    </td>
                    <td class="text-success">
                        &euro; <?= $saldo ?>
                    </td>
                    <td>
                        &euro; <?= $result['expense'] ?>
                    </td>
                </tr>
                <?php
            }

        }
    }
    ?>
    <tr>
        <td><h4>Totale uitgaven:</h4></td>
        <td></td>
        <td>
            <?php
            $query2 = $conn->prepare("
                SELECT SUM(P.amount) AS total
                FROM payment AS P
                INNER JOIN user_group AS UG
                ON P.user_group_id = UG.user_group_id
                WHERE UG.group_id = :group_id");
            $query2->execute(array(
                ":group_id" => $group_id
            ));
            $result2 = $query2->fetch();

            if (empty($result2['total'])) {
                ?>
                &euro; 0,00
                <?php
            } else {
                ?>
                &euro; <?= $result2['total'] ?>
                <?php
            }
            ?>
        </td>
    </tr>
</table>