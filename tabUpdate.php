<?php

    session_start();
    $sessionUser = $_SESSION['usr_id'];

    $hint = "";
       
    require_once('connect.php');
    $newUpdate_query = $connect->query("
        SELECT count(*) as new_chat from friends where sent_chat = 'yes' and user_me = $sessionUser
    ");

    if($newUpdate = $newUpdate_query->fetch()){ 
        if($newUpdate["new_chat"] > 0){
            $hint = $hint = "<h3 class='widget_title'>Chat<span style='background-color:red; padding:1px 3px 1px 3px; margin-left:4px; color: white;border-radius: 10px;border-color: rgb(10, 10, 10);box-shadow: 2px 2px 2px #888888;'>". $newUpdate["new_chat"] ."</span></a></h3>";
        }else{
            $hint = $hint = "<h3 class='widget_title'><a href='#comment_tab' id='notif_tab'>Friends</a></h3>";
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