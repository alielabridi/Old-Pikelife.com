<?php

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
                    <div class="pdf_small_thumb"><?php echo $file["file_name"]; ?><br><strong>Uploaded by <?php echo $file["usr_lname"] . ' ' . $file["usr_fname"]; ?></strong><br><a href="/img/upload/files/<?php echo $file["file_link"]; ?>" target="_blank">
                    <?php if($piked == 1){ ?>
                        <em style="color:blue">view</em>
                    <?php } ?>
                    </a>
                    <?php if(isset($_SESSION['usr_id'])&& ($event["Facebook_ID"] == $sessionUser || $file["Facebook_ID"] == $sessionUser)){ ?>
                        <br><em><a style="color:red" href="/deleteEventFile.php?event_id=<?php echo $event_id; ?>&amp;file_id=<?php echo $file["file_id"]; ?>">remove</a></em>
                    <?php } ?>
                    </div>
                </div>
            <?php } ?>