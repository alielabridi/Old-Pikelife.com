<?php

	require_once("connect.php");
	$participants_load = htmlentities(strip_tags($_POST['participants_load'])) * 20;
    $event_id = htmlentities(strip_tags($_POST['event_id']));

    $participants_query = $connect->query("
                SELECT * FROM joinevents
                JOIN userapps U ON U.Facebook_ID = joinevents.usr_id
                where event_id = ".$event_id."
                LIMIT $participants_load, 20
            ");

            while($participant = $participants_query->fetch()){ ?>

            <div class="rp_col">
                <?php if(isset($_SESSION['usr_id']) && $participant["Facebook_ID"] == $sessionUser){
                    $piked = true;
                } ?>

                <?php if(isset($_SESSION['usr_id']) && $event["Facebook_ID"] == $sessionUser){ ?>
                    <a href="/userProfile.php?user_id=<?php echo $participant["Facebook_ID"]; ?>"><div style="text-align:center" class="small_thumb"><img src="/include/Profil_pictures/<?php echo $participant["picture_link"]; ?>" title="<?php echo $participant["usr_lname"] . ' ' . $participant["usr_fname"]; ?>"  /></a><a href="/deleteParticipants.php?event_id=<?php echo $event_id; ?>&amp;joinevent_id=<?php echo $participant["joinevent_id"]; ?>">remove</a></div>
                <?php }else{ ?>
                    <a href="/userProfile.php?user_id=<?php echo $participant["Facebook_ID"]; ?>"><div class="small_thumb"><img src="/include/Profil_pictures/<?php echo $participant["picture_link"]; ?>" title="<?php echo $participant["usr_lname"] . ' ' . $participant["usr_fname"]; ?>"  /></div></a>
                <?php } ?> 
            </div>

        <?php } ?>