<?php
include 'dbh.php';
session_start();

if (isset($_POST['submit'])) {
    $loginemail = $_POST['email'];
    $loginpassword = $_POST['password'];
}

$query = $conn->prepare('SELECT * FROM user WHERE email =:email and password =:password');
$query->execute(array(':email' => $loginemail, ':password' => $loginpassword));

if ($query->rowCount() > 0) {
    $_SESSION['login'] = true;
    $result = $query->fetch(PDO::FETCH_ASSOC);
    $_SESSION['user_id'] = $result['user_id'];
    $_SESSION['name'] = $result['name'];
    $_SESSION['surname'] = $result['surname'];
    header('Location: ./../');
}
else {
    $_SESSION['error'] = "Wrong Username or Password!";
    header("Location: ../?page=login");
}
