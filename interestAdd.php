<?php
    
    session_start();
    
    if(isset($_SESSION['usr_id'])){
        $sessionUser = $_SESSION['usr_id'];
    }else{
        header( "Location: /") ;
    }

    $xmlDoc=new DOMDocument();

    //get the q parameter from URL
    $q=$_GET["q"];
    
    require_once('connect.php');
    $q =  mysql_real_escape_string($q);
    
    //lookup all links from the xml file if length of q>0
    if (strlen($q)>0) {
        $query = $connect->query("SELECT COUNT(interest_name) AS num_interest FROM interests WHERE interest_name = '$q'");
        $interest_check = $query->fetch();
        
        if($interest_check["num_interest"] == 0){
            $query = $connect->query("
      			   INSERT INTO interests(interest_name) VALUES ('$q')
      		  ");
            $interests_query = $connect->query("
            SELECT *
            FROM interests
            ORDER BY interest_name Asc
          ");
          
          $hint="";
          
          while($interest = $interests_query->fetch()){
            $interest_id = $interest['interest_id'];
            $interest_name = $interest['interest_name'];
            $hint = $hint . "<li><a href='/events.php?interest=$interest_id'>$interest_name</a></li>";
          }
        }else{
          $hint = "<li class='cat-item cat-item-2'><a href='#'>$q already exists</a></li>";
        }

      }

      
     

    // Set output to "no suggestion" if no hint were found
    // or to the correct values
    if ($hint=="") {
      $response="";
    } else {
      $response=$hint;
    }

    //output the response
echo $response;     
?>