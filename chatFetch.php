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

          $contact_query = $connect->query("
              SELECT * 
              FROM chat
              JOIN userapps U1 ON U1.Facebook_ID = chat.chat_user_receiver
              JOIN userapps U2 ON U2.Facebook_ID = chat.chat_user_sender
              WHERE chat_user_sender =$sessionUser
              AND chat_user_receiver =$q
              UNION 
              SELECT * 
              FROM chat
              JOIN userapps U3 ON U3.Facebook_ID = chat.chat_user_receiver
              JOIN userapps U4 ON U4.Facebook_ID = chat.chat_user_sender
              WHERE chat_user_sender =$q
              AND chat_user_receiver =$sessionUser
              ORDER BY chat_time DESC 
          ");

           while($contact = $contact_query->fetch()){
              $usr_lname = $contact["usr_lname"];
              $usr_fname = $contact["usr_fname"];
              $chat_message = $contact["chat_message"];
              $chat_time = $contact["chat_time"];

              $hint = $hint . "<li ><img alt='' src='http://1.gravatar.com/avatar/5bea567fcf9dd1022d9224e07bf194a5?s=50&amp;d=http%3A%2F%2F1.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D50&amp;r=G' class='avatar avatar-50 photo' height='50' width='50' />";
              $hint = $hint . "<p><cite>$usr_lname $usr_fname</cite><br>";
              $hint = $hint . "<em>$chat_time</em><br/>";
              $hint = $hint . "$chat_message</p><div class='clear'></div></li>";
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