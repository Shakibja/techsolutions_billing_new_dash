<?php
include "includes/config.php";

session_start();

if(isset($_SESSION['email']))
{
   $user_check=$_SESSION['email']; 
}

$sql = mysqli_query($con,"SELECT email FROM users WHERE email='$user_check' ");

$row=mysqli_fetch_array($sql,MYSQLI_ASSOC);

$login_user=$row['email'];

if(!isset($user_check))
{
    header("Location:login.php");
}
?>