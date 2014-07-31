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
            $file_name ="";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                $allowedExts = array("pdf", "ppt", "doc", "docx", "pptx", "rar");
                $temp = explode(".", $_FILES["file"]["name"]);
                $extension = end($temp);

                if (in_array($extension, $allowedExts)) 
                {
                    $query = $connect->query("SELECT MAX(file_id) AS Last_id FROM files;");
                    $file_id = $query->fetch();

                    $file_link = $event_id . ($file_id["Last_id"]+1) . '.' .$extension;

                if ($_FILES["file"]["error"] > 0) {
                    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
                } else {
                    move_uploaded_file($_FILES["file"]["tmp_name"],
                    "img/upload/files/" . $file_link);
                    $file_name = $_FILES["file"]["name"];
                }

                function test_input($data) {
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    $data =  mysql_real_escape_string($data);
                    return $data;
                }

                $file_name = test_input($file_name);
                
                $query = $connect->query("
                    INSERT INTO files(file_event_id, file_name, file_link, usr_upload) VALUES ($event_id, '$file_name', '$file_link', $sessionUser)
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
                        VALUES ('a new file added to this Pike " . $event["event_name"] ."', " . $joinevent["usr_id"] . ", '$event_id.jpg', $event_id, 'Event')
                    ");            
                }

                
                }
            }
        header( "Location: /view.php?event_id=$event_id#Files") ;
?>