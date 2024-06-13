<?php
require 'connection.php';
session_start();
// echo 'processing';

// print_r($_POST);

if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM personal_table WHERE email='$email' ";
    $dbcon = $connection->query($query);
    if ($dbcon) {
        if ($dbcon->num_rows > 0) {
            $_SESSION['msg'] = 'Email exists already';
            header('location:signup.php');
            // echo "user exist";
        } else {
            // print_r($dbcon);

            $hashp = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO personal_table (`firstname`, `lastname`, `email`,  `password`) VALUES ('$firstname', '$lastname', '$email', '$hashp')";
            $dbconnection = $connection->query($query);

            if ($dbconnection) {
                echo $dbconnection;
                $_SESSION['msg'] = 'success';
                header('location: login.php');
            } else {
                echo "No database connection";
            }
        }
    } else {
        $_SESSION['msg'] = 'Failed to excutel user';
        header('location:signup.php');
        echo "not selected";
    }
} else {
    header('location:signup.php');
}
