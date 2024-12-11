<?php
    include("config.php");
    session_start();

    //checking user is logged in
    if (!isset ($_SESSION['login_user'])){
        header("location:login.php");
        die();
    }

    //bool if post submitted or not, default false
    $replied = false;
    $error = '';

    //check form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //escape special chars and assign values from form 
        $reply_text = mysqli_real_escape_string($db, $_POST['ReplyText']);
        $user = $_SESSION['login_user'];
        //https://stackoverflow.com/questions/11480763/how-can-i-get-parameters-from-a-url-string
        //Get parameters from URL string
        $topic_name = (int) $_POST['Topic'];
        $contentid = $_POST['ContentID'];

        //format insert statement
        $sql = "insert into reply_table (User, ReplyText, ContentID) values ('$user', '$reply_text', '$contentid')";

        //run query and check if true
        if(mysqli_query($db, $sql)){
            $replied = true;
            //check topic name
            if($topic_name == 1){
                //redirect to topic page
                header("location: classic.php");
                exit;
            }
            if($topic_name == 2){
                header("location: general.php");
                exit;
            }
            if($topic_name == 3){
                header("location: bosanski.php");
                exit;
            }

        }
        else{
            $error = "Form submission failed ";
            exit;
        }
    }
    mysqli_close($db);
?>
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
    h1{
        color: #FFC000;
        text-align: center;
    }
    label{
        color: white;
        margin-top: 1%;
        margin-bottom: 1%;
    }
    form{
        display: flex;
        flex-direction: column;
        margin-left: 2%;
        width: 50%;
    }
    .input-btn{
        margin-left: 35%;
        margin-right: 35%;
        height: 3vw;
        background-color: slategrey;
        color: white
        
    }
    .options{
        margin-top: 2%;
        border-top: 4px solid rgba(255, 255, 255, 0.05);
        border-bottom: 4px solid rgba(255, 255, 255, 0.05);
        display: flex;
        justify-content: space-between;
    }
</style>
<html>
<head>
    <title>Reply to Post</title>
</head>

<body>

    <h1>Create a Reply</h1>
   
    <form action="reply.php" method="post">
        
        <!--textarea seemed to make more sense for a body of text https://www.w3schools.com/tags/tryit.asp?filename=tryhtml_textarea-->
        <label class="form-label"><b>Reply: </b></label> <br />
            <textarea class="text-inp" rows="4" cols="50" name="ReplyText"></textarea><br />
            <input type='hidden' name='ContentID' value ='<?php echo $_GET['ContentID']; ?>' >
            <input type='hidden' name='Topic' value ='<?php echo $_GET['Topic']; ?>' >
        <input class="input-btn" type="submit" value=" Submit Reply"/><br />
    </form>
        
    <div class="error">
        <?php echo $error; ?>
    </div>
    <div class='options'>
        <h4><a href="welcome.php" id="home">Home</a></h4>
        <h4><a href="logout.php" id="sign-out">Sign Out</a></h4>
    </div>
</body>

</html>