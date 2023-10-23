<?php
    session_start();
    
    if (isset($_SESSION["email"])) {
        header('location: index.php');
        exit();
    }

    if (isset($_POST["email"])) {
        $email = $_POST["email"];
        $pwd = $_POST["pwd"];
        $repeatPwd = $_POST["repeat-pwd"];
        require_once('validate_signup.php');
        $errorMsg = validateSignup($email, $pwd, $repeatPwd);
        if ($errorMsg === false) {
            require_once("db.php");
            $errorMsg = createUser($dbConn, $email, $pwd);
            if (!$errorMsg) {
                $_SESSION["email"] = $email;
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
        <title>Signup</title>
    </head>

    <body>
        <form action="#" method="post">
            <label for="input-email">Email</label><br>
            <input type="text" id="input-email" name="email"><br>
            <label for="input-pwd">Password</label><br>
            <input type="password" id="input-pwd" name="pwd"><br>
            <label for="input-repeat-pwd">Repeat password</label><br>
            <input type="password" id="input-repeat-pwd" name="repeat-pwd"><br>
            <?php
                if (isset($errorMsg)) {
                    echo '<p>' . $errorMsg . '</p>';
                }
            ?>
            &nbsp<br>
            <button type="submit" name="submit">Sign Up</button>
        </form>
    </body>
</html>