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
            <form action="signup_process.php" method="post">
                <input type="text" name="firstname" class="form-control my-2" placeholder='firstname '>
                <input type="text" name="lastname"  class="form-control my-2" placeholder='lastname'>
                <input type="email" name="email"  class="form-control my-2" placeholder='email'>
                <input type="password" name="password"  class="form-control my-2" placeholder='password'>
                <input type="submit" name="submit"  class="btn btn-dark w-100">
            </form>
        </div>
        <?php
        session_start();

        if (isset($_SESSION['msg'])) {
            echo "<div class='text-danger text-center'>".$_SESSION['msg']."</div>";
        }
        unset($_SESSION['msg']);
        ?>
    </div>
</body>
</html>