<?php
    if (isset($_POST["email"])) {
        $email = $_POST["email"];
        $pwd = $_POST["pwd"];
        require_once("db.php");
        $user = getUser($dbConn, $email);
        if (!$user) {
            $errorMsg = 'Incorrect credentials';
        } else {
            $hashedPwd = md5($pwd);
            if ($hashedPwd !== $user["pwd"]) {
                $errorMsg = 'Incorrect credentials';
            } else {
                header('location: index.php');
                exit();
            }
        }
    }
?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="styles/style.css">
        <title>Login</title>
    </head>

    <body>
        <form action="#" method="post">
            <label for="input-email">Email</label><br>
            <input type="text" id="input-email" name="email"><br>
            <label for="input-pwd">Password</label><br>
            <input type="password" id="input-pwd" name="pwd"><br>&nbsp<br>
            <?php
                if (isset($errorMsg)) {
                    echo '<p>' . $errorMsg . '</p>';
                }
            ?>
            <button type="submit" name="submit">Log In</button>
        </form>
        <br>
        <a href="signup.php">No account? Sign up!</a>
    </body>
</html>