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
    $event_id = $_GET["event_id"];
    $q =  mysql_real_escape_string($q);
    require_once('connect.php');

    //lookup all links from the xml file if length of q>0
    if (strlen($q)>0) {
          $hint="";

          $invitations_query = $connect->query("

              SELECT * 
              FROM  friends 
              JOIN userapps U ON U.Facebook_ID = friends.user_other
              WHERE user_me = $sessionUser and U.usr_lname LIKE '%$q%' and friends.user_other NOT IN (SELECT notification_user from notification where event_id = $event_id)
            ");

           while($invitation = $invitations_query->fetch()){
                $usr_lname = $invitation["usr_lname"];
                $usr_fname = $invitation["usr_fname"];
                $picture_link = $invitation["picture_link"];
                $Facebook_ID = $invitation["Facebook_ID"];
                $picture_link = $invitation["picture_link"];
                
                $hint = $hint . "<li ><img alt='' src='/include/Profil_pictures/$picture_link' class='avatar avatar-50 photo' height='50' width='50' />";
                $hint = $hint . "<p><cite>$usr_lname $usr_fname</cite><br><a href='/pike_invitation.php?event_id=$event_id&amp;user_invited=$Facebook_ID' style='width:55%;margin-top:10px;text-align:center;' class='button blue small'>Invite</a><div class='clear'><br></li>";
                         
            }
      }else{
          $hint="";

          $invitations_query = $connect->query("
              SELECT * 
              FROM  friends 
              JOIN userapps U ON U.Facebook_ID = friends.user_other
              WHERE user_me = $sessionUser and friends.user_other NOT IN (SELECT notification_user from notification where event_id = $event_id)
          ");

           while($invitation = $invitations_query->fetch()){
                $usr_lname = $invitation["usr_lname"];
                $usr_fname = $invitation["usr_fname"];
                $picture_link = $invitation["picture_link"];
                $Facebook_ID = $invitation["Facebook_ID"];

                $hint = $hint . "<li ><img alt='' src='/include/Profil_pictures/$picture_link' class='avatar avatar-50 photo' height='50' width='50' />";
                $hint = $hint . "<p><cite>$usr_lname $usr_fname</cite><br><a href='/pike_invitation.php?event_id=$event_id&amp;user_invited=$Facebook_ID' style='width:55%;margin-top:10px;text-align:center;' class='button blue small'>Invite</a><div class='clear'><br></li>";
                         
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