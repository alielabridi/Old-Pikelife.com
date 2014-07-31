<?php
    session_start();
    if(isset($_SESSION['usr_id'])){
        $sessionUser = $_SESSION['usr_id'];
    }else{
        header( "Location: /") ;  
    }
$user_id = $_GET['user_id'];

    require_once('connect.php');

    //lookup all links from the xml file if length of q>0
    if (strlen($user_id)>0) {
          $query = $connect->query("
          		   UPDATE friends
          		   SET friend_request= 'Friends' WHERE user_me = $user_id and user_other = $sessionUser
		   ");
           $query = $connect->query("
			       INSERT INTO friends (user_me, user_other, friend_request) 
			       VALUES ($sessionUser, $user_id, 'Friends')
		   ");

           $user_joined = $connect->query("
                SELECT usr_lname, usr_fname, picture_link FROM userapps where Facebook_ID = $sessionUser 
            ");

            $usrJoined = $user_joined->fetch();    

           $query = $connect->query("
            INSERT INTO notification
            (notification_title, notification_user, notification_image, sender_id, notification_type) 
            VALUES ('". $usrJoined["usr_lname"] . " ". $usrJoined["usr_fname"] ." and you are now friends ' ,$user_id,'". $usrJoined["picture_link"] ."', $sessionUser, 'User')
          ");
      }

      header( "Location: /userProfile.php?user_id=$user_id" ) ;   
?>