<?php

    session_start();
    if(isset($_SESSION['usr_id'])){
        $sessionUser = $_SESSION['usr_id'];
    }else{
        header( "Location: /") ;  
    }

    $xmlDoc=new DOMDocument();

    //get the q parameter from URL
    $q=$_GET["q"];
    $event_id=$_GET["event_id"];
    
    $q =  mysql_real_escape_string($q);
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

            $joinevent_query = $connect->query("
              SELECT usr_id FROM joinevents where event_id = $event_id and usr_id != $sessionUser
            ");

            $user_add = $connect->query("
              SELECT usr_lname, usr_fname FROM userapps where Facebook_ID != $sessionUser
            ");

            $event_query = $connect->query("
             SELECT event_name, event_pic FROM events where event_id = $event_id 
            ");

            $event = $event_query->fetch();

            $UserAdd = $user_add->fetch();

            while($joinevent = $joinevent_query->fetch()){
              $query = $connect->query("
                INSERT INTO notification
                  (notification_title, notification_user, notification_image, event_id, notification_type) 
                VALUES ('" . $UserAdd["usr_lname"] . " " . $UserAdd["usr_fname"] . " said something in the Pike " . $event["event_name"] ."', " . $joinevent["usr_id"] . ", '$event_id.jpg', $event_id, 'Event')
            ");            
        }
          
          $hint="";
          
          while($feedback = $feedbacks_query->fetch()){
            $picture_link = $feedback["picture_link"];
            $usr_lname = $feedback["usr_lname"];
            $usr_fname = $feedback["usr_fname"];
            $feedback_time = $feedback["feedback_time"];
            $feedback_message = $feedback["feedback_message"];

            $hint = $hint . "<li><img src='/include/Profil_pictures/$picture_link' class='avatar avatar-50 photo' height='50' width='50' /><p><cite>$usr_lname $usr_fname:</cite> <em>$feedback_time</em><br> <a href='#''>$feedback_message</a></p>";
            if($feedback["feedback_user_id"] == $sessionUser){
              $hint = $hint . "<em><a style='color:red' href='/deleteDiscussions.php?event_id=$event_id&amp;feedback_id=" . $feedback["feedback_id"] . "''>remove</a></em>";
            }
              $hint = $hint . "<div class='clear'></div></li>";
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