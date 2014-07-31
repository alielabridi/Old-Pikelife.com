<?php
/*
  verified the validity of the adress e-mail
  GET email to send confirmation email
  GET code to confirm email entered
  ECHO message to get feedback
*/
require_once("connect.php");

if(isset($_GET["email"]) AND !isset($_GET["code"])){
    $db = new mysqli($hostname_mysqli,$username_mysqli,$password_mysqli,$database_mysqli);
    if($db->connect_error){
      die("Connect error ({$db->connect_errno}) {$db->connect_error}");
    }
    $email = $db->real_escape_string($_GET['email']);
    $sql = "SELECT usr_email FROM `userapps` WHERE usr_email = '$email';";
    $result = $db->query($sql);
    if($result->num_rows==0)
      $message = "$email does not exist in our database ! Please, <a href=\"Register.php\">Sign in</a>";
    else if($result->num_rows==1)
    {
      $message = "A confirmation e-mail has been send to $send. Please, check your inbox!";
      $row = $result->fetch_assoc();

      /* E-mail prepation */
    $subject = 'Welcome to Pikelife.com';
    $msg = '<h1>Welcome to Pikelife $row["usr_fname"] $row["usr_lname"]</h1>';
    $msg .= '<span>Confirm your e-mail to get started with the pikelife experience</span>';
    $msg .= "<a href=\"http://pikelife.com/emailConfirmation.php?email=$email&code={$row["confirm_code"]}\"";
    $headers = 'From: noreply@pikelife.com' . "\r\n" .
    'Reply-To: noreply@pikelife.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
    mail($email, $subject, $msg, $headers);
    }
}
else if(isset($_GET["code"]) AND isset($_GET["email"])){
    $db = new mysqli($hostname_mysqli,$username_mysqli,$password_mysqli,$database_mysqli);
    if($db->connect_error){
      die("Connect error ({$db->connect_errno}) {$db->connect_error}");
    }
    $email = $db->real_escape_string($_GET['email']);
    $code = $db->real_escape_string($_GET['code']);
    $sql = "SELECT * FROM `usrapps` WHERE usr_email = '$email' AND confirm_code = '$code';";
    $result = $db->query($sql);
    if($result->num_row==1)
    {
      $sql = "UPDATE `userapps` SET confirmed = '1' WHERE usr_email ='$email' AND confirm_code = '$code';";
      $db->query($sql);
      $message = "You have successfully confirmed you e-mail thank you";
    }
    else
      $message = "The email and the code entered do not match";

}

?>

<!DOCTYPE html>
<html>

<head>
	<title>Email Confirmation</title>
<style>
body 
{
	background-color: #c53334;
}
.top_banner{
	background-color: white;
	height:60px;
	width:100%;
	z-index: 3;
	position: fixed;
	top: 0px;
	left: 0px;
	right: 0px;
	border-bottom: 1px solid rgba(0,0,0,0.15);

}
img{
	position: relative;
	left: 100px;
	top: 10px;
}
.text_adver{
	background-color:rgba(0, 0, 0, 0.5);
	height:160px;
	width: 700px;
	font-family: "Trebuchet MS", Helvetica, sans-serif;
	font-size: 20px;
	position: absolute;
	top: 100px;
	left: 100px;
	color: white;
	padding: 0px 30px 20px 50px;
	border-radius: 40px 40px 40px 40px;
}
.face_book{
	text-align: center;
	background-color:rgba(0, 0, 0, 0.5);
	width: 800px;
	font-family: "Trebuchet MS", Helvetica, sans-serif;
	font-size: 20px;
	position: absolute;
	top: 80px;
	left: 300px;
	color: white;
	padding: 15px 20px 20px 20px;
	border-radius: 40px 40px 40px 40px;
}

        .btn-default {
            background: none;
            border: 2px #fff solid;
            color: #fff;
            padding: 10px 40px 10px 40px;
            font-family: Raleway;
            font-size: 18px;
            font-weight: 700;
        }
        .btn-default:hover, .btn-default:focus, .btn-default:active, .btn-default.active, .open .dropdown-toggle.btn-default {
          color: #fff;
          background: none;
          border-color: #C53434;
          cursor: pointer;
        }

        .textfield_css{
          background: transparent;
          border-radius: 15px;
          padding: 10px;
          color: white;
          border: 3px #fff solid;
          font-size: 15px;
          font-weight: bold;
        }

        ::-webkit-input-placeholder { /* WebKit browsers */
            color:    #fff;
            font-size: 15px;
            font-weight: bold;
        }
        :-moz-placeholder { /* Mozilla Firefox 4 to 18 */
            color:    #fff;
            opacity:  1;
            font-size: 15px;
            font-weight: bold;
        }
        ::-moz-placeholder { /* Mozilla Firefox 19+ */
            color:    #fff;
            opacity:  1;
            font-size: 15px;
            font-weight: bold;
        }
        :-ms-input-placeholder { /* Internet Explorer 10+ */
            color:    #fff;
            font-size: 15px;
            font-weight: bold;
        }

</style>

<link rel="stylesheet" href="css/auth-buttons.css">

    <!-- prettyify -->
    <link rel="stylesheet" href="http://google-code-prettify.googlecode.com/svn/trunk/src/prettify.css">
    <script src="http://google-code-prettify.googlecode.com/svn/trunk/src/prettify.js"></script>

</head>

<body>
	<div class='top_banner'><a href="/"><img src="images/logo_home.png"></a></div>
	<div class="face_book">
  <?= $message ?>	     
	</div>

	

</body>

</html>