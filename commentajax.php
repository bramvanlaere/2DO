<?php
session_start();
if ( isset($_SESSION['user_id'] ) ){

}
else{
    header('Location: login.php');
}

$dbh = new PDO('mysql:dbname=2DO;host=localhost','root','');
if($_POST)
{
$name=$_POST['name'];
$email=$_POST['email'];
$comment_dis=$_POST['comment'];
$post_id=$_POST['post_id'];

$lowercase = strtolower($email);

  
$dbh->query("INSERT INTO comments (name,email,comment) VALUES ('$name','$email','$comment_dis') ");


}

else { echo ('you fucked boiiii');}

?>
<li class="box">
<span  class="com_name"> <?php echo $name;?></span> <br /><br />

<?php echo $comment_dis; ?>
</li>