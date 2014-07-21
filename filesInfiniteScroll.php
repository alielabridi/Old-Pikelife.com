<?php
	session_start();
    $sessionUser = $_SESSION['usr_id'];

	require_once("connect.php");
	$files_load = htmlentities(strip_tags($_POST['files_load'])) * 5;
    $event_id = htmlentities(strip_tags($_POST['event_id']));

    $files_query = $connect->query("
                SELECT * FROM files
                left join userapps U on U.Facebook_ID = usr_upload
                where file_event_id = ".$event_id."
                LIMIT $files_load, 10
    ");

            while($file = $files_query->fetch()){ ?>
                <div class="rp_col" style="width:100%; height:100px">
                    <a href="/img/upload/files/<?php echo $file["file_link"]; ?>" target="_blank"><div class="pdf_small_thumb"><?php echo $file["file_name"]; ?><br><strong>Uploaded by <?php echo $file["usr_lname"] . ' ' . $file["usr_fname"]; ?></strong><br><em>click to view</em></div></a>
                </div>
            <?php } ?>