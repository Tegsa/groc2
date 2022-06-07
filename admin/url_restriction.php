<?php
    require_once 'connection.inc.php';

    if(isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN'] != '')
    {
    }
    else{
        header("location: login.php");
    }

    
?>