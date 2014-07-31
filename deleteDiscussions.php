<?php
    session_start();
    if(isset($_SESSION['usr_id'])){
        $sessionUser = $_SESSION['usr_id'];
    }else{
        header( "Location: /") ;  
    }
    
    $event_id=$_GET["event_id"];
    $feedback_id=$_GET["feedback_id"];

    require_once('connect.php');

    //lookup all links from the xml file if length of q>0
    if (strlen($event_id)>0 && strlen($feedback_id)>0) {
          $query = $connect->query("
			       DELETE FROM feedback WHERE feedback_id = $feedback_id
		      ");
      }

      header( "Location: /view.php?event_id=$event_id#Discussions" ) ;   
?>