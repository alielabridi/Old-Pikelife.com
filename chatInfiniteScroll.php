<?php

    session_start();
    $sessionUser = $_SESSION['usr_id'];

	require_once("connect.php");
	$chat_load = htmlentities(strip_tags($_POST['chat_load'])) * 10;
	$userSender = htmlentities(strip_tags($_POST['userSender']));

    $contact_query = $connect->query("
              SELECT * 
              FROM chat
              JOIN userapps U1 ON U1.Facebook_ID = chat.chat_user_receiver
              JOIN userapps U2 ON U2.Facebook_ID = chat.chat_user_sender
              WHERE chat_user_sender =$sessionUser
              AND chat_user_receiver =$userSender
              UNION 
              SELECT * 
              FROM chat
              JOIN userapps U3 ON U3.Facebook_ID = chat.chat_user_receiver
              JOIN userapps U4 ON U4.Facebook_ID = chat.chat_user_sender
              WHERE chat_user_sender =$userSender
              AND chat_user_receiver =$sessionUser
              ORDER BY chat_time DESC 
              LIMIT $chat_load, 10
          ");

           while($contact = $contact_query->fetch()){
              $usr_lname = $contact["usr_lname"];
              $usr_fname = $contact["usr_fname"];
              $chat_message = $contact["chat_message"];
              $chat_time = $contact["chat_time"];
              $picture_link = $contact["picture_link"];
             ?> 
              
              <li ><img alt='' src='/include/Profil_pictures/<?php echo $picture_link ?>' class='avatar avatar-50 photo' height='50' width='50' />
              <p><cite><?php echo $usr_lname . ' ' . $usr_fname; ?></cite><br>
              <em><?php echo $chat_time; ?></em><br/>
              <?php echo $chat_message; ?></p><div class='clear'></div></li>
           <?php } ?>