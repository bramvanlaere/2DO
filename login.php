<?php
if( isset($_GET['logout'] ) ){
    $logout = $_GET['logout'];
    if( $logout==true ){
        session_start();
        session_destroy();
    }
}
if(!empty($_POST)){
    try
    {
        $dbh = new PDO('mysql:host=localhost; dbname=2DO', 'root', '');
    }
    catch(PDOException $e)
    {
        echo "niet geslaagt om in te loggen". $e->getMessage();
    }
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
    $query = $dbh->prepare( $sql );
    $query->execute( array( ':email'=>$email ) );
    $results = $query->fetchAll( PDO::FETCH_ASSOC );
    foreach( $results as $row ){
        if(password_verify($password, $row['password'])){
            session_start();
            $_SESSION['user_id'] = $row['ID'];
            header("Location: profile.php");
        }
        else
        {
            header('Location: login.php');
        }
    }
}
?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="css/screen.css">
</head>
<body>
<script src="js/bootstrap.min.js"></script>
<div class="container">
    <form class="text-center"name="loggin" method="post">

        <fieldset class="fieldset_one">

            <legend><a class="logo" href="#">logo</a></legend>
            <div>
                <label for="email">Username</label>
                <input id="email" name="email" type="text" placeholder="Username">
            </div>
            <div>
                <label for="password">Password</label>
                <input id="password" type="password" name="password" id="password" placeholder="Password">
            </div>

        </fieldset>

        <button type="submit" class="btn btn-info" >Login</button>
        <p class="account">Dont have an account? <a href="register.php">Sign up here!</a></p>
        <div class="feedback"></div>



    </form></div>
</body>
</html>