<?php

    session_start();
    if(isset($_SESSION['usr_id'])){
        $sessionUser = $_SESSION['usr_id'];
    }else{
        header( "Location: /") ;  
    }

$load = htmlentities(strip_tags($_POST['load'])) * 10;

$interest = htmlentities(strip_tags($_POST['interest']));

$year = htmlentities(strip_tags($_POST['year']));
$month = htmlentities(strip_tags($_POST['month']));
$day = htmlentities(strip_tags($_POST['day']));

    require_once('connect.php');
    if($interest != -1){
        $inter = $interest;

        $events_query = $connect->query("
            SELECT *
            FROM events
            JOIN userapps U ON U.Facebook_ID = events.usr_create
            LEFT JOIN interests I ON I.interest_id = events.event_cat
            WHERE event_cat = $inter
            and (events.usr_create In(  SELECT friends.user_other 
                                        FROM  friends 
                                        WHERE user_me = $sessionUser)
                 OR events.usr_create = $sessionUser)
            and event_type != 'Secret'
            or (event_type = 'Secret' and usr_create = $sessionUser)

            ORDER BY event_date, event_time DESC
            LIMIT $load, 10

        ");
    }                                  
    
    else{
        $events_query = $connect->query("
            SELECT *
            FROM events
            JOIN userapps U ON U.Facebook_ID = events.usr_create
            LEFT JOIN interests I ON I.interest_id = events.event_cat
            WHERE event_date = '". $year ."-". $month ."-". $day ."'
            AND (events.usr_create In(SELECT friends.user_other 
                                      FROM  friends 
                                      WHERE user_me = $sessionUser)
            OR events.usr_create = $sessionUser)
            and event_type != 'Secret'
            or (event_type = 'Secret' and usr_create = $sessionUser)

            ORDER BY event_date, event_time DESC

            LIMIT $load, 10
        "); 
    }

                                
                                while(!is_null($events_query) && $event = $events_query->fetch()){ ?>                                                                                    
                                        <div class="post_col">
                                            <div class="post_item white_box">
                                                <div class="large_thumb thumb_hover">
                                                    
                                                        <div class="icon_bar for_link">
                                                            <a href="single.html" class="icon link"></a> 
                                                        </div>
                                                        <div class="icon_bar for_view">
                                                            <a href="/img/upload/events/<?php echo $event['event_pic']; ?>" class="icon view fancybox"></a> 
                                                        </div>
                                                        
                                                        <div class="img_wrapper"><img src="/img/upload/events/<?php echo $event['event_pic']; ?>"></div>
                                                </div>
                                            
                                                                        
                                                <h3 class="post_item_title "> <a href="/view.php?event_id=<?php echo $event['event_id']; ?>"><?php echo $event['event_name']; ?></a></h3>
                                                
                                                <div class="post_item_inner">

                                                    <div class="post_meta">
                                                        <span class="user">by <a href="#"><?php echo $event['usr_lname'] . ' '. $event['usr_fname']; ?></a></span> 
                                                        <span class="date"><?php echo $event['event_date']; ?></span><br><br>
                                                        <span class="time"><?php echo $event['event_time']; ?></span>
                                                        <span class="cats"><?php echo $event['interest_name']; ?></span><br><br>
                                                        <span class="place"><?php echo $event['event_place']; ?> </span>
                                                        
                                                    </div>

                                                    <p></p>
                                                    <?php if($event['event_type'] != "Private" || ($event['event_type'] == "Private" && $event['usr_create'] == $sessionUser)){
                                                        if($event['Facebook_ID'] != $sessionUser){
                                                            $participated_query = $connect->query("
                                                                SELECT count(*) AS participanted FROM joinevents
                                                                where event_id = ".$event['event_id']." and usr_ID = ". $sessionUser . "
                                                            ");

                                                            if($participanted = $participated_query->fetch()){
                                                                if($participanted["participanted"] > 0){?>
                                                                    <span style="color:green;border:2px solid green;padding:10px 10px 10px 10px">Piked</span>
                                                                <?php }else{ ?>
                                                                    <a href="/joinEvents.php?event_id=<?php echo $event['event_id']; ?>" class="button green">Pike</a>
                                                            <?php }
                                                                }
                                                            }else{ ?>
                                                                <a href="/modify.php?event_id=<?php echo $event['event_id']; ?>" class="button green">Modify</a>
                                                                <a href="/delete.php?event_id=<?php echo $event['event_id']; ?>" class="button red">End it</a>
                                                        

                                                            <?php } }?>                                            
                                                </div>
                                        
                                        </div>
                                    </div>
<?php } ?>