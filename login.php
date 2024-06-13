<?php
session_start();
require 'connection.php';
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM personal_table WHERE email='$email'";
    $dbcon = $connection->query($query);
    if ($dbcon) {
        if ($dbcon->num_rows > 0) {
            $user = $dbcon->fetch_assoc();
            $hashpassword = $user['password'];
            // echo'user found';
            $passverify = password_verify($password, $hashpassword);
            if ($passverify) {
                // echo'<div class="text-success">password verify successfully</div>';
                $_SESSION['user_id'] = $user['user_id'];
                header('location: dashboard.php');
            } else {
                echo '<div class="text-success">Invalid Credentails</div>';
            }
        } else {
            echo '<div class="text-danger">Invalid Credentails</div>';
        }
    } else {
        echo 'Query not executed';
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container pt-4">
        <div class="col-8 mx-auto shadow p-5">
            <h1 class="text-center text-primary mb-4">Login page</h1>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <input type="email" name="email" class="form-control my-2" placeholder='email' require>
                <input type="password" name="password" class="form-control my-2" placeholder='password' require>
                <!-- <input type="text" name="address"  class="form-control my-2" placeholder='address'>   -->
                <input type="submit" name="submit" class="btn btn-dark w-100">
            </form>
        </div>
    </div>
</body>

</html>