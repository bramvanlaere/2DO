<?php
<<<<<<< HEAD
=======
<<<<<<< Updated upstream
/**
 * Created by PhpStorm.
 * User: bramvanlaere
 * Date: 25/07/17
 * Time: 13:07
 *
 */

if(!empty($_POST)) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $options = [
        'cost' =>12,

    ];
    $password = password_hash($password, PASSWORD_DEFAULT, $options);

    try
    {
        $PDOconn = new PDO('mysql:host=localhost; dbname=2DO', 'root', '');
        $PDOconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $PDOconn;
    }
    catch(PDOException $e)
    {
        echo "niet geslaagt om te connecteren met de databank". $e->getMessage();
    }



    $query = "insert into users (email, password) values ('".$email."','".$password."') ";
    $statement = $pdoconn->prepare("SELECT * from users where email = :email and
password = :password");

    $statement->bindParam(':email', $email);
    $statement->bindParam(':password', $password);
    $statement->execute();
    $res = $pdoconn->query($query);
    if ($res != false) {
        session_start();$_SESSION['email'] = $email;
        header('Location: loggedin.php');

    } else {

        header('Location: registration.php');

    }
}

?>
<!doctype html>
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
        <div class="links" ><h1>REGISTER</h1></a></div>
        <div>
            <label for="email">Enter a Username</label>
            <input id="email" name="email" type="text" placeholder="">
        </div>
        <div>
            <label for="password">Enter a Password</label>
            <input id="password" type="password" name="password" id="password" placeholder="">
        </div>

    </fieldset>


    <button type="submit" >Login</button>


</form>
</body>
</html>
=======
>>>>>>> origin/master


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
<<<<<<< HEAD
            session_start();
            $_SESSION["user_id"] = $email;
=======

            session_start();
            $_SESSION["user"] = $email;
>>>>>>> origin/master
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
<<<<<<< HEAD
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="css/screen.css">
=======
>>>>>>> origin/master

</head>
<body>
<div class="container">
    <div class="form">
<<<<<<< HEAD
        <h1>Sign up right here and never forget when to do what!</h1>
=======
>>>>>>> origin/master
        <div class="logosp"></div>
        <form action="" method="post">
            <div class="username">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" placeholder="Your email or username"></div>
            <div class="password">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Your password">
            </div>
<<<<<<< HEAD
            <button class="btn btn-info">
                Register
            </button>
        </form>
        <p>Damn I messed up I have an account for 2DO <a href="login.php">Bring me back</a></p>
    </div>
</div>
</body>
</html>
=======
            <button>
                Register
            </button>
        </form>
    </div>
</div>
</body>
</html>
>>>>>>> Stashed changes
>>>>>>> origin/master
