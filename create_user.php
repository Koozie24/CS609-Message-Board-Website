<!DOCTYPE html>
<?php
    include("config.php");
    session_start();

    //bool if post submitted or not, default false
    $submitted = false;
    $error = '';
    //check form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //escape special chars and assign values from form 
        $user = mysqli_real_escape_string($db, $_POST['UserName']);
        $user_pw = mysqli_real_escape_string($db, $_POST['UserPw']);

        //format insert statement
        $sql = "INSERT INTO lab3_data (UserName, UserPw) values ('$user', '$user_pw')";

        //run query and check if true
        if(mysqli_query($db, $sql)){
            $posted = true;
            //redirect to login page
            header("location: index.php");
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
        text-align: center;
    }
    h1{
        color: #FFC000;
        text-align: center;
    }
    label{
        color: #FFC000;
        margin-top: 1%;
        margin-bottom: 1%;
    }
    form{
        display: flex;
        flex-direction: column;
        margin-left: 2%;
        width: 25%;
    }
    .input-btn{
        margin-left: 35%;
        margin-right: 35%;
        height: 3vw;
        background-color: slategrey;
        color: white;
        
    }
</style>
<html>
<head>
    <title>Submit a Post</title>
</head>

<body>

    <h1>Create a New User Account</h1>

    <form action="create_user.php" method="post">
        <label class="form-label"><b>Username : </b></label>
            <input type="text" class="text-inp" name="UserName"><br />
        
        <label class="form-label"><b>Password : </b></label>
            <input type="text" class="text-inp" name="UserPw"><br />
        
        <input class="input-btn" type="submit" value=" Create Account "/><br />
    </form>
   
    <div class='options'>
        <h4><a href="index.php" id="sign-out">Return to Login Screen</a></h4>
    </div>
</body>

</html>