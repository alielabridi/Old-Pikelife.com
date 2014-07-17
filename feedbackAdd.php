<?php

    session_start();
    $sessionUser = $_SESSION['usr_id'];

    $xmlDoc=new DOMDocument();

    //get the q parameter from URL
    $q=$_GET["q"];
    $event_id=$_GET["event_id"];

    require_once('connect.php');


    //lookup all links from the xml file if length of q>0
    if (strlen($q)>0) {

            $query = $connect->query("
              INSERT INTO feedback (feedback_event_id, feedback_user_id, feedback_message) 
              VALUES ($event_id, $sessionUser, '$q')
      		  ");
            $feedbacks_query = $connect->query("
            SELECT * 
            FROM feedback
            JOIN userapps U ON U.Facebook_ID = feedback.feedback_user_id
            where feedback_event_id = $event_id
            ORDER BY feedback_time DESC
          ");
          
          $hint="";
          
          while($feedback = $feedbacks_query->fetch()){
            $picture_link = $feedback["picture_link"];
            $usr_lname = $feedback["usr_lname"];
            $usr_fname = $feedback["usr_fname"];
            $feedback_time = $feedback["feedback_time"];
            $feedback_message = $feedback["feedback_message"];

            $hint = $hint . "<li><img src='/include/Profil_pictures/$picture_link' class='avatar avatar-50 photo' height='50' width='50' /><p><cite>$usr_lname $usr_fname:</cite> <em>$feedback_time</em><br> <a href=''>$feedback_message</a></p><div class='clear'></div></li>";
          }
      }

      
     

    // Set output to "no suggestion" if no hint were found
    // or to the correct values
    if ($hint=="") {
      $response="";
    } else {
      $response=$hint;
    }

    //output the response
echo $response;     
?>