<?php

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
            header('Location:index.php');
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
</head>
<body>
<form name="loggin" method="post">

    <fieldset class="fieldset_one">

        <legend><a class= "logo" href="#">logo</a></legend>
        <div>
            <label for="email">Username</label>
            <input id="email" name="email" type="text" placeholder="Username">
        </div>
        <div>
            <label for="password">Password</label>
            <input id="password" type="password" name="password" id="password" placeholder="Password">
        </div>

    </fieldset>

    <button type="submit" >Login</button>
    <p>forgotten your password ?</p>
    <p>Dont have an account? <a href="register.php">Sign up here!</a></p>
    <div class="feedback"></div>

</form>
</body>
</html>