<?php

    session_start();
    $sessionUser = $_SESSION['usr_id'];

    $hint = "";
    $event_id=$_GET["event_id"];

    require_once('connect.php');
    $contact_query = $connect->query("
        UPDATE notification 
        SET notification_status= 'old' 
        WHERE notification_user = $sessionUser and event_id = $event_id
    ");

     header( "Location: /view.php?event_id=$event_id ");
?>