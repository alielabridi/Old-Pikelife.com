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

          $notifications_query = $connect->query("
              SELECT * 
              FROM  notification 
              WHERE notification_user = $sessionUser and notification_title LIKE '%$q%'
          ");

           while($notification = $notifications_query->fetch()){
              $event_id = $notification['event_id'];
              $notification_image = $notification['notification_image'];
              $event_id = $notification['event_id'];
              $notification_title = $notification['notification_title'];
              $notification_date = $notification['notification_date'];
              $notification_time = $notification['notification_time'];

              $hint = $hint. "<li>";
              if( $notification['notification_type'] == "invitation") {
                  $hint = $hint."<a href='/view.php?event_id=$event_id' class='small_thumb'>";
                  $hint = $hint."<img src='images/notif_images/$notification_image' width='50' height='50'></a>";
                  $hint = $hint."<a href='/view.php?event_id=$event_id' class='title'>$notification_title</a><em>$notification_date - $notification_time</em><div class='clear'></div></a>"; 
              }elseif ($notification['notification_type'] == "chat") {
                  $hint = $hint . "<a href='#' class='small_thumb'>";
                  $hint = $hint . "<img src='images/notif_images/$notification_image' width='50' height='50'></a> ";
                  $hint = $hint . "<a href='#' class='title'>$notification_title</a><em>$notification_date - $notification_time</em><div class='clear'></div></a>";
              }else{
                  $hint = $hint . "<a href='/view.php?event_id=$event_id' class='small_thumb'>";
                  $hint = $hint . "<img src='images/notif_images/$notification_image' width='50' height='50'></a>";
                  $hint = $hint . "<a href='/view.php?event_id=$event_id' class='title'>$notification_title</a><em>$notification_date - $notification_time</em><div class='clear'></div></a>";
               }
                  $hint = $hint . "</li>";

            }
      }else{
          $hint="";

          $notifications_query = $connect->query("
              SELECT * 
              FROM  notification 
              WHERE notification_user = $sessionUser
          ");

           while($notification = $notifications_query->fetch()){
              $event_id = $notification['event_id'];
              $notification_image = $notification['notification_image'];
              $event_id = $notification['event_id'];
              $notification_title = $notification['notification_title'];
              $notification_date = $notification['notification_date'];
              $notification_time = $notification['notification_time'];
              
              $hint = $hint. "<li>";
              if( $notification['notification_type'] == "invitation") {
                  $hint = $hint."<a href='/view.php?event_id=$event_id' class='small_thumb'>";
                  $hint = $hint."<img src='images/notif_images/$notification_image' width='50' height='50'></a>";
                  $hint = $hint."<a href='/view.php?event_id=$event_id' class='title'>$notification_title</a><em>$notification_date - $notification_time</em><div class='clear'></div></a>";
              }elseif ($notification['notification_type'] == "chat") {
                  $hint = $hint . "<a href='#' class='small_thumb'>";
                  $hint = $hint . "<img src='images/notif_images/$notification_image' width='50' height='50'></a> ";
                  $hint = $hint . "<a href='#' class='title'>$notification_title</a><em>$notification_date - $notification_time</em><div class='clear'></div></a>";
              }else{
                  $hint = $hint . "<a href='/view.php?event_id=$event_id' class='small_thumb'>";
                  $hint = $hint . "<img src='images/notif_images/$notification_image' width='50' height='50'></a>";
                  $hint = $hint . "<a href='/view.php?event_id=$event_id' class='title'>$notification_title</a><em>$notification_date - $notification_time</em><div class='clear'></div></a>";
               }
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