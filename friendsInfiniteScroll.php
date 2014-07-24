<?php
	session_start();
    $sessionUser = $_SESSION['usr_id'];

	require_once("connect.php");
	$participants_load = htmlentities(strip_tags($_POST['participants_load'])) * 20;
    $user_id = htmlentities(strip_tags($_POST['user_id']));

    $participants_query = $connect->query("
                SELECT * 
                FROM  friends 
                JOIN userapps U ON U.Facebook_ID = friends.user_other
                WHERE user_me = $user_id AND friend_request = 'Friends'
                ORDER BY usr_lname DESC
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