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
        include 'classes/class.Notes.inc.php';
        include 'classes/class.Database.inc.php';

        include 'classes/class.NotesNorm.inc.php';
        include 'classes/class.NotesTD.inc.php';
        include 'classes/class.NotesRemind.inc.php';

        session_start();
        if (!isset($_SESSION["id"])){
            header('location: note_forbidden.php');
        }
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $errormessage ="";

        $id = $_SESSION['id'];
        $note_pending = Notes::get($id);
        //echo "<tt><pre>" . var_export($note_pending,true) . "</pre></tt>";
        
        //echo $note_pending['note_type'] . '!';
        $note_pending = Notes::getInstance($note_pending['note_type'],$note_pending);

        $is_submitted = isset($_POST['confirm']);
        if($is_submitted){
            $sql_query = "DELETE FROM `notes` WHERE `notes`.`note_id` = $id";
            if($result = mysqli_query($mysqli, $sql_query)){
                header("location: note_manager.php");
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
            <div class='text-center'>
                <h1>Delete Note Note</h1>

            </div>
            <form id="regform" method="post" style="margin:20px">
                <div class='well'>
                    <div class='text-center'>
                        <h3>Are you sure you want to delete this note?</h3>
                        <?php
                        echo $note_pending .'<br/><br/>';

                        ?>
                        <input type="submit" class="btn btn-primary" name='confirm' value='Yes, delete this note'/>
                        <button type="button" class="btn btn-primary" onclick="window.location.href='note_manager.php'">Back to Note Manager</button>

                    </div>

                </div>

            </form>
        </div>
        <!-- /.container -->
        <?php echo $errormessage; ?>
    </body>

</html>