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

    $search_query =  mysql_real_escape_string($search_query);
    
    $pikes_query = $connect->query("
                SELECT * 
                FROM  events 
                WHERE event_name LIKE '%$search_query%' and event_type != 'Secret'
                ORDER BY event_name DESC
                LIMIT 0, 100
            ");

            while($picture = $pikes_query->fetch()){ ?>
                <div class="rp_col">
                    <div class="small_thumb" style="text-align:center"><a href="/view.php?event_id=<?php echo $picture["event_id"]; ?>"><img src="/img/upload/events/<?php echo $picture["event_pic"]; ?>"/></a><em><strong><?php echo $picture["event_name"]; ?></strong></em></div>
                </div>
            <?php } ?>