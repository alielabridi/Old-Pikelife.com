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

    require_once('connect.php');

    //lookup all links from the xml file if length of q>0
    if (strlen($q)>0) {
          $hint="";

          $pikes_query = $connect->query("
              SELECT E.event_id ,E.event_pic,E.event_name,E.event_date, E.event_time FROM  joinevents
              JOIN EVENTS E ON E.event_id = joinevents.event_id
              WHERE usr_id =$sessionUser and E.event_name LIKE '%$q%'
              UNION
              SELECT event_id,event_pic,event_name,event_date, event_time FROM  events
              WHERE usr_create =$sessionUser and event_name LIKE '%$q%'
              ORDER BY event_date, event_time DESC
          ");

           while($pike = $pikes_query->fetch()){
              $event_id = $pike['event_id'];
              $event_pic = $pike['event_pic'];
              $event_id = $pike['event_id'];
              $event_name = $pike['event_name'];
              $event_date = $pike['event_date'];
              $event_time = $pike['event_time'];

              $hint = $hint . "<li>";
              $hint = $hint . "<a href='/view.php?event_id=$event_id' class='small_thumb'>";
              $hint = $hint . "<img src='img/upload/events/$event_pic' width='50' height='50'></a>";
              $hint = $hint . "<a href='/view.php?event_id=$event_id' class='title'>$event_name</a><em>$event_date - $event_time</em><div class='clear'></div></a>";                        
              $hint = $hint . "</li>";
            }
      }else{
          $hint="";

          $pikes_query = $connect->query("
              SELECT E.event_id ,E.event_pic,E.event_name,E.event_date, E.event_time FROM  joinevents
              JOIN EVENTS E ON E.event_id = joinevents.event_id
              WHERE usr_id =$sessionUser
              UNION
              SELECT event_id,event_pic,event_name,event_date, event_time FROM  events
              WHERE usr_create =$sessionUser
              ORDER BY event_date, event_time DESC
          ");

           while($pike = $pikes_query->fetch()){
              $event_id = $pike['event_id'];
              $event_pic = $pike['event_pic'];
              $event_id = $pike['event_id'];
              $event_name = $pike['event_name'];
              $event_date = $pike['event_date'];
              $event_time = $pike['event_time'];

              $hint = $hint . "<li>";
              $hint = $hint . "<a href='/view.php?event_id=$event_id' class='small_thumb'>";
              $hint = $hint . "<img src='img/upload/events/$event_pic' width='50' height='50'></a>";
              $hint = $hint . "<a href='/view.php?event_id=$event_id' class='title'>$event_name</a><em>$event_date - $event_time</em><div class='clear'></div></a>";                        
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