<?php

session_start();
if(isset($_SESSION['usr_id'])){
    $sessionUser = $_SESSION['usr_id'];
}else{
    header( "Location: /") ;
}
    
    require_once("connect.php");
    $contact_load = htmlentities(strip_tags($_POST['contact_load'])) * 5;
    $event_id = htmlentities(strip_tags($_POST['event_id']));

   $notification_query = $connect->query("
        SELECT COUNT(*) notif_num 
        FROM  friends 
        JOIN userapps U ON U.Facebook_ID = friends.user_other
        WHERE user_me = $sessionUser and friends.user_other NOT IN (SELECT notification_user from notification where event_id = $event_id)
        and friends.user_other NOT IN (SELECT joinevents.usr_id from joinevents where event_id = $event_id)
    ");

    $notification = $notification_query->fetch();

    if($contact_load <= $notification["notif_num"]){
        $invitations_query = $connect->query("
            SELECT * 
            FROM  friends 
            JOIN userapps U ON U.Facebook_ID = friends.user_other
            WHERE user_me = $sessionUser and friends.user_other NOT IN (SELECT notification_user from notification where event_id = $event_id)
            and friends.user_other NOT IN (SELECT joinevents.usr_id from joinevents where event_id = $event_id)
            LIMIT $contact_load, 5
        ");

        while($invitation = $invitations_query->fetch()){?>
            <li ><img alt='' src='/include/Profil_pictures/<?php echo $invitation["picture_link"]; ?>' class='avatar avatar-50 photo' height='50' width='50' />
                <p><cite><?php echo $invitation["usr_lname"] . ' ' . $invitation["usr_fname"] ?></cite><br><a href="/pike_invitation.php?event_id=<?php echo $event_id ?>&amp;user_invited=<?php echo $invitation["Facebook_ID"]; ?>" style="width:55%;margin-top:10px;text-align:center;" class="button blue small">Invite</a><div class='clear'><br></li>
        <?php }
        }
    ?>