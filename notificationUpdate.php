<?php

    session_start();
    $sessionUser = $_SESSION['usr_id'];

    
    

    require_once('connect.php');

    if(isset($_GET["event_id"])){
        $event_id= $_GET["event_id"];
        $contact_query = $connect->query("
            UPDATE notification 
            SET notification_status= 'old' 
            WHERE notification_user = $sessionUser and event_id = $event_id
        ");
        header( "Location: /view.php?event_id=$event_id ");
    }else{
        $user_id =  $_GET["user_id"];
        $contact_query = $connect->query("
            UPDATE notification 
            SET notification_status= 'old' 
            WHERE notification_user = $sessionUser and sender_id = $user_id
        ");
        header( "Location: /userProfile.php?user_id=$user_id ");
    }
    

     
?>