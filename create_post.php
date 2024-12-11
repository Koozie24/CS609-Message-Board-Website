<!DOCTYPE html>
<?php
    include("config.php");
    session_start();

    //checking user is logged in
    if (!isset ($_SESSION['login_user'])){
        header("location:login.php");
        die();
    }

    //bool if post submitted or not, default false
    $posted = false;
    $error = '';
    //check form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //escape special chars and assign values from form 
        $topic_name = mysqli_real_escape_string($db, $_POST['Topic']);
        $content_title = mysqli_real_escape_string($db, $_POST['ContentTitle']);
        $content_text = mysqli_real_escape_string($db, $_POST['ContentText']);
        $user = $_SESSION['login_user'];

        //format insert statement
        $sql = "INSERT INTO content_table (User, ContentTitle, ContentText, Topic) values ('$user', '$content_title', '$content_text', '$topic_name')";

        //run query and check if true
        if(mysqli_query($db, $sql)){
            $posted = true;
            //check topic name
            if($topic_name == "Classic"){
                //redirect to topic page
                header("location: classic.php");
                exit;
            }
            if($topic_name == "General"){
                header("location: general.php");
                exit;
            }
            if($topic_name == "Bosanski"){
                header("location: bosanski.php");
                exit;
            }
            //select newest insert from content table
            //get which forum is posted on
            //display content title/text/username/timestamp of poster in page

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
    .options{
        margin-top: 2%;
        border-top: 4px solid rgba(255, 255, 255, 0.05);
        border-bottom: 4px solid rgba(255, 255, 255, 0.05);
        display: flex;
        justify-content: space-between;
    }
    h1, h2{
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
</style>
<html>
<head>
    <title>Submit a Post</title>
</head>

<body>

    <h1>Create a New Discussion Post</h1>
   
    <form action="create_post.php" method="post">
        <label class="form-label"><b>Topic: </b></label>
        <!-- select and optgroup found from https://www.w3schools.com/tags/tag_select.asp -->
        <select name="Topic" class="topic-select" required>
            <optgroup label="Discussion Topics">
                <option value="General" class="option-selection">General</option>
                <option value="Classic" class="option-selection">Classic</option>
                <option value="Bosanski" class="option-selection">Bosanski</option>
            </optgroup>
        </select><br />
    

        <label class="form-label"><b>Post Title: </b></label>
            <input type="text" class="text-inp" name="ContentTitle"><br />
        
        <!--textarea seemed to make more sense for a body of text https://www.w3schools.com/tags/tryit.asp?filename=tryhtml_textarea-->
        <label class="form-label"><b>Post Body: </b></label> <br />
            <textarea class="text-inp" rows="4" cols="50" name="ContentText"></textarea><br />

        <input class="input-btn" type="submit" value=" Submit "/><br />
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