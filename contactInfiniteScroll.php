<?php


    session_start();
    $sessionUser = $_SESSION['usr_id'];
    
    require_once("connect.php");
    $contact_load = htmlentities(strip_tags($_POST['contact_load'])) * 5;

    $contact_query = $connect->query("
        SELECT * 
        FROM  friends 
        JOIN userapps U ON U.Facebook_ID = friends.user_other
        WHERE user_me =$sessionUser
        ORDER BY last_chat DESC
        LIMIT $contact_load, 5
    ");

    while($contact = $contact_query->fetch()){?>
        <?php if($contact['sent_chat'] == "yes"){ ?>
        	<li style="background-color:rgb(255, 226, 226)">
        <?php }else{ ?>
            <li >
        <?php } ?>
                <img alt='' src='/include/Profil_pictures/<?php echo $contact["picture_link"]; ?>' class='avatar avatar-50 photo' height='50' width='50' />
            <p>
                <cite><?php echo $contact["usr_lname"]; ?> <?php echo $contact["usr_fname"]; ?></cite><br>
                <em style="cursor:pointer" onclick="chatResult(<?php echo $contact["user_other"]; ?>)">click to view conversation</em>
            </p>
        <div class="clear"></div>
        </li>
<?php } ?>