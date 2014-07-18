<?php  session_start(); 
$sessionUser = $_SESSION['usr_id'];
$piked = false;
?>

<!DOCTYPE html>
<html>
<!--<![endif]-->

<head>

    <title>Evenup</title>

    <meta name="author" content="PressLayer">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300' rel='stylesheet' type='text/css'>
        
        <script type="text/javascript">
            jQuery(function($){

                $('.month').hide();
                var current = 6;
                $('#month'+current).show();
                $('#Month'+current).show();

                    $('#monthPrev').click(function(){
                        if(current > 1){
                            console.log(current)
                            $('#month'+current).hide();
                            $('#Month'+current).hide();
                            current = current - 1;
                            $('#month'+current).show();
                            $('#Month'+current).show();
                            return false;
                        }
                        else{
                            $('#month'+current).show();
                            $('#Month'+current).show();
                            return false;
                        }
                        
                    });

                    $('#monthNext').click(function(){
                        if(current < 12){
                            $('#month'+current).hide();
                            $('#Month'+current).hide();
                            current = current + 1;
                            $('#month'+current).show();
                            $('#Month'+current).show();
                            return false;
                        }else{
                            $('#month'+current).show();
                            $('#Month'+current).show();
                            return false;
                        }

                    });
            });
        </script>
        <script src='http://codepen.io/assets/libs/fullpage/jquery.js'></script>


        <link rel="stylesheet" type="text/css" href="/css/reset.css" />
        <link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="/css/flexslider.css" />
        <link rel="stylesheet" type="text/css" href="/css/superfish.css" />
        <link rel="stylesheet" type="text/css" href="/css/style.css" />
        <link rel="stylesheet" type="text/css" href="/css/jquery.fancybox-1.3.4.css" />

        <script type="text/javascript" src="/js/jquery.js"></script>
        <script type="text/javascript" src="/js/jquery.masonry.min.js"></script>
        <script type="text/javascript" src="/js/jquery.imagesloaded.min.js"></script>
        <script type="text/javascript" src="/js/jquery.infinitescroll.min.js"></script>
        <script type="text/javascript" src="/js/jquery.flexslider-min.js"></script>
        <script type="text/javascript" src="/js/hoverIntent.js"></script>
        <script type="text/javascript" src="/js/superfish.js"></script>
        <script type="text/javascript" src="/js/jquery.mobilemenu.js"></script>
        <script type="text/javascript" src="/js/jquery.placeholder.min.js"></script>
        <script type="text/javascript" src="/js/jquery.fitvids.js"></script>
        <script type="text/javascript" src="/js/jquery.fancybox-1.3.4.pack.js"></script>
        <script type="text/javascript" src="/js/custom.js"></script>
</head>
<body>

<!-- Facebook share button start -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&appId=563460800438057&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!-- Facebook share button end -->

<!-- Facebook send button start -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&appId=563460800438057&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!-- Facebook send button end -->
      <?php
            require('date.php');
            $date = new Date();
            $year = date('Y');
            $month = date('n');
            $day = date('d');
            $dates = $date->getAll($year);
?>  

 <?php

                    if(isset($_GET['$year']) && isset($_GET['month']) && isset($_GET['day'])) 
                    {

                        $qyear = $_GET['$year'];
                        $qmonth = $_GET['month'];
                        $qday = $_GET['day'];
                    }else{
                        $qyear = $year;
                        $qmonth = $month;
                        $qday = $day;
                    }
                ?>



<div id="header">
        <div class="container clearfix">
            <h1 id="logo"><a href="/events.php"><img src="/images/logo.png" alt="Place" /></a></h1>
        </div>  
    </div>

    <div id="main">
        <div class="container clearfix">
            <div id="leftContent">
                <div class="inner">
                
                           <?php

                            $todyear = date('Y');
                            $todmonth = date('m');
                            $todday = date('d');

                            if(isset($_GET['year']) && isset($_GET['month']) && isset($_GET['day'])) 
                            {

                                $qyear = $_GET['year'];
                                $qmonth = $_GET['month'];
                                $qday = $_GET['day'];
                            }else{
                                
                                $qyear = $todyear;
                                $qmonth = $todmonth;
                                $qday = $todday;
                            }
                        ?>
                    

                    <!-- start PHP OPERATION FOR LODING SPECIFIC INFORMATION OF A EVENT -->
                    <?php
                            if(isset($_GET['event_id'])) 
                            {                   
                                $event_id = $_GET['event_id'];
                                require_once('connect.php');

                                $events_query = $connect->query("

                                    SELECT *
                                    FROM events
                                    JOIN userapps U ON U.Facebook_ID = events.usr_create
                                    LEFT JOIN interests I ON I.interest_id = events.event_cat
                                    WHERE event_id = ". $event_id ."

                                ");

                                
                                if($event = $events_query->fetch()){
                                    ?> 


                                    <div class="post_item post_single white_box">
                                       <!-- <img src="images/_slider/2.jpg" class="post_top_element single_thumb" /> -->
                                            <img src="/img/upload/events/<?php echo $event['event_pic']; ?>" class="post_top_element single_thumb" />           
<!-- 
                                                      <div class="social_share">
                  
                                                      <ul>
                                                      <li>
                                                      <div class="fb-send" data-href="https://developers.facebook.com/docs/plugins/" data-width="100" data-height="30" data-colorscheme="light"></div>
                                                      <div class="fb-share-button" data-type="button" data-href="https://developers.facebook.com/docs/plugins/" data-width="100"></div>
                                                      </li></ul>  
                                                          
                                                          
                                                      </div>     -->                  
                                        <div class="post_single_inner">


                                    <h1><?php echo $event['event_name']; ?></h1>
                                    
                                    <div class="post_meta">
                                        <span class="user">by <a href="#"><?php echo $event['usr_lname'] . ' '. $event['usr_fname']; ?></a></span> 
                                        <span class="date"><?php echo $event['event_date']; ?></span>
                                        <span class="time"><?php echo $event['event_time']; ?></span>
                                        <span class="cats"><?php echo $event['interest_name']; ?></span><br><br>
                                        <span class="place"><?php echo $event['event_place']; ?></span>
                                        <div data-href="https://developers.facebook.com/docs/plugins/" style="float:right;" class="fb-share-button" data-type="button"  data-width="100"></div>
                                        <div style="float:right;" class="fb-send" data-href="https://developers.facebook.com/docs/plugins/" data-width="100" data-height="30" data-colorscheme="light"></div>
                                    
                                    </div>
                                    <div class="post_entry">
                                    <p>
                                    <?php echo $event['event_description']; ?>
                                    </p>
                                    </div>
                                    <div class="post_single_bottom_wrapper">
                                        <?php if($event['Facebook_ID'] != $sessionUser){

                                            $participated_query = $connect->query("

                                                SELECT count(*) AS participanted FROM joinevents
                                                where event_id = ".$event_id." and usr_ID = ". $sessionUser . "
                                            ");

                                            if($participanted = $participated_query->fetch()){
                                                if($participanted["participanted"] > 0){ 
                                            ?>
                                                <span style="color:green;border-style:solid;">Piked</span>
                                        <?php } else {?>
                                                <a href="/joinEvents.php?event_id=<?php echo $event['event_id']; ?>" class="button green">Pike</a>
                                        <?php } } ?>
                                            

                                        <?php }else{ ?>

                                            <a href="/modify.php?event_id=<?php echo $event['event_id']; ?>" class="button green">Modify</a>
                                            <a href="/delete.php?event_id=<?php echo $event['event_id']; ?>" class="button red">Delete</a>                                                            

                                        <?php } ?>


                                        <?php $participants_query = $connect->query("

                                            SELECT count(*) AS num_participants FROM joinevents
                                            JOIN userapps U ON U.Facebook_ID = joinevents.usr_id
                                            where event_id = ".$event_id."

                                        ");

                                        if($participant = $participants_query->fetch()){ ?>
                                        <span class="like"><a href="#"><?php echo $participant["num_participants"]; ?>

                                                </a></span>
                                        <?php } ?>
                                    </div>

                                <?php
                                        }
                                    }else{
                                        header('Location: /events.php');
                                    } 
                                ?>
                   
                    
                    <div class="clear"></div>
                    </div>  
                
                </div><!-- post item -->
<div class="related_posts white_box">
    <h3 class="rp_title">Participants</h3>
    <div class="rp_col_wrapper clearfix" style="overflow: scroll;height: 600px;">
        
        <?php 

            $participants_query = $connect->query("
                SELECT * FROM joinevents
                JOIN userapps U ON U.Facebook_ID = joinevents.usr_id
                where event_id = ".$event_id."
            ");

            while($participant = $participants_query->fetch()){ ?>

            <div class="rp_col">
                <?php if($participant["Facebook_ID"] == $sessionUser){
                    $piked = true;
                } ?>
                    <div class="small_thumb"><img src="/include/Profil_pictures/<?php echo $participant["picture_link"]; ?>" title="<?php echo $participant["usr_lname"] . ' ' . $participant["usr_fname"]; ?>"  /></div>
            </div>

        <?php } ?>
        

    </div>
</div>  

<script type="text/javascript">

            function addFeedback(element, event_id) {
                if(window.event.keyCode == 13){
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp=new XMLHttpRequest();
                    } else {  // code for IE6, IE5
                        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                    }

                    xmlhttp.onreadystatechange=function() {
                        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                            document.getElementById("feedbackSearch").innerHTML=xmlhttp.responseText;
                            element.value = '';
                        }
                    }
                      
                    xmlhttp.open("GET","feedbackAdd.php?q="+element.value+"&event_id="+event_id,true);
                    xmlhttp.send();
                }
            }

        </script>

<div class="related_posts white_box">
    <h3 class="rp_title">Discussions</h3>
    <div class="rp_col_wrapper clearfix">
            
        <div id="comment_tab" class="tab_content recent_comments" style="overflow: auto;">
                    <ul id="feedbackSearch">
                        <?php 

                            $feedbacks_query = $connect->query("
                                SELECT * FROM feedback
                                JOIN userapps U ON U.Facebook_ID = feedback.feedback_user_id
                                where feedback.feedback_event_id = ".$event_id."
                            ");

                            while($feedback = $feedbacks_query->fetch()){ ?>
                                <li><img src='/include/Profil_pictures/<?php echo $feedback["picture_link"]; ?>' class='avatar avatar-50 photo' height='50' width='50' /><p><cite><?php echo $feedback["usr_lname"] . ' '. $feedback["usr_fname"]; ?>:</cite> <em><?php echo $feedback["feedback_time"]; ?></em><br> <a href="#"><?php echo $feedback["feedback_message"]; ?></a></p><div class="clear"></div></li>
                            <?php } ?>

                    </ul><br>         

                </div>
                
    </div>
    <?php if($piked){ ?>
        <div style="text-align: center">
            <form>
                <textarea type="text" placeholder="say what you think ;)" style="width:756px; height:131px" onkeydown="addFeedback(this, <?php echo $event_id ?>)"></textarea><br>
            </form>
        </div> 
    <?php } ?>
</div>

<div class="related_posts white_box">
    <h3 class="rp_title">Pictures</h3>
    <div class="rp_col_wrapper clearfix">
        <?php 

            $pictures_query = $connect->query("
                SELECT * FROM picture
                where event_id = ".$event_id."
            ");

            while($picture = $pictures_query->fetch()){ ?>
                <div class="rp_col">
                    <div class="small_thumb"><img src="/img/upload/pictures/<?php echo $picture["picture_link"]; ?>"/></div>
                </div>
            <?php } ?>

    </div>
    <?php if($piked){ ?>
        <div style="text-align:center">
            <br>
            <form action="/addEventPicture.php?event_id=<?php echo $event_id ?>" method="post" enctype="multipart/form-data">
                <label>only jpeg, jpg, pjpeg, x-png, and png are allowed</label>
                <input type="file" name="file"><br><br>
                <input class="button gray small" type="submit" name="submit" value="Upload Picture"><br><br>
            </form>
        </div>
    <?php } ?>
</div>

<div class="related_posts white_box">
    <h3 class="rp_title">Files</h3>
    <div class="rp_col_wrapper clearfix">

        <?php 

            $files_query = $connect->query("
                SELECT * FROM files
                where file_event_id = ".$event_id."
            ");

            while($file = $files_query->fetch()){ ?>
                <div class="rp_col" style="width:100%; height:100px">
                    <a href="/img/upload/files/<?php echo $file["file_name"]; ?>" target="_blank"><div class="pdf_small_thumb"><?php echo $file["file_name"]; ?><br><em>click to view</em></div></a>
                </div>
            <?php } ?>
    </div>
    <?php if($piked){ ?>
        <div style="text-align:center">
            <br>
            <form action="/addEventFile.php?event_id=<?php echo $event_id ?>" method="post" enctype="multipart/form-data">
                <label>only pdf is allowed</label>
                <input type="file" name="file" id="file"><br><br>
                <input class="button gray small" type="submit" name="submit" value="Upload File"><br><br>
            </form>
        </div>
        <?php } ?>
</div>

                
                <script type="text/javascript">
                    $(document).ready(function() {
                        $("a.fancybox").fancybox();
                    });
                </script>
                
                
            </div>
        </div>


        <div id="sidebar">

            <script type="text/javascript">
            
            function showinvitations(str, event_id) {
              
              if (window.XMLHttpRequest) {
                     // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp=new XMLHttpRequest();
              } else {  // code for IE6, IE5
                     xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
              }
              
              xmlhttp.onreadystatechange=function() {
                    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                      document.getElementById("invitationSearch").innerHTML=xmlhttp.responseText;
                    }
              }
              
              xmlhttp.open("GET","invitationSearch.php?q="+str+"&event_id="+event_id,true);
              xmlhttp.send();
            }

        </script>

            <div class="widget widget_invitations white_box"><h3 class="widget_title">Send Invitations</h3>
            <form>
                <input type="text" placeholder="click here to start searching in your contacts" onkeyup="showinvitations(this.value, <?php echo $event_id; ?>)">
            </form> 

            

                    <ul style="overflow: scroll;height: 450px;" id="invitationSearch">
                        <?php      
                            require_once('connect.php');

                            $invitations_query = $connect->query("
                                SELECT * 
                                FROM  friends 
                                JOIN userapps U ON U.Facebook_ID = friends.user_other
                                WHERE user_me = $sessionUser and friends.user_other NOT IN (SELECT notification_user from notification where event_id = $event_id)
                                and friends.user_other NOT IN (SELECT joinevents.usr_id from joinevents where event_id = $event_id)

                            ");

                            while($invitation = $invitations_query->fetch()){
                        ?>
                            <li ><img alt='' src='/include/Profil_pictures/<?php echo $invitation["picture_link"]; ?>' class='avatar avatar-50 photo' height='50' width='50' />
                                <p><cite><?php echo $invitation["usr_lname"] . ' ' . $invitation["usr_fname"] ?></cite><br><a href="/pike_invitation.php?event_id=<?php echo $event_id ?>&amp;user_invited=<?php echo $invitation["Facebook_ID"]; ?>" style="width:55%;margin-top:10px;text-align:center;" class="button blue small">Invite</a><div class='clear'><br></li>
                         <?php } ?>

                    </ul>
        </div>

        
     

        
        <script type="text/javascript">
        jQuery(document).ready(function($){ 
            $('#tab_wrapper_tab_widget-2').each(function() {
                $(this).find(".tab_content").hide();
                $(this).find("ul.tab_menu li:first").addClass("active").show(); 
                $(this).find(".tab_content:first").show();
            });
            
            $("ul.tab_menu li").click(function(e) {
                $(this).parents('#tab_wrapper_tab_widget-2').find("ul.tab_menu li").removeClass("active"); 
                $(this).addClass("active");
                $(this).parents('#tab_wrapper_tab_widget-2').find(".tab_content").hide();
        
                var activeTab = $(this).find("a").attr("href");
                $(this).parents('#tab_wrapper_tab_widget-2').find(activeTab).show();
                
                e.preventDefault();
            });
            
            $("ul.tab_menu li a").click(function(e) {
                e.preventDefault();
            })
        });
        </script>

        <script>
            function pikesResult(str) {
              
              if (window.XMLHttpRequest) {
                     // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp=new XMLHttpRequest();
              } else {  // code for IE6, IE5
                     xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
              }
              
              xmlhttp.onreadystatechange=function() {
                    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                      document.getElementById("PikesSearch").innerHTML=xmlhttp.responseText;
                    }
              }
              
              xmlhttp.open("GET","PikesSearch.php?q="+str,true);
              xmlhttp.send();
            }

            function contactResult(str) {
              
              if (window.XMLHttpRequest) {
                     // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp=new XMLHttpRequest();
              } else {  // code for IE6, IE5
                     xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
              }
              
              xmlhttp.onreadystatechange=function() {
                    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                      document.getElementById("contactSearch").innerHTML=xmlhttp.responseText;
                    }
              }
              
              xmlhttp.open("GET","contactSearch.php?q="+str,true);
              xmlhttp.send();
            }

            function notifsResult(str) {
              
              if (window.XMLHttpRequest) {
                     // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp=new XMLHttpRequest();
              } else {  // code for IE6, IE5
                     xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
              }
              
              xmlhttp.onreadystatechange=function() {
                    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                      document.getElementById("notifsSearch").innerHTML=xmlhttp.responseText;
                    }
              }
              
              xmlhttp.open("GET","notifsSearch.php?q="+str,true);
              xmlhttp.send();
            }
        </script>

        <script type="text/javascript">
            var userSender;

            jQuery(document).ready(function($){ 
                $('#chatBox').hide();
                $('#chatBoxForm').hide();
            });
            function chatResult(user_sender) {
                    userSender = user_sender;
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp=new XMLHttpRequest();
                    } else {  // code for IE6, IE5
                        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                    }
                      
                    xmlhttp.onreadystatechange=function() {
                        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                            document.getElementById("chatBox").innerHTML=xmlhttp.responseText;
                        }
                    }
              
                    xmlhttp.open("GET","chatFetch.php?q="+user_sender,true);
                    xmlhttp.send();

                    jQuery(document).ready(function($){ 
                        $('#contactSearch').hide();
                        $('#contactSearchForm').hide();
                        $('#chatBox').show( "slow" );
                        $('#chatBoxForm').show( "slow" );
                     });            
            }

            function sendChat(element) {
                if(window.event.keyCode == 13){
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp=new XMLHttpRequest();
                    } else {  // code for IE6, IE5
                        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                    }

                    xmlhttp.onreadystatechange=function() {
                        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                            document.getElementById("chatBox").innerHTML=xmlhttp.responseText;
                        }
                        element.value = ''
                    }
                      
                    xmlhttp.open("GET","chatSend.php?q="+userSender+"&post="+element.value,true);
                    xmlhttp.send();
                }          
            }

            function returnContact(){
                jQuery(document).ready(function($){ 
                    $('#chatBoxForm').hide();
                    $('#chatBox').hide();
                    $('#contactSearchForm').show( "slow" );
                    $('#contactSearch').show( "slow" );
                });
            }
            
        </script>
        
        <!-- BEGIN WIDGET -->
        <div class="widget tab_wrapper white_box" id="tab_wrapper_tab_widget-2">
            
            <ul class="tab_menu"><li class="tab_post"><a href="#post_tab">Notifs</a></li><li  class="tab_comment"><a href="#comment_tab">Friends</a></li><li class="tab_tag"><a href="#tag_tab">Pikes</a></li></ul>
            <div class="clear"></div>
            <div class="tabs_container">
            <div id="post_tab" class="tab_content recent_posts">
                    <form>
                        <input type="text" placeholder="Click to search in your notifications ..." onkeyup="notifsResult(this.value)">
                    </form>
                    <ul id="notifsSearch">
                        <?php      
                            require_once('connect.php');

                            $notification_query = $connect->query("
                                SELECT * 
                                FROM  notification 
                                WHERE notification_user =$sessionUser
                            ");

                            while($notification = $notification_query->fetch()){
                        ?>
                            <li>
                                <?php if( $notification['notification_type'] == "invitation") {?>
                                     <a href="/view.php?event_id=<?php echo $notification['event_id'] ?>" title="Praesent Et Urna Turpis Sadips" class="small_thumb">
                                        <img src="images/notif_images/<?php echo $notification['notification_image'] ?>" width="50" height="50" alt="Praesent Et Urna Turpis Sadips">
                                    </a>
                                    <a href="/view.php?event_id=<?php echo $notification['event_id'] ?>" title="Praesent Et Urna Turpis Sadips" class="title"><?php echo $notification['notification_title'] ?></a><em><?php echo $notification['notification_time'] ?></em><div class="clear"></div>   
                                    </a> 
                                <?php }elseif ($notification['notification_type'] == "chat") { ?>
                                    <a href="#" title="Praesent Et Urna Turpis Sadips" class="small_thumb">
                                        <img src="images/notif_images/<?php echo $notification['notification_image'] ?>" width="50" height="50" alt="Praesent Et Urna Turpis Sadips">
                                    </a>
                                    <a href="#" title="Praesent Et Urna Turpis Sadips" class="title"><?php echo $notification['notification_title'] ?></a><em><?php echo $notification['notification_time'] ?></em><div class="clear"></div>   
                                    </a> 
                                <?php }else{ ?> 
                                <a href="/view.php?event_id=<?php echo $notification['event_id'] ?>" title="Praesent Et Urna Turpis Sadips" class="small_thumb">
                                        <img src="images/notif_images/<?php echo $notification['notification_image'] ?>" width="50" height="50" alt="Praesent Et Urna Turpis Sadips">
                                    </a>
                                    <a href="/view.php?event_id=<?php echo $notification['event_id'] ?>" title="Praesent Et Urna Turpis Sadips" class="title"><?php echo $notification['notification_title'] ?></a><em><?php echo $notification['notification_time'] ?></em><div class="clear"></div>   
                                    </a> 
                                <?php } ?>
                            </li>
                        <?php } ?>
                        
                    </ul>                         
                </div>
                                
                <div id="comment_tab" class="tab_content recent_comments" >
                     <form id="contactSearchForm">
                            <input type="text" placeholder="Search Contacts by Last Name ..." onkeyup="contactResult(this.value)">
                    </form>

                    <div id='chatBoxForm'>
                        <a class='button red full' onclick='returnContact()'>Return to contacts</a>
                        <textarea placeholder='send your message here' onkeydown='sendChat(this)'></textarea>
                    </div>

                    <ul id="contactSearch">
                        
                        <?php      
                            require_once('connect.php');

                            $contact_query = $connect->query("
                                SELECT * 
                                FROM  friends 
                                JOIN userapps U ON U.Facebook_ID = friends.user_other
                                WHERE user_me =$sessionUser
                            ");

                            while($contact = $contact_query->fetch()){
                            ?>
                                <li >
                                    <img alt='' src='/include/Profil_pictures/<?php echo $contact["picture_link"]; ?>' class='avatar avatar-50 photo' height='50' width='50' />
                                    <p>
                                        <cite><?php echo $contact["usr_lname"]; ?> <?php echo $contact["usr_fname"]; ?></cite><br>
                                        <em style="cursor:pointer" onclick="chatResult(<?php echo $contact["user_other"]; ?>)">click to view conversation</em>
                                    </p>
                                    <div class="clear"></div>
                                </li> 

                            <?php } ?>
                    </ul>
                    <ul id="chatBox">
                        
                    </ul>                          
  
                </div>
                                
                  <div id="tag_tab" class="tab_content recent_posts">

                    <form>
                        <input type="text" placeholder="Click to search your pikes ..." onkeyup="pikesResult(this.value)">
                    </form>
                    <ul id="PikesSearch">
                        <?php      
                            require_once('connect.php');

                            $pikes_query = $connect->query("
                                SELECT E.event_id ,E.event_pic,E.event_name,E.event_date, E.event_time FROM  joinevents
                                    JOIN EVENTS E ON E.event_id = joinevents.event_id
                                    WHERE usr_id =$sessionUser
                                UNION

                                SELECT event_id,event_pic,event_name,event_date, event_time FROM  events
                                    WHERE usr_create =$sessionUser
                                ORDER BY event_date, event_time DESC
                            ");

                            while($pike = $pikes_query->fetch()){
                            ?>
                                <li>
                                     <a href="/view.php?event_id=<?php echo $pike['event_id'] ?>" title="Praesent Et Urna Turpis Sadips" class="small_thumb">
                                        <img src="img/upload/events/<?php echo $pike['event_pic'] ?>" width="50" height="50" alt="Praesent Et Urna Turpis Sadips">
                                    </a>
                                    <a href="/view.php?event_id=<?php echo $pike['event_id'] ?>" class="title"><?php echo $pike['event_name'] ?></a><em><?php echo $pike['event_date'] ?> - <?php echo $pike['event_time'] ?></em><div class="clear"></div>   
                                    </a>  
                                </li>
                            <?php } ?>
                    </ul>  
                    </div>       
            </div>
            
        </div>
        <!-- END WIDGET -->

        <script type="text/javascript">
            jQuery(document).ready(function($){ 
                $('#interestsForm').hide();
            });

            function showResult(str) {
              
              if (window.XMLHttpRequest) {
                     // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp=new XMLHttpRequest();
              } else {  // code for IE6, IE5
                     xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
              }
              
              xmlhttp.onreadystatechange=function() {
                    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                      document.getElementById("categorySearch").innerHTML=xmlhttp.responseText;
                    }
              }
              
              xmlhttp.open("GET","categorySearch.php?q="+str,true);
              xmlhttp.send();
            }

            function showTextBox() {
                jQuery(document).ready(function($){ 
                    $('#interestsForm').show( "slow" );
                    $('#createButton').hide();
                });
            }

            function addInterest(element) {
                if(window.event.keyCode == 13){
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp=new XMLHttpRequest();
                    } else {  // code for IE6, IE5
                        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                    }

                    xmlhttp.onreadystatechange=function() {
                        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                            document.getElementById("categorySearch").innerHTML=xmlhttp.responseText;
                            element.value = '';
                        }
                    }
                      
                    xmlhttp.open("GET","interestAdd.php?q="+element.value,true);
                    xmlhttp.send();

                    jQuery(document).ready(function($){ 
                        $('#createButton').show( "slow" );
                        $('#interestsForm').hide();
                      });
                }
            }

        </script>

        <div id="categories-3" class="widget widget_categories white_box"><h3 class="widget_title">Interests</h3>
            <form>
                <input type="text" placeholder="click here to start searching in communities" onkeyup="showResult(this.value)">
            </form> 

            

                    <ul style="overflow: scroll;height: 450px;" id="categorySearch">
                        <?php      
                            require_once('connect.php');

                            $interests_query = $connect->query("
                                SELECT *
                                FROM interests
                                ORDER BY interest_name Asc
                            ");

                            while($interest = $interests_query->fetch()){
                        ?>
                            <li class="cat-item cat-item-2"><a href="/events.php?interest=<?php echo $interest['interest_id'] ?>"><?php echo $interest['interest_name'] ?></a></li>
                        <?php } ?>

                    </ul>
                    
                    <div id='interestsForm'>
                        <textarea placeholder='enter your interest' onkeyup='addInterest(this)'></textarea>
                    </div>
                    <a id="createButton" class="button red full" onclick='showTextBox()'>New Interest</a>
        </div>

        <div id="calendar-2" class="widget widget_calendar white_box">

            <h3 class="widget_title">Calendar</h3>
            <div id="calendar_wrap">
                 <table id="wp-calendar">
                    <caption>
                     <?php foreach ($date->months as $id=>$m): ?>
                            <b href="#" class="month" id="Month<?php echo $id+1; ?>" width="50px" ><?php echo $m; ?></b>
                        <?php endforeach; ?> <?php echo $year; ?>
                    </caption>

                    <thead>
                    <tr>
                        <th scope="col" title="Monday">M</th>
                        <th scope="col" title="Tuesday">T</th>
                        <th scope="col" title="Wednesday">W</th>
                        <th scope="col" title="Thursday">T</th>
                        <th scope="col" title="Friday">F</th>
                        <th scope="col" title="Saturday">S</th>
                        <th scope="col" title="Sunday">S</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <td colspan="2" id="monthPrev"><a href="#">&laquo;</a></td>
                        <td colspan="3"><a href="/add.php">New Pike</a></td>
                        <td colspan="2" id="monthNext"><a href="#">&raquo;</a></td>
                    </tr>
                    </tfoot>
                <div class="clear"></div>

                <?php $dates = current($dates); ?>
                    <?php foreach ($dates as $m => $days): ?>

                <tbody class="month" id="month<?php echo $m; ?>">
                    <tr>
                    <?php $end = end($days); foreach($days as $d=>$w): ?>
                        <?php if($d == 1 && $w-1 > 0): ?>
                            <td colspan="<?php echo $w-1; ?>" class="pad">&nbsp;</td>
                        <?php endif ?>

                        <?php
                             if(isset($_GET['year']) && isset($_GET['month']) && isset($_GET['day'])) 
                            {

                                $qyear = $_GET['year'];
                                $qmonth = $_GET['month'];
                                $qday = $_GET['day'];
                            }else{
                                
                                $qyear = $todyear;
                                $qmonth = $todmonth;
                                $qday = $todday;
                            }
                             if($d == $qday  && $m == $qmonth): ?>
                            <td style="background-color:#C53434"><a style="color:white" href="/events.php?year=<?php echo $year; ?>&month=<?php echo $m; ?>&day=<?php echo $d; ?>"><?php echo $d; ?></td></a>
                        <?php else: ?>
                            <td><a href="/events.php?year=<?php echo $year; ?>&month=<?php echo $m; ?>&day=<?php echo $d; ?>" ><?php echo $d; ?></td></a>
                        <?php endif ?>

                        <?php if($w == 7): ?>
                            </tr><tr>
                        <?php endif; ?>
                    <?php endforeach ?>
                </tr>
               
                </tbody>
            <?php endforeach; ?>


             </table>
            </div>
        </div>
    
    </div>
</div><!-- #main -->
    
<div id="footer">
        <div class="container clearfix">
            <div class="ft_left">&copy; 2014 <a href="#">PikeLife</a></div>
            <div class="clear"></div>
        </div>
    </div>
    <!-- #footer -->
<div id="toTop"><a href="#">TOP</a></div>   
</body>
</html>
