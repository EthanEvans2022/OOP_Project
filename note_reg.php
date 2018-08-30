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
        $mysqli = $db->getConnection();
        $errormessage ="";
        $isVisibile = 'display: none;';    

        $is_submitted = isset($_POST['email']);
        if($is_submitted){
            if(empty($_POST['email']) || empty($_POST['name']) || empty($_POST['pword'])){
                $errormessage = '<div class="alert-warning">Please fill out all pieces of infomration</div>';
            }else{
                $email = trim($_POST['email']);
                $password = trim($_POST['pword']);
                $username = trim($_POST['name']);

                echo '<br/><br/><br/>' . $email;

                $query = 'SELECT * FROM users WHERE email = "' . $email . '" || password = "' . $password . '" || username = "' . $username . '"';
                if(mysql_affected_rows() > 0){
                    $errormessage = '<div class="alert-warning">The username, email, or password has already been registered </div>';
                }else{
                    $sql_query = "INSERT INTO `users` (`username`, `password`, `email`) VALUES ('$username', '$password', '$email');";
                    if($result = mysqli_query($mysqli, $sql_query)){
                        $errormessage = '<div class="alert-success">Successfully Registered!</div>';
                        $isVisibile = '';
                        header ('location:note_login.php');
                    }else{
                        $errormessage = "Couldn't connect to the server.";
                    }
                }
            }
        }
        ?>
    </head>

    <body>

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">

                </div>

                <!--/.nav-collapse-->
            </div>
        </nav>

        <div class="container">
            <div class='text-center'>


                <br><br><br>

                <h1>Registration</h1>
                <form id="regform" method="post" style="margen:20px">

                    <input type="text" name="name" id="name"  placeholder="Username" />
                    <br/>
                    <input type="password" name="pword" id="pword"  placeholder="Password" />
                    <br/>
                    <input type="text" name="email" id="email" placeholder="Email address" />
                    <br/>
                    <input type="submit" value="Submit" />
                </form>
            </div>

        </div>
        <?php echo $errormessage ?>
        <!-- /.container -->



    </body>

</html>