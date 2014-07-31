<?php
	require_once("connect.php");
	$pictures_load = htmlentities(strip_tags($_POST['pictures_load'])) * 5;
    $event_id = htmlentities(strip_tags($_POST['event_id']));

    $pictures_query = $connect->query("
                SELECT * FROM picture
                left join userapps U on U.Facebook_ID = usr_upload
                where event_id = ".$event_id."
                LIMIT $pictures_load, 20
            ");

            while($picture = $pictures_query->fetch()){ ?>
                <div class="rp_col">
                    <div class="small_thumb" style="text-align:center"><a href="/img/upload/pictures/<?php echo $picture["pic_link"]; ?>" class="icon view fancybox"><img src="/img/upload/pictures/<?php echo $picture["pic_link"]; ?>"/></a><em>Uploaded by<br><strong><?php echo $picture["usr_lname"] . ' '. $picture["usr_fname"]; ?></strong></em>
                        <?php if(isset($_SESSION['usr_id']) && ($event["Facebook_ID"] == $sessionUser || $picture["Facebook_ID"] == $sessionUser)){ ?>
                            <br><em><a style="color:red" href="/deleteEventPicture.php?event_id=<?php echo $event_id; ?>&amp;picture_id=<?php echo $picture["picture_id"]; ?>">remove</a></em>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>