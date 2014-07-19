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
              FROM  friends 
              JOIN userapps U ON U.Facebook_ID = friends.user_other
              WHERE user_me = $sessionUser and usr_lname LIKE '%$q%'
              ORDER BY last_chat DESC
          ");

           while($contact = $contact_query->fetch()){
              $usr_lname = $contact["usr_lname"];
              $usr_fname = $contact["usr_fname"];
              $usr_id = $contact["user_other"];
              $picture_link = $contact["picture_link"];

              if($contact['sent_chat'] == "yes"){
                $hint = $hint . "<li style='background-color:rgb(255, 226, 226)'>";
              }else{
                $hint = $hint . "<li>";
              }

              $hint = $hint . "<img alt='' src='/include/Profil_pictures/$picture_link' class='avatar avatar-50 photo' height='50' width='50' />";
              $hint = $hint . "<p><cite>$usr_lname $usr_fname</cite><br>";
              $hint = $hint . "<em style='cursor:pointer' onclick='chatResult($usr_id)'>click to view conversation</em></p><div class='clear'></div></li>";
            }
      }else{
          $hint="";

          $contact_query = $connect->query("
              SELECT * 
              FROM  friends 
              JOIN userapps U ON U.Facebook_ID = friends.user_other
              WHERE user_me =$sessionUser
              ORDER BY last_chat DESC
          ");

           while($contact = $contact_query->fetch()){
              $usr_lname = $contact["usr_lname"];
              $usr_fname = $contact["usr_fname"];
              $usr_id = $contact["user_other"];
              $picture_link = $contact["picture_link"];

              if($contact['sent_chat'] == "yes"){
                $hint = $hint . "<li style='background-color:rgb(255, 226, 226)'>";
              }else{
                $hint = $hint . "<li>";
              }
              

              $hint = $hint . "<img alt='' src='/include/Profil_pictures/$picture_link' class='avatar avatar-50 photo' height='50' width='50' />";
              $hint = $hint . "<p><cite>$usr_lname $usr_fname</cite><br>";
              $hint = $hint . "<em style='cursor:pointer' onclick='chatResult($usr_id)'>click to view conversation</em></p><div class='clear'></div></li>";
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