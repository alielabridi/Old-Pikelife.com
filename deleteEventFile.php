<?php
    
    $event_id=$_GET["event_id"];
    $file_id=$_GET["file_id"];

    require_once('connect.php');

    //lookup all links from the xml file if length of q>0
    if (strlen($event_id)>0 && strlen($file_id)>0) {
          $query = $connect->query("
			       DELETE FROM files WHERE file_id = $file_id
		      ");
      }

      header( "Location: /view.php?event_id=$event_id#Files" ) ;   
?>