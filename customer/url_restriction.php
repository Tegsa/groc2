<?php
    require_once 'connection.php';
    session_start();
    if(isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN'] != '' || isset($_SESSION['USER_REGISTER']) && $_SESSION['USER_REGISTER'] != '')
    {
    }
    else{
        $_SESSION['MESSAGE']="Please Login/Register to view home page !!";
        header("location: login.php");
    }



    
?>