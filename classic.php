<!DOCTYPE html>

<style>
    body{
        font: 14px "Open Sans", Arial, "Helvetica Neue", Helvetica, sans-serif;
        background-color: #242424;
    }
    a, a:active{
        color: #FFC000;
        text-decoration: none;
    }
    a:hover{
        filter: brightness(150%);
    }
    .new-post{
        margin-left: 2%;
        margin-right: 2%;
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.05);
    }
    .post-text{
        margin-left: 2%;
        margin-right: 2%;
    }
    .post-title{
        color: #FFC000;
        margin-left: 1%;
    }
    .banner{
        text-align: center;
        margin-bottom: 1%;
        color: white;
        background-color: #242424;
    }
    .post-author{
        margin-left: 1%;
    }
    h1{
        text-decoration: underline;
        color: #FFC000;
    }
    .username{
        color: grey;
    }
    .options{
        margin-top: 2%;
        border-top: 4px solid rgba(255, 255, 255, 0.05);
        border-bottom: 4px solid rgba(255, 255, 255, 0.05);
        display: flex;
        justify-content: space-between;
    }
    .reply{
        margin-left: 4%;
        margin-right: 4%;
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.05);
    }
    .reply-text{
        margin-left: 2%;
    }
    .reply-author{
        margin-left: 1%;
    }
</style>
<html>
<head>
    <title>Classic Discussion</title>
</head>

<body>
    <div class='banner'>
        <h1>Welcome to the Classic WoW Discussion Area</h1>
        <h3>Here, things get heated and there is no moderation. Post like its 2006 and Blizzard just nerfed your class. Yeah, youre totally going to unsub from the game, bro.</h3>
    </div>
    <?php
        include("config.php");
        session_start();

        //checking user is logged in
        if (!isset ($_SESSION['login_user'])){
            header("location:login.php");
            die();
        }

        //format query
        $sql = "SELECT User, ContentTitle, ContentText, Created, ContentID FROM content_table WHERE topic = 'Classic' ORDER BY ContentID DESC";
        $result = mysqli_query($db, $sql);

        //https://www.w3schools.com/php/func_mysqli_num_rows.asp
        //check if number of rows > 0
        if(mysqli_num_rows($result) > 0){
            //loop through result, grab a new row. if row, display in HTML
            //associative array function call from https://www.w3schools.com/php/func_mysqli_fetch_assoc.asp
            //https://www.w3schools.com/php/php_echo_print.asp
            //above link showed my format for using echo to create dynamic html tags
            while($row = mysqli_fetch_assoc($result)){
                echo "<div class='new-post'>";
                echo "<h3 class='post-title'>" . $row['ContentTitle'] . "</h3>";
                echo "<p class='post-text'>" . $row['ContentText'] . "</p>";
                echo "<p class='post-author'> Posted by: <b> <span class='username'>" . $row['User'] . "</span></b> on <i>" . $row['Created'] . "</i></p>";
                //https://stackoverflow.com/questions/5440197/how-to-pass-a-php-variable-using-the-url found for passing parameters in URL's
                echo "<h4><a href='reply.php?ContentID=". $row['ContentID'] . "&Topic=1 class='reply'>Reply</a></h4>";
                //echo "<h4><a href='reply.php' class='reply'>Reply</a></h4>";
                echo "</div>";

                //format query for replies, php concatenate string https://www.w3schools.com/php/php_string_concatenate.asp
                $reply_sql = "SELECT User, ReplyText, Created FROM reply_table WHERE ContentID = " . $row['ContentID'];
                $reply_result = mysqli_query($db, $reply_sql);
                
                //check if num of rows > 0
                if(mysqli_num_rows($reply_result) > 0){
                    //loop through reply results 
                    while($reply_row = mysqli_fetch_assoc($reply_result)){
                        //print results to page
                        echo "<div class='reply'>";
                        echo "<p class='reply-text'>" . $reply_row['ReplyText'] . "</p>";
                        echo "<p class='reply-author'> Posted by: <b> <span class='username'>" . $reply_row['User'] . "</span></b> on <i>" . $reply_row['Created'] . "</i></p>";
                        echo "</div>";
                    }
                }
            }
        }
        mysqli_close($db);
    ?>
    <div class='options'>
        <h4><a href="welcome.php" id="home">Use Hearthstone</a></h4>
        <h4><a href="create_post.php" id="post">Create New Post</a></h4>
        <h4><a href="logout.php" id="sign-out">Sign Out</a></h4>
    </div>
</body>

</html>