<?php

session_start();
$sessionUser = $_SESSION['usr_id'];
$user_id = $_GET['user_id'];

    require_once('connect.php');

    //lookup all links from the xml file if length of q>0
    if (strlen($user_id)>0) {
          $query = $connect->query("
			       INSERT INTO friends (user_me, user_other, friend_request) 
			       VALUES ($sessionUser, $user_id, 'Request')
		   ");

    		$query = $connect->query("
				INSERT INTO notification
				(notification_title, notification_user, notification_image, event_id, notification_type) 
				VALUES ('". $event["usr_lname"] . " ". $event["usr_fname"] ." invited you to pike ". $event['event_name'] ."',$user_invited,'". $event["event_pic"] ."',$event_id, 'Event')
			");     
			 
           $query = $connect->query("
				INSERT INTO notification
				(notification_title, notification_user, notification_image, event_id, notification_type) 
				VALUES ('". $event["usr_lname"] . " ". $event["usr_fname"] ." invited you to pike ". $event['event_name'] ."',$user_invited,'". $event["event_pic"] ."',$event_id, 'Event')
			");
      }

      header( "Location: /userProfile.php?user_id=$user_id" ) ;   
?>