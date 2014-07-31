<?php

	require_once("connect.php");
	$discussions_load = htmlentities(strip_tags($_POST['discussions_load'])) * 10;
    $event_id = htmlentities(strip_tags($_POST['event_id']));

    $feedbacks_query = $connect->query("
                                SELECT * FROM feedback
                                JOIN userapps U ON U.Facebook_ID = feedback.feedback_user_id
                                where feedback.feedback_event_id = ".$event_id."
                                ORDER BY feedback_time DESC
                                LIMIT $discussions_load, 10
                            ");

                            while($feedback = $feedbacks_query->fetch()){ ?>
                                <li><img src='/include/Profil_pictures/<?php echo $feedback["picture_link"]; ?>' class='avatar avatar-50 photo' height='50' width='50' /><p><cite><?php echo $feedback["usr_lname"] . ' '. $feedback["usr_fname"]; ?>:</cite> <em><?php echo $feedback["feedback_time"]; ?></em><br> <a href="#"><?php echo $feedback["feedback_message"]; ?></a></p>
                                <?php if(isset($_SESSION['usr_id']) && ($event["Facebook_ID"] == $sessionUser || $feedback["feedback_user_id"] == $sessionUser)){ ?>
                                    <em><a style="color:red" href="/deleteDiscussions.php?event_id=<?php echo $event_id; ?>&amp;feedback_id=<?php echo $feedback["feedback_id"]; ?>">remove</a></em>
                                <?php } ?> 
                                    <div class="clear"></div></li>
               <?php } ?>