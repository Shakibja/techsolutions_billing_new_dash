<?php
session_start();
if(session_destroy())
{
    unset($_SESSION['email']);
    header("Location: login.php");
}

?>