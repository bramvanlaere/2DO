<?php
if( !empty( $_POST ) )
{
    if( !empty( $_POST['username'] ) && !empty( $_POST['password'] )  ){
        $conn = new PDO('mysql:host=localhost;dbname=2DO', "root", "");
        $email = $_POST["username"];
        $options = [
            'cost'=>12,
        ];
        $password = password_hash($_POST["password"],PASSWORD_DEFAULT,$options);
        $sth = $conn->prepare("INSERT INTO users (email, password) VALUES (:email, :password);");
        $sth->bindParam(':email', $email);
        $sth->bindParam(':password', $password);
        $sth->execute();
        if( $sth -> execute() )
        {
            session_start();
            $_SESSION["user_id"] = $email;
            header("Location: login.php");
        }
        else
        {
            echo "<h1>u bent niet geregistreerd</h1>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="css/screen.css">

</head>
<body>
<div class="container">
    <div class="form">
        <h1>Sign up right here and never forget when to do what!</h1>
        <div class="logosp"></div>
        <form action="" method="post">
            <div class="username">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Your email or username"></div>
            <div class="password">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Your password">
            </div>
            <button class="btn btn-info">
                Register
            </button>
        </form>
        <p>Damn I messed up I have an account for 2DO <a href="login.php">Bring me back</a></p>
    </div>
</div>
</body>
</html>