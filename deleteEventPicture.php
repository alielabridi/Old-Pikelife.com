<?php
    
    $event_id=$_GET["event_id"];
    $picture_id=$_GET["picture_id"];

    require_once('connect.php');

    //lookup all links from the xml file if length of q>0
    if (strlen($event_id)>0 && strlen($picture_id)>0) {
          $query = $connect->query("
			       DELETE FROM picture WHERE picture_id = $picture_id
		      ");
      }

      header( "Location: /view.php?event_id=$event_id#Pictures" ) ;   
?>