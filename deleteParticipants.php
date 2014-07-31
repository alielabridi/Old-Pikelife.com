<?php
  session_start();
    if(isset($_SESSION['usr_id'])){
        $sessionUser = $_SESSION['usr_id'];
    }else{
        header( "Location: /") ;  
    }
    
    $joinevent_id=$_GET["joinevent_id"];
    $event_id=$_GET["event_id"];

    require_once('connect.php');

    //lookup all links from the xml file if length of q>0
    if (strlen($event_id)>0 && strlen($joinevent_ids)>0) {
          $query = $connect->query("
			       DELETE FROM joinevents WHERE joinevent_id = $joinevent_id
		      ");
      }

      header( "Location: /view.php?event_id=$event_id#Participants" ) ;   
?>