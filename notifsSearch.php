<?php

    session_start();
    $sessionUser = $_SESSION['usr_id'];
    
    $xmlDoc=new DOMDocument();

    //get the q parameter from URL
    $q=$_GET["q"];

    require_once('connect.php');

    //lookup all links from the xml file if length of q>0
    if (strlen($q)>0) {
          $hint="";
          
          $notification_query = $connect->query("
            SELECT * 
            FROM  notification 
            WHERE notification_user =$sessionUser and notification_title LIKE '%$q%'
            ORDER BY notification_time DESC
          ");

          while($notification = $notification_query->fetch()){
            if($notification['notification_status'] == "new"){
              $hint = $hint . "<li style='background-color:rgb(255, 226, 226)'>";
            }else{
              $hint = $hint . "<li>";
            }
                $hint = $hint . "<a href='/notificationUpdate.php?event_id=". $notification['event_id'] ."' class='small_thumb'>";
                $hint = $hint . "<img src='img/upload/events/" . $notification['notification_image'] ."' width='50' height='50'>";
                $hint = $hint . "</a>";
                $hint = $hint . "<a href='/notificationUpdate.php?event_id=". $notification['event_id'] ."' class='title'>". $notification['notification_title'] . "</a><em>". $notification['notification_time'] . "</em><div class='clear'></div></a>"; 
                $hint = $hint . "</li>";
            }
            }else{
          $hint="";
          
          $notification_query = $connect->query("
            SELECT * 
            FROM  notification 
            WHERE notification_user =$sessionUser
            ORDER BY notification_time DESC
          ");

          while($notification = $notification_query->fetch()){
            if($notification['notification_status'] == "new"){
              $hint = $hint . "<li style='background-color:rgb(255, 226, 226)'>";
            }else{
              $hint = $hint . "<li>";
            }
                $hint = $hint . "<a href='/notificationUpdate.php?event_id=". $notification['event_id'] ."' class='small_thumb'>";
                $hint = $hint . "<img src='img/upload/events/" . $notification['notification_image'] ."' width='50' height='50'>";
                $hint = $hint . "</a>";
                $hint = $hint . "<a href='/notificationUpdate.php?event_id=". $notification['event_id'] ."' class='title'>". $notification['notification_title'] . "</a><em>". $notification['notification_time'] . "</em><div class='clear'></div></a>"; 
                $hint = $hint . "</li>";
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