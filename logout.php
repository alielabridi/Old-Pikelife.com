<?php
    session_start();
    unset($_SESSION['usr_id']);
    header( "Location: /") ;
?>