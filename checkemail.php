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
		$msg .= "<a href=\"http://pikelife.com/checkemail.php?email=$email&code=$row['confirm_code']\"";
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
    	$message "The email and the code entered do not match";

}

?>