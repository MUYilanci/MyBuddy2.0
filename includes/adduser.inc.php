<div class="container">
    <div class="jumbotron myBackground">
        <?php
        if (isset($_SESSION['error'])) {
            echo '<div class="alert alert-danger" role="alert">';
            echo $_SESSION['error'];
            echo '</div>';

            $_SESSION['error'] = NULL;
        }
        ?>
        <form class="needs-validation" novalidate method="post" action="php/adduser.php">
                <div class="form-group">
                    <input class="form-control col-3" name="email" placeholder="E-mail">
                </div>
            <button class="btn btn-primary" type="submit">Add User</button>
        </form>
    </div>
</div>