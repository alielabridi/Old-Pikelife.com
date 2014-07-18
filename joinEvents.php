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
      }

      header( "Location: /view.php?event_id=$event_id" ) ;   
?>