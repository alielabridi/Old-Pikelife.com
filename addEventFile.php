        <?php
            session_start();
            $sessionUser = $_SESSION['usr_id'];

            require_once('connect.php');

            $event_id=$_GET["event_id"];           

            // define variables and set to empty values
            $Error = "";
            $file_name ="";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                $allowedExts = array("pdf");
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
                    return $data;
                }

                $query = $connect->query("
                    INSERT INTO files(file_event_id, file_name, file_link, usr_upload) VALUES ($event_id, '$file_name', '$file_link', $sessionUser)
                ");

                
                }
            }
        header( "Location: /view.php?event_id=$event_id#Files") ;
?>