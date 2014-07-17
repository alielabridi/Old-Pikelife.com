        <?php

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
                    $_FILES["file"]["name"] = ($picture_id["Last_id"]+1) . '.' . $extension;

                if ($_FILES["file"]["error"] > 0) {
                    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
                } else {
                    move_uploaded_file($_FILES["file"]["tmp_name"],
                    "img/upload/pictures/" . $_FILES["file"]["name"] );
                    $picture_name = $_FILES["file"]["name"];
                }
            }

        else {
            $Error = "File is not of the following format {jpeg, jpg, pjpeg,x-png,png}";
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $query = $connect->query("
            INSERT INTO picture(event_id, picture_link) VALUES ($event_id, '$picture_name')
        ");

        header( "Location: /view.php?event_id=$event_id") ;
        }
?>