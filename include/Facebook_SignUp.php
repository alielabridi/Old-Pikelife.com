<?php
############################################################
## Registration using Facebook API JS V2.0
## Author : Ali Elabridi
## Date 05/25/2014
############################################################

/* include mysql connect file */
require_once('connect.php');

session_start();

include 'Download_Picture_function.php';
	if( 
		//to verify that the user went through the first page with the FB SDK JS
		!empty($_POST["id"]) &&
		!empty($_POST["email"]) &&
		!empty($_POST["last_name"]) &&
		!empty($_POST["first_name"]) &&
		!empty($_POST["link"]) &&
		!empty($_POST["picture"]) &&
		!empty($_POST["gender"]) &&
		$_POST["id"]!="undefined" &&
		$_POST["email"]!="undefined" &&
		$_POST["last_name"]!="undefined" &&
		$_POST["first_name"]!="undefined" &&
		$_POST["link"]!="undefined" &&
		$_POST["gender"]!="undefined" &&
		$_POST["picture"]!="undefined"
	 )
	{


		$db = new mysqli($hostname_mysqli,$username_mysqli,$password_mysqli,$database_mysqli);
		if($db->connect_error)
		{
			die("Connect error ({$db->connect_errno}) {$db->connect_error}");
		}

		//Escape ID to prepare it for the SELECT query

		$id = mysqli_escape_string($db,$_POST["id"]);
		$first_name = mysqli_escape_string($db,$_POST["first_name"]);

		$result = $db->query("SELECT * FROM `userapps` WHERE `Facebook_ID` = $id;");

		/*Check whether the user is already registered in the database*/
		if($result->num_rows==0)
		{
			//Save the Facebook Profil Picture on the Profil_pictures directory
			$picture = itg_fetch_image($_POST["picture"],"../img/upload/facebook/","absolute","","false", "false");
			
			/*Espace all the inputs */
			$link = mysqli_escape_string($db,$_POST["link"]);

			if($_POST["birthday"]!="undefined")
			{
				$birthday = mysqli_escape_string($db,$_POST["birthday"]);
				$birthday = date('Y-m-d', strtotime(str_replace('-', '/', $birthday)));
			}
			else 
				$birthday = "";

			$birthday = date('Y-m-d', strtotime(str_replace('-', '/', $birthday)));
			$position = mysqli_escape_string($db,$_POST["position"]);
			$picture = str_replace("../img/upload/", "", $picture);
			$picture = mysqli_escape_string($db,$picture);
			$email = mysqli_escape_string($db,$_POST["email"]);
			$last_name = mysqli_escape_string($db,$_POST["last_name"]);
			$gender = mysqli_escape_string($db, $_POST["gender"]);


			/*Fill the database with the basic information*/
			$sql = "INSERT INTO userapps (`usr_email`,`usr_lname`,`usr_fname`,`Facebook_ID`,`profil_link`,`birthday`,`location`,`gender`,`picture_link`,`confirmed`)
					VALUES(
						'$email',
						'$last_name',
						'$first_name',
						'$id',
						'$link',
						'$birthday',
						'$position',
						'$gender',
						'$picture',
						'1'
						);";

			$db->query($sql);

			/*Decode the json friendlist from JS*/
			$friendlist=json_decode($_POST["friendlistjson"]);
			if( isset($friendlist) ){
				/*Insert the friendlist in the database*/
				foreach ($friendlist as $key => $value) {
					/*Espace the entered values for SECURITY reason*/
					$user_id = mysqli_escape_string($db,$id);
					$friend_id = mysqli_escape_string($db,$friendlist[$key]->id);
					
					/*Insert the user as having friends*/
					$sql = "INSERT INTO `eventapp`.`friends` (`user_me`, `user_other`) VALUES ('$user_id', '$friend_id');";
					$db->query($sql);
					
					/*Insert the friend as having the user as friend*/
					$sql = "INSERT INTO `eventapp`.`friends` (`user_me`, `user_other`) VALUES ('$friend_id', '$user_id');";
					$db->query($sql);
				}
			}

			/*Set the session and redirect to the main dashboard*/
			$_SESSION['usr_id']=$id;
			header("location: /events.php");
		
		}	
	}
	else
	{		
		echo "An error occured, you have not been registered please retry!<br />";
		header("Location: /index.php");
	}

?>