<?php
    
    session_start();
    if(isset($_SESSION['usr_id'])){
        $sessionUser = $_SESSION['usr_id'];
    }else{
        header( "Location: /") ;  
    }

    $event_id=$_GET["event_id"];

    require_once('connect.php');

    //lookup all links from the xml file if length of q>0
    if (strlen($event_id)>0) {

    		/*$joinevent_query = $connect->query("
			       SELECT usr_id FROM joinevents where event_id = $event_id and usr_id != $sessionUser
		   ");

	       $user_joined = $connect->query("
			       SELECT usr_lname, usr_fname FROM userapps where Facebook_ID = $sessionUser 
		   ");

		   $event_deleted = $connect->query("
			       SELECT event_name, event_pic FROM events WHERE event_id = $event_id 
		   ");

	       $usrJoined = $user_joined->fetch();
	       $eventDeleted = $event_deleted->fetch();

           while($joinevent = $joinevent_query->fetch()){
	           	$query = $connect->query("
					INSERT INTO notification
						(notification_title, notification_user, notification_image, event_id, notification_type) 
					VALUES ('". $usrJoined["usr_lname"] . " ". $usrJoined["usr_fname"] ." removed the pike ". $eventDeleted['event_name'] ."', " . $joinevent["usr_id"] . ",'". $eventDeleted["event_pic"] ."',$event_id, 'Event')
				");			   
	       }*/

          $query = $connect->query("
			       DELETE FROM events WHERE event_id = $event_id
		      ");
      }

      header( 'Location: /events.php' ) ;   
?>