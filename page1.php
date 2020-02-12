<html lang="en">
    <head>
        <title>Homepage</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css"> 
    </head>
    <?php
    session_start();
    error_reporting(0);

    if (isset($_GET['submit'])){
        if(!empty($_GET['firstname']))
        {
            $_SESSION['firstname']= $_GET['firstname'];
            $firstname= $_SESSION['firstname'];
        }
    }

    ?>
    <body class = "loginform">
        <div class = "cards">
            <form action="products1.php" method="GET">
                <label>Enter Your Name<br></label>
                <input type="text" name="firstname" required minlength="3"><br>
                <button style="width: 100%;" type="submit"  name="submit">Submit</button>
            </form> 
        </div>
    </body>
</html>