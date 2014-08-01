<?php
  
    $xmlDoc=new DOMDocument();

    //get the q parameter from URL
    $q=$_GET["q"];
    $q =  addslashes($q);
    
    //lookup all links from the xml file if length of q>0
    if (strlen($q)>0) {
          $hint="";
          session_start();
          if(isset($_SESSION['usr_id'])){
              $sessionUser = $_SESSION['usr_id'];
          }else{
              header( "Location: /") ;  
          }

          require_once('connect.php');

            $pikes_query = $connect->query("
              SELECT *
              FROM userapps
              WHERE usr_lname LIKE '%$q%' or usr_fname LIKE '%$q%'
              ORDER BY usr_lname Asc
              LIMIT 0,3
            ");

            while($pike = $pikes_query->fetch()){
              $usr_id = $pike['Facebook_ID'];
              $usr_pic = $pike['picture_link'];
              $usr_lname = $pike['usr_lname'];
              $usr_fname = $pike['usr_fname'];

              $hint = $hint . "<li>";
              $hint = $hint . "<a href='#$usr_id' class='small_thumb'>";
              $hint = $hint . "<img src='/include/Profil_pictures/$usr_pic' width='50' height='50'></a>";
              $hint = $hint . "<a href='/userProfile.php?user_id=$usr_id' class='title'>$usr_lname $usr_fname</a><div class='clear'></div></a>";                        
              $hint = $hint . "</li>";
            }

            require_once('connect.php');

          $pikes_query = $connect->query("
              SELECT *
              FROM events
              WHERE event_name LIKE '%$q%' and event_type != 'Secret'
              ORDER BY event_name Asc
              LIMIT 0,3
          ");

           while($pike = $pikes_query->fetch()){
              $event_id = $pike['event_id'];
              $event_pic = $pike['event_pic'];
              $event_name = $pike['event_name'];
              $event_date = $pike['event_date'];
              $event_time = $pike['event_time'];

              $hint = $hint . "<li>";
              $hint = $hint . "<a href='/view.php?event_id=$event_id' class='small_thumb'>";
              $hint = $hint . "<img src='img/upload/events/$event_pic' width='50' height='50'></a>";
              $hint = $hint . "<a href='/view.php?event_id=$event_id' class='title'>$event_name</a><em>$event_date - $event_time</em><div class='clear'></div></a>";                        
              $hint = $hint . "</li>";
            }

            $hint = $hint . "<li style='text-align:center'><a href='/overallSearchPikes.php?search_query=$q' class='title'>Search more Pikes with '$q'</a><div class='clear'></div></a></li>";
            $hint = $hint . "<li style='text-align:center'><a href='/overallSearchPeople.php?search_query=$q' class='title'>Search more People with '$q'</a><div class='clear'></div></a></li>";
            // Set output to "no suggestion" if no hint were found
              // or to the correct values
              if ($hint=="") {
                $response="";
              } else {
                $response=$hint;
              }

              //output the response
          echo $response;
      }      
?>