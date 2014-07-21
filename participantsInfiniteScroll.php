<?php
	session_start();
    $sessionUser = $_SESSION['usr_id'];

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
                <?php if($participant["Facebook_ID"] == $sessionUser){
                    $piked = true;
                } ?>
                    <div class="small_thumb"><img src="/include/Profil_pictures/<?php echo $participant["picture_link"]; ?>" title="<?php echo $participant["usr_lname"] . ' ' . $participant["usr_fname"]; ?>"  /></div>
            </div>

        <?php } ?>