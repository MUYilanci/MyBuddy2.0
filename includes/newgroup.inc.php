<?php
if (!isset($_SESSION['login'])) {
    header('Location:index.php');
}
else {   ?>
    <div class="container">
        <div class="jumbotron myBackground">
            <form action="php/newgroup.php" method="post">
                <div class="form-group">
                    <label for="name">Group Name</label>
                    <input class="form-control col-3" name="name" placeholder="Group Name">
                </div>
                <div class="form-group">
                    <label for="description">Group Description</label>
                    <textarea class="form-control" name="description" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="submit">Make Group</button>
                </div>
            </form>
        </div>
    </div>
<?php } ?>