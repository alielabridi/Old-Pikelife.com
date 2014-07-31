<?php
	session_start();
    if(isset($_SESSION['usr_id'])){
        $sessionUser = $_SESSION['usr_id'];
    }else{
        header( "Location: /") ;  
    }

	require_once("connect.php");
	$pikes_load = htmlentities(strip_tags($_POST['pikes_load'])) * 10;
    $notification_query = $connect->query("
        SELECT COUNT(*) notif_num 
        FROM  joinevents
            JOIN EVENTS E ON E.event_id = joinevents.event_id
            WHERE usr_id =$sessionUser
        
            UNION

            SELECT COUNT(*) notif_num  FROM  events
            WHERE usr_create =$sessionUser
    ");

    $notif_num = 0;
    while ($notification = $notification_query->fetch()) {
        $notif_num += $notification["notif_num"];
    }

    if($pikes_load <= $notif_num ){
        $pikes_query = $connect->query("
            SELECT E.event_id ,E.event_pic,E.event_name,E.event_date, E.event_time FROM  joinevents
            JOIN EVENTS E ON E.event_id = joinevents.event_id
            WHERE usr_id =$sessionUser
        
            UNION

            SELECT event_id,event_pic,event_name,event_date, event_time FROM  events
            WHERE usr_create =$sessionUser
            ORDER BY event_date, event_time DESC
            
            LIMIT $pikes_load, 10
        ");

        while($pike = $pikes_query->fetch()){?>
            <li>
                <a href="/view.php?event_id=<?php echo $pike['event_id'] ?>" title="Praesent Et Urna Turpis Sadips" class="small_thumb">
                    <img src="img/upload/events/<?php echo $pike['event_pic'] ?>" width="50" height="50" alt="Praesent Et Urna Turpis Sadips">
                </a>
                <a href="/view.php?event_id=<?php echo $pike['event_id'] ?>" class="title"><?php echo $pike['event_name'] ?></a><em><?php echo $pike['event_date'] ?> - <?php echo $pike['event_time'] ?></em><div class="clear"></div>   
                </a>  
            </li>
    <?php } } ?>