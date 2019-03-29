<?php
include 'dbh.php';
if (isset($_POST['submit'])) {
    if ($_POST['password'] == $_POST['repeat_password']) {

        $registeremail = $_POST['email'];
        $registerpas = $_POST['password'];
        $registername = $_POST['name'];
        $registersirname = $_POST['surname'];

        $query = $conn->prepare('SELECT * FROM `user` WHERE email=:email');
        $query->execute(array(
            ':email' => $registeremail
        ));

        if ($query->rowCount() == 0) {
            $query = $conn->prepare('INSERT INTO user(email, password, name, surname) VALUES (:registeremail, :registerpas, :registername , :registersirname)');
            $query->execute(array(
                ':registeremail' => $registeremail,
                ':registerpas' => $registerpas,
                ':registername' => $registername,
                ':registersirname' => $registersirname
            ));

            $_SESSION['succes'] = 'Registration succesfully';
            header('Location: ../index.php?page=login');
        } else {
            $_SESSION['error'] = "Email already exists";
            header('Location: ../index.php?page=login');
        }
        $_SESSION['error'] = "Passwords are not the same";
        header('Location: ../index.php?page=register');
    }
}

