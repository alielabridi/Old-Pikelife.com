<?php
    
    $event_id=$_GET["event_id"];

    require_once('connect.php');

    //lookup all links from the xml file if length of q>0
    if (strlen($event_id)>0) {
          $query = $connect->query("
			       DELETE FROM events WHERE $event_id = event_id
		      ");
      }

      header( 'Location: /events.php' ) ;   
?>