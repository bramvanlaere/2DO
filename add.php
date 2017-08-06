<?php
/**
 * Created by PhpStorm.
 * User: bramvanlaere
 * Date: 5/08/17
 * Time: 14:25
 */

session_start();
if ( isset($_SESSION['user_id'] ) ){

}
else{
    header('Location: login.php');
}

$dbh = new PDO('mysql:dbname=2DO;host=localhost','root','');

if (isset($_POST['name'])){
    $name = trim($_POST['name']);

    if (!empty($name)){
        $addedQuery = $dbh->prepare("
                      INSERT INTO items( name, user, done, created)
                      VALUES (:name, :user , 0, NOW())
                      ");
        $addedQuery->execute([
            'name'=>$name,
            'user'=>$_SESSION['user_id']
        ]);

    }

}
header('Location: profile.php');





?>