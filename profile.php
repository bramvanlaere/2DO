<?php
session_start();
if ( isset($_SESSION['user_id'] ) ){

}
else{
    header('Location: login.php');
}

$dbh = new PDO('mysql:dbname=2DO;host=localhost','root','');


$itemsQuery = $dbh->prepare("SELECT id, name, done FROM items WHERE user = :user");
$itemsQuery->execute(['user'=> $_SESSION['user_id']]);
$items = $itemsQuery->rowCount()?$itemsQuery:[];
foreach ($items as $item){echo $item['name'],'<br>';}

?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>2DO|Forget Forgetting</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="css/screen.css">
</head>
<body>

    <div class="list">
        <h1 class="header"> To Do</h1>
        <ul>
            <li><span class="item">doe iets</span></li>
            <a href="#" CLASS="done-button">Markeer als gedaan</a>

        </ul>

        <form class="item-add" action="add.php" method="post">
            <input type="text" name="name" placeholder="Type u item hier" class="input" autocomplete="off" required>
            <input type="submit" value="Add" class="submit">
        </form>
    </div>

</body>
</html>