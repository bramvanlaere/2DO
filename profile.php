<?php
session_start();
if ( isset($_SESSION['user_id'] ) ){

}
else{
    header('Location: login.php');
}

$dbh = new PDO('mysql:dbname=2DO;host=localhost','root','');

$id=$_SESSION['user_id'];
$itemsQuery = $dbh->prepare("SELECT id, name, done FROM items WHERE user = :user");
$itemsQuery->execute(['user' => $_SESSION['user_id']
]);
$items = $itemsQuery->rowCount() ? $itemsQuery:[];
$result = $dbh->prepare("SELECT * FROM users WHERE ID =$id");
$result->execute();
$row = $result->fetch();

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
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript">
        $(function() {
            $(".opmerking").click(function(){
                $("#olah").show();
            });
            $(".opmerking").click(function(){
                $(".box").show();
            });
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

   
    <div class="float-left-area">
<div class="inner-left">

<h1>Welcome <?php echo $row['email'];?></h1>
    <form action="#" method="post">
        <input type="text" name="title" id="name2" placeholder="search"/>
        <input type="submit" class="enter2" value=" search " />
    </form>
    <a href="#">add a new project</a>
    <a href="#" id="project1"> project 1</a>
<a href="login.php?logout=true"><div class="logout"><p>Log Out</p></div></a>

</div>
</div>

<div class="float-right-area">
<div class="inner-right">
    <div id="main">
        <ol  id="update" class="timeline">
    <div id="main">
            <?php
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
 <div class="list">
        <h1 class="header"> To Do</h1>
        <?php if(!empty($items)):?>
        <ul class="list-group">
            <?php foreach ($items as $item):?>
                <li class="list-group-item">
                    <span class="item <?php echo $item['done'] ? ' done': '' ?> "><?php echo $item['name'];?></span>
                    <?php if(!$item['done']): ?>
                        <a href="#" CLASS="opmerking2">Markeer als gedaan</a>
                        <a href="#" class="opmerking">opmerkingen</a>

                    <?php endif;?>
                </li>
            <?php endforeach;?>
        </ul>
            <?php else: ?>
                <p>geen items toegevoegd</p>
            <?php endif;?>
        <form class="item-add" action="add.php" method="post">
            <input type="text" name="name" placeholder="Type u item hier" class="input" autocomplete="off" required>
            <input type="submit" value="Add" class="enter1">

        </form>
     <div id="flash" align="left"></div>

     <div id="olah">
         <form action="#" method="post">
             <input type="hidden" name="post_id" id="post_id" value="<?php echo $post_id; ?>"/>
             <input  title="name" type="text" name="title" id="name"/><span class="titles">Name</span><span class="star">*</span><br />

             <input title="email" type="text" name="email" id="email"/><span class="titles">Email</span><span class="star">*</span><br />

             <textarea title="comment" name="comment" id="comment"></textarea><br />

             <input type="submit" class="submit" value=" Submit Comment " />
         </form>
     </div>
    </div>
</div>
</div>

<div class="clear-floated"></div>



    

</body>
</html>