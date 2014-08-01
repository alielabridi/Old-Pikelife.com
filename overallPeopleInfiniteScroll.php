<?php
        	session_start();
            if(isset($_SESSION['usr_id'])){
                $sessionUser = $_SESSION['usr_id'];
            }else{
                header( "Location: /") ;  
            }

        	require_once("connect.php");
        	$participants_load = htmlentities(strip_tags($_POST['participants_load'])) * 20;
            $search_query = htmlentities(strip_tags($_POST['search_query']));
            $search_query =  addslashes($search_query);
            
            $participants_query = $connect->query("
                SELECT * 
                FROM  userapps 
                WHERE usr_lname LIKE '%$search_query%' OR usr_fname LIKE '%$search_query%'
                ORDER BY usr_lname, usr_fname DESC
                LIMIT 0, 100
            ");

            while($participant = $participants_query->fetch()){ ?>

                <div class="rp_col">
                    <a href="/userProfile.php?user_id=<?php echo $participant["Facebook_ID"]; ?>"><div class="small_thumb"><img src="/include/Profil_pictures/<?php echo $participant["picture_link"]; ?>" title="<?php echo $participant["usr_lname"] . ' ' . $participant["usr_fname"]; ?>"  /></div></a>
                </div>

            <?php } ?>