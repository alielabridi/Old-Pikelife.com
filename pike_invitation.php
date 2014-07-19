<?php

	session_start();
	$sessionUser = $_SESSION['usr_id'];

    $event_id=$_GET["event_id"];
    $user_invited=$_GET["user_invited"];

    require_once('connect.php');

    //lookup all links from the xml file if length of q>0
    if (strlen($event_id)>0) {
    		$events_query = $connect->query("
              	SELECT *
                FROM events
                JOIN userapps U ON U.Facebook_ID = events.usr_create
                WHERE event_id = ". $event_id ."
          	");

          	$users_query = $connect->query("
              SELECT * 
              FROM  userapps 
              WHERE Facebook_ID = $sessionUser
          	");

    		if($event = $events_query->fetch()){

	          $query = $connect->query("
				       INSERT INTO notification
				       (notification_title, notification_user, notification_image, event_id, notification_type) 
				       VALUES ('". $event["usr_lname"] . " ". $event["usr_fname"] ." invited you to pike ". $event['event_name'] ."',$user_invited,'". $event["event_pic"] ."',$event_id,'invitation')
			      ");
	      	}
      }

      header( "Location: /view.php?event_id=$event_id" ) ;   
?>