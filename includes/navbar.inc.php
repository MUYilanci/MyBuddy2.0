<?php
$menuItems = array(
    array('home', 'Home')
);
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand disabled">MyBuddy2.0</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="navbar-nav mr-auto">
        <?php
        foreach ($menuItems as $menuItem) {
            echo '<a class="nav-link" href="index.php?page=' . $menuItem[0] . '">' . $menuItem[1] . '</a>';
        }
        ?>
    </ul>
    <?php
    if (!isset($_SESSION['login'])) {
        echo '<li class="nav-item dropdown navbar-nav dpd-color nav-dropdown-pointer">';
        echo '<a class="nav-link" href="index.php?page=login">Login</a>';
        echo '</li>';
    }

    if (isset($_SESSION['login']) && !($_SESSION['login'] == false)) {
    echo '<li class="nav-item dropdown navbar-nav dpd-color nav-dropdown-pointer">';
        echo '<a class="nav-link" href="php/logout.php">Logout</a>';
        echo '</li>';
    }
    ?>
    </div>
</nav>
