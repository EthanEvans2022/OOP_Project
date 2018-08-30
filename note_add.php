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
        <?
        include 'classes/class.Database.inc.php';
        session_start();
        if (!isset($_SESSION["email"])){
            header('location: note_forbidden.php');
        }
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $errormessage ="";

        $is_submitted = isset($_POST['title']);
        if($is_submitted){
            if(empty($_POST['title']) || empty($_POST['note_type']) || empty($_POST['note'])){
                $errormessage = '<div class="alert-warning">Please fill out all pieces of infomration</div>';
            }else{
                $note_type = trim($_POST['note_type']);
                $note_title = (string)(trim($_POST['title']));
                $note = (string)(trim($_POST['note']));
                $email = (string)(trim($_SESSION['email']));
                $password = (string)(trim($_SESSION['password']));
                
                $sql_query = 'INSERT INTO `notes` (`note_id`, `note_type`, `note_title`, `note`, `email`, `password`, `time_created`, `page_num`) VALUES (NULL, "' . $note_type .'", "' . $note_title . '", "' . $note . '", "' . $email . '", "' . $password .'", CURRENT_TIMESTAMP, "0");';

                if($result = mysqli_query($mysqli, $sql_query)){
                    header("location: note_manager.php");
                }else{
                    $errormessage = "Couldn't connect to the server.";
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
                <!--/.nav-collapse -->
            </div>
        </nav>

        <div class="container">
            <br><br><br>

            <h1>Add New Note</h1>
            <form id="regform" method="post" style="margin:20px">
                <div class='well'>
                    <h3>Note Types:</h3>
                    <input type="radio" name="note_type" value=1> Normal Note<br>
                    <input type="radio" name="note_type" value=2> To-Do List<br>
                    <input type="radio" name="note_type" value=3> Reminder<br>
                    <br/>
                    <br/>

                    <input type="text" name='title' id='title' placeholder="Title"/>
                    <br/>
                    <br/>

                    <textarea rows="4" cols="50" name="note" id="note" placeholder="New Note"></textarea>
                    <br/>
                    <input type="submit" value="Add" />
                </div>


            </form>
        </div>
        <!-- /.container -->
        <?php echo $errormessage; ?>


    </body>

</html>