<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
 <script type="text/javascript" src="jquery.js"></script>
 <script type="text/javascript">
$(function() {

$(".submit").click(function() {

var name = $("#name").val();
var email = $("#email").val();
	var comment = $("#comment").val();
	var post_id = $("#post_id").val();
    var dataString = 'name='+ name + '&email=' + email + '&comment=' + comment + '&post_id=' + post_id;

	if(name=='' || email=='' || comment=='')
     {
    alert('Please Give Valide Details');
     }
	else
	{
	$("#flash").show();
	$("#flash").fadeIn(400).html('<img src="ajax-loader.gif" align="absmiddle">&nbsp;<span class="loading">Loading Comment...</span>');
$.ajax({
		type: "POST",
  url: "commentajax.php",
   data: dataString,
  cache: false,
  success: function(html){

  $("ol#update").append(html);
  $("ol#update li:last").fadeIn("slow");
  document.getElementById('email').value='';
   document.getElementById('name').value='';
    document.getElementById('comment').value='';
	$("#name").focus();

  $("#flash").hide();

  }
 });
}
return false;
	});



});

</script>
</head>

<body>

<div id="main">
<ol  id="update" class="timeline">

<?php
session_start();
if ( isset($_SESSION['user_id'] ) ){
}
else{
    header('Location: login.php');
}
$dbh = new PDO('mysql:dbname=2DO;host=localhost','root','');
//$post_id value comes from the POSTS table
$post_id=$_SESSION['user_id'];
$sql=$dbh->prepare(("select * from comments"));
$sql->execute();
while($row=$sql->fetch(PDO::FETCH_ASSOC))
{
$name=$row['name'];
$email=$row['email'];
$comment_dis=$row['comment'];

$lowercase = strtolower($email);


?>


<li class="box">
<span class="com_name"> <?php echo $name; ?></span> <br />My Comment</li>

<?php
}
?>

</ol>
<div id="flash" align="left"></div>

<div style="margin-left:100px">
<form action="#" method="post">
<input type="hidden" name="post_id" id="post_id" value="<?php echo $post_id; ?>"/>
<input type="text" name="title" id="name"/><span class="titles">Name</span><span class="star">*</span><br />

<input type="text" name="email" id="email"/><span class="titles">Email</span><span class="star">*</span><br />

<textarea name="comment" id="comment"></textarea><br />

<input type="submit" class="submit" value=" Submit Comment " />
</form>
</div>





</div>
</body>
</html>
