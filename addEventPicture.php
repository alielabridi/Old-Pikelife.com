        <?php

            session_start();
            if(isset($_SESSION['usr_id'])){
                $sessionUser = $_SESSION['usr_id'];
            }else{
                header( "Location: /") ;  
            }

            require_once('connect.php');

            $event_id=$_GET["event_id"];           

            // define variables and set to empty values
            $Error = "";
            $picture_name ="";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                $allowedExts = array("jpeg", "jpg", "png");
                $temp = explode(".", $_FILES["file"]["name"]);
                $extension = end($temp);

                if ((($_FILES["file"]["type"] == "image/jpeg")
                    || ($_FILES["file"]["type"] == "image/jpg")
                    || ($_FILES["file"]["type"] == "image/pjpeg")
                    || ($_FILES["file"]["type"] == "image/x-png")
                    || ($_FILES["file"]["type"] == "image/png"))
                    && in_array($extension, $allowedExts)) 
                {
                    $query = $connect->query("SELECT MAX(picture_id) AS Last_id FROM picture;");
                    $picture_id = $query->fetch();
                    $_FILES["file"]["name"] = $event_id . ($picture_id["Last_id"]+1) . '.' . $extension;

                if ($_FILES["file"]["error"] > 0) {
                    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
                } else {
                    move_uploaded_file($_FILES["file"]["tmp_name"],
                    "img/upload/pictures/" . $_FILES["file"]["name"] );
                    $picture_name = $_FILES["file"]["name"];
                }

                function test_input($data) {
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }

                $query = $connect->query("
                    INSERT INTO picture(event_id, pic_link, usr_upload) VALUES ($event_id, '$picture_name', $sessionUser)
                ");

                $joinevent_query = $connect->query("
                    SELECT usr_id FROM joinevents where event_id = $event_id and usr_id != $sessionUser
                ");

                $event_query = $connect->query("
                 SELECT event_name, event_pic FROM events where event_id = $event_id 
                ");

                $event = $event_query->fetch();

                while($joinevent = $joinevent_query->fetch()){
                    $query = $connect->query("
                        INSERT INTO notification
                            (notification_title, notification_user, notification_image, event_id, notification_type) 
                        VALUES ('a new picture added to this Pike " . $event["event_name"] ."', " . $joinevent["usr_id"] . ", '$event_id.jpg', $event_id, 'Event')
                    ");            
                }
            }

        

        header( "Location: /view.php?event_id=$event_id#Pictures") ;
        }
?>