<?php

session_start();
$sessionUser = $_SESSION['usr_id'];

    $event_id=$_GET["event_id"];

    require_once('connect.php');

    //lookup all links from the xml file if length of q>0
    if (strlen($event_id)>0) {
          $query = $connect->query("
			       INSERT INTO joinevents(event_id, usr_id) VALUES ($event_id, $sessionUser)
		   ");
          require_once('connect.php');

           $event_query = $connect->query("
			       SELECT event_cat FROM events where event_id = $event_id 
		   ");

           while($event = $event_query->fetch()){
			   require_once('connect.php');

	           $query = $connect->query("
	                UPDATE interests 
	                SET interest_score = interest_score+1
	                WHERE interest_id = " . $event["event_cat"] ."
	            ");
	       }
      }

      header( "Location: /view.php?event_id=$event_id#Participants" ) ;   
?>