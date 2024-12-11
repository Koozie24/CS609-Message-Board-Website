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
    h1, h2{
        color: #FFC000;
        text-align: center;
    }
    h3{
        color: white;
        text-align: center;
    }
    .topic-box{
        width: 50%;
    }
    .individual-div{
        margin-left: 2%;
        background-color: slategrey;
        border: 2px solid black;
        width: 90%;
    }
    #topic-title{
        text-align: center;
        font-style: italic;
        margin-left: 2%;
    }
    #sign-out{
        margin-top: 2%;
        text-align: center;
        border-top: 4px solid rgba(255, 255, 255, 0.05);
        border-bottom: 4px solid rgba(255, 255, 255, 0.05);
    }
    .big-box{
        width: 200%;
        display:flex;
        flex-wrap: wrap; /* Allows items to wrap as needed */
        justify-content: center; /* Center items horizontally */
    }
    .lil-box{
        flex: 1;
    }
    #post-box{
        background-color: slategrey;
        border: 2px solid black;
        width: 50%;
        height: 5vw;
    }
    #post{
        display: block;
    }
    .banner{
        text-align: center;
        margin-bottom: 1%;
        color: white;
        background-color: #242424;
    }
    
</style>
<html>
<head>
    <title>Fiesty Forums</title>
</head>

<body>
    <div class='banner'>
        <h1>Welcome to the Fiesty Forums Discussion</h1>
        <h3>Select a topic below and post as furiously as possible.</p> 
    </div>
    <div class="topic-box">
        
        <h2 id="topic-title">Discussion Topics: </h2>

        <div class="big-box">

            <div class="lil-box">

                <a href="general.php">
                    <div class="individual-div">
                        <h3 class="topic">General</h3>
                    </div>
                </a>

                <a href="classic.php">
                    <div class="individual-div">
                        <h3 class="topic">Classic WoW</h3>
                    </div>
                </a>

                <a href="bosanski.php">
                    <div class="individual-div">
                        <h3 class="topic">Bosna</h3>
                    </div>
                </a>

            </div>

            <div class="lil-box">
                <a href="create_post.php" id="post">
                    <div class="individual-div" id="post-box">
                        <h3>Create a Post</h3>
                    </div>
                </a> 
            </div>           

        </div>
    </div>
    <div id="sign-out">
        <h4><a href="logout.php">Sign Out</a></h4>
    </div>
</body>

</html>