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
        //Includes
        include 'classes/class.Notes.inc.php';
        include 'classes/class.NotesNorm.inc.php';
        include 'classes/class.NotesTD.inc.php';
        include 'classes/class.NotesRemind.inc.php';
        include 'classes/class.Database.inc.php';
        session_start();
        echo '<br/><br/><br/><br/><br/>';
        //echo $_SESSION['id'] . '!';
        //unset($_SESSION['id']);
        //echo $_SESSION['id'] . '!';
        global $user_notes;
        $loggedIn = '';
        //Information for customizing the page
        if(!empty($_SESSION['email'])){
            $username = $_SESSION['user'];
            $email = $_SESSION['email'];
            $password = $_SESSION['password'];

            //If trying to delete or edit a note
            $user_notes = Notes::load("$email","$password");
        }
        //Checks if the user is logged in
        if(!isset($_SESSION['email'])){
            $loggedIn_Yes = 'display:none;';
            $loggedIn_No = '';
        }else{
            $loggedIn_No = 'display:none;';
            $loggedIn_Yes = '';
        } 

        global $value;
        $value = array();
        for($i = 0; $i < count($user_notes); $i++){
            $user_notes[$i]['page_num'] = $i + 1;
            array_push($value,Notes::getInstance($user_notes[$i]['note_type'],$user_notes[$i]));
        }
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //$user_notes = Notes::load("$email","$password");
            $page_num = 0;

            for($i = 0; $i < count($user_notes); $i++){
                $page_num = $i + 1;
                if(!empty($_POST['delete-'.$page_num])){
                    $_SESSION['id'] = $user_notes[$i]['note_id'];
                    echo $_SESSION['id'];

                    header ('location: note_delete.php');
                }
                if(!empty($_POST['edit-'.$page_num])){
                    $_SESSION['id'] = $user_notes[$i]['note_id'];
                    echo $_SESSION['id'];
                    header ('location: note_edit.php');
                }
            }
            //echo "<tt><pre>" . var_export($user_notes,true) . "</pre></tt>";
        }
        ?>
        <!--/.php -->
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Note Manager</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Home</a></li>
                        <!-- PHP to make Login disapeer after logging in -->
                        <li class="active"><a href="notes_login.php" style='<?php echo $loggedIn_No; ?>'>Sign In</a></li>
                        <li class="active"><a href="note_reg.php" style='<?php echo $loggedIn_No; ?>'>Sign Up</a></li>
                        <li class="active"><a style='<?php echo $loggedIn_Yes; ?>' href="notes_logoff.php">Log Off</a></li>
                    </ul>
                </div>

                <!--/.nav-collapse -->
            </div>
        </nav>

        <div class="container">
            <br><br><br>
            <div class='jumbotron'>
                <div class='text-center'>
                    <br/>
                    <h1>Note Manager</h1>
                    <p class="lead">Easy way to organize your notes</p>
                    <p class="lead" style='<?php echo $loggedIn_Yes; ?>'>Welcome <?php echo $username ?></p>

                </div>
            </div>
            <!-- /.jumbotron -->
            <!--Notes-->
            <div id='notes' >

                <?php
    //Php that loads all of the user's notes
    if(!empty($_SESSION['email'])){

        $user_notes;
        //echo "<tt><pre>" . var_export($user_notes,true) . "</pre></tt>";
        $value;
        for($i = 0; $i < count($user_notes); $i++){
            echo $value[$i];
        }
        //echo "<tt><pre>" . var_export($user_notes,true) . "</pre></tt>";
    }


                ?>



            </div>
            <button type="button" style='<?php echo $loggedIn_Yes; ?>' onclick="window.location.href='note_add.php'" ><input style='<?php echo $loggedIn_Yes; ?>' type='image' src="assets/add.png"/>Add New Note</button>
            <p style='<?php echo $loggedIn_No; ?>'>Log In to Access Notes</p>
        </div>
        <!-- /.container -->
        <br/><br/><br/><br/><br/>


    </body>

</html>