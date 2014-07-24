<?php

	session_start();
    $sessionUser = $_SESSION['usr_id'];

	require_once("connect.php");
	$notifications_load = htmlentities(strip_tags($_POST['notifications_load'])) * 10;

    $notification_query = $connect->query("
        SELECT COUNT(*) notif_num 
        FROM  notification 
        WHERE notification_user =$sessionUser
    ");

    $notification = $notification_query->fetch();

    if($notifications_load <= $notification["notif_num"]){
        $notification_query = $connect->query("
            SELECT * 
            FROM  notification 
            WHERE notification_user =$sessionUser
            ORDER BY notification_time DESC
            LIMIT $notifications_load, 10
        ");

        while($notification = $notification_query->fetch()){
            if($notification['notification_status'] == "new"){ ?>
                <li style="background-color:rgb(255, 226, 226)">
            <?php }else{ ?>
                <li>
            <?php } ?>
    	            <a href="/notificationUpdate.php?event_id=<?php echo $notification['event_id'] ?>" class="small_thumb">
    	                <img src="img/upload/events/<?php echo $notification['notification_image'] ?>" width="50" height="50">
    	            </a>
    		        <a href="/notificationUpdate.php?event_id=<?php echo $notification['event_id'] ?>" class="title"><?php echo $notification['notification_title'] ?></a><em><?php echo $notification['notification_time'] ?></em><div class="clear"></div>   
    		        </a> 
               </li>
        <?php } 
    }
?>