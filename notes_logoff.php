<?php
session_start();
unset($_SESSION['email']);
unset($_SESSION['user']);
unset($_SESSION['password']);
unset($_SESSION['note_id']);
header ('location: note_manager.php');
?>