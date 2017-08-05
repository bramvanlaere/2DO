<<<<<<< HEAD

<?php
if( isset($_GET['logout'] ) ){
    $logout = $_GET['logout'];
    if( $logout==true ){
        session_start();
        session_destroy();
    }
}
=======
<<<<<<< Updated upstream
=======







>>>>>>> Stashed changes
<?php
>>>>>>> origin/master

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
<<<<<<< HEAD
            session_start();
            $_SESSION['user_id'] = $email;
            header("Location: profile.php");
=======
            header('Location:index.php');
>>>>>>> origin/master
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
<<<<<<< HEAD
=======
<<<<<<< Updated upstream
</head>
<body>
<form name="loggin" method="post">

    <fieldset class="fieldset_one">

        <legend><a class= "logo" href="#">logo</a></legend>
=======
>>>>>>> origin/master
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="css/screen.css">
</head>
<body>
<script src="js/bootstrap.min.js"></script>
<div class="container">
<form class="text-center"name="loggin" method="post">

    <fieldset class="fieldset_one">

        <legend><a class="logo" href="#">logo</a></legend>
<<<<<<< HEAD
=======
>>>>>>> Stashed changes
>>>>>>> origin/master
        <div>
            <label for="email">Username</label>
            <input id="email" name="email" type="text" placeholder="Username">
        </div>
        <div>
            <label for="password">Password</label>
            <input id="password" type="password" name="password" id="password" placeholder="Password">
        </div>

    </fieldset>

<<<<<<< HEAD
=======
<<<<<<< Updated upstream
    <button type="submit" >Login</button>
    <p>forgotten your password ?</p>
    <p>Dont have an account? <a href="register.php">Sign up here!</a></p>
    <div class="feedback"></div>

</form>
=======
>>>>>>> origin/master
    <button type="submit" class="btn btn-info" >Login</button>
    <p class="account">Dont have an account? <a href="register.php">Sign up here!</a></p>
    <div class="feedback"></div>
    
    

</form></div>
<<<<<<< HEAD
=======
>>>>>>> Stashed changes
>>>>>>> origin/master
</body>
</html>