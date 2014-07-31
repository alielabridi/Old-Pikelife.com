<?php
    
    $event_id=$_GET["event_id"];
    $picture_id=$_GET["picture_id"];

    require_once('connect.php');

    //lookup all links from the xml file if length of q>0
    if (strlen($event_id)>0 && strlen($picture_id)>0) {
          $query = $connect->query("
			       DELETE FROM picture WHERE picture_id = $picture_id
		      ");

          $joinevent_query = $connect->query("
            SELECT usr_id FROM joinevents where event_id = $event_id and usr_id != $sessionUser
          ");
      }

      header( "Location: /view.php?event_id=$event_id#Pictures" ) ;   
?>