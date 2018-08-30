<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Note Manager</title>

        <!-- Bootstrap -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- CSS -->
        <link type="text/css" rel="stylesheet" href="stylesheet.css"/>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <?php 
        include 'classes/class.Database.inc.php';

        //Connection to database
        $db = Database::getInstance();
        //Connects to the database
        $mysqli = $db->getConnection();
        session_start(); 
        $errormessage = '';
        $is_submitted = isset($_POST['email']);
        if($is_submitted){
            $email = trim($_POST['email']);
            $pword = trim($_POST['pword']);
            $query = "SELECT * FROM `users` WHERE `password`= '$pword' AND `email` = '$email'";
            if($result = mysqli_query($mysqli, $query)){
                $numRowsSelected = mysqli_num_rows($result);
                if($numRowsSelected){
                    $row = mysqli_fetch_assoc($result);
                    $_SESSION['user'] = $row['username'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['password'] = $row['password'];
                    header("location: note_manager.php");
                }
                $errormessage = "<div class='alert-danger'>The email or password is incorrect</div>";
            }else{
                $errormessage = "Couldn't connect to the server.";
            }
        }

        ?>
    </head>

    <body>

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">

                </div>

                <!--/.nav-collapse -->
            </div>
        </nav>

        <div class="container">
            <br><br><br>

            <h1>Login</h1>
            <form method="post">
                <input type="text" name="email" id="email"  placeholder="Email" />
                <br/>
                <input type="password" name="pword" id="pword"  placeholder="Password" />
                <br/>
                <input type="submit" value="Submit" />
            </form>
            <?php 
            echo $errormessage;
            ?>
        </div>
        <!-- /.container -->



    </body>

</html>