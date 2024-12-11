<!DOCTYPE html>

<?php
    include("config.php");
    session_start();

    $error = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //username and password sent from form

        $myusername = mysqli_real_escape_string($db, $_POST['UserName']);
        $mypassword = mysqli_real_escape_string($db, $_POST['UserPw']);

        $sql = "SELECT UserID FROM lab3_data WHERE UserName = '$myusername' and UserPw = '$mypassword'";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        $count = mysqli_num_rows($result);

        //if result matched $myusername and $mypassword, table row must be 1 row

        if($count == 1){
            $_SESSION['login_user'] = $myusername;

            header("location:welcome.php");
        }
        else {
            $error = "Your Login Name or Password is invalid";
        }
    }
?>

<html>
<head>
    <title>Login Page</title>

    <style type="text/css">
        input{
            margin: 1%;
        }
        .login-header{
            width: 50%;
            background-color: slategrey;
            color: white;
            text-align: center;
            border: 2px solid grey;
        }
        .login-box{
            width: 25%;
            padding: 2%;
            border: 4px solid rgba(255, 255, 255, 0.05);
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .box{
            display: flex;
            flex-direction: column;
            padding: 2%;
        }
        .input-btn{
            margin-left: 2.5%;
            width: 100%;
            background-color: slategrey;
            color: white
        }
        body{
            font: 14px "Open Sans", Arial, "Helvetica Neue", Helvetica, sans-serif;
            background-color: #242424;
            color: #FFC000;
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
    </style>
</head>

<!--I referenced your login page HTML code that you showed in the most recent SQL video on https://cs.indstate.edu/~cs609ka/examples.html*/-->
<body>
    <div>
        <div class="login-box">
            <div class="login-header"> <b>Login</b> </div>

            <div class="login-form">
                <form action="" method="post">
                    <label>Username :</label><input type="text" name="UserName" class="box"/>
                    <label>Password :</label><input type="password" name="UserPw" class="box"/>
                    <input class="input-btn" type="submit" value=" Submit "/><br />
                </form>

                <div class="error">
                    <?php echo $error; ?>
                </div>
            </div>

            <div class='options'>
                    <h4><a href="create_user.php" id="create">Create Account</a></h4>
            </div>
        </div>
    </div>

</body>
</html>