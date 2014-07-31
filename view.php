<?php  

        $event_id = $_GET['event_id'];
        require_once('connect.php');

        $type_query = $connect->query("

            SELECT event_type
            FROM events
            WHERE event_id = $event_id

        ");

        $type = $type_query->fetch();

        session_start();
        if(isset($_SESSION['usr_id'])){
            $sessionUser = $_SESSION['usr_id'];
        }else{
            if ($type["event_type"] != "Public") {
                header( "Location: /") ;
            }
            
        }

        $piked = false;
        $invited = 0;

        if(isset($_SESSION['usr_id'])){
            $creator_query = $connect->query("

                SELECT count(*) AS creator_exist
                FROM events
                WHERE event_id = ". $event_id ." and usr_create = $sessionUser

            ");

            $invited_query = $connect->query("

                SELECT count(*) AS invited
                FROM notification
                WHERE event_id = ". $event_id ." and notification_user = $sessionUser

            ");


            if($invite = $invited_query->fetch()){
                if($invite["invited"] > 0){
                    $invited = 1;
                }
            }
                                        
            if($creator = $creator_query->fetch()){

                if($creator["creator_exist"] > 0){
                    $piked = true;
                }

                if($type["event_type"] == "Secret" && $invited == 0){
                    header( "Location: /events.php") ;
                }
            }
        }

?>

<!DOCTYPE html>
<html>
<!--<![endif]-->

<head>

    <title>Evenup</title>


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

<script>
         
            function overallSearchResult(str) {
                  
             if (window.XMLHttpRequest) {
                         // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp=new XMLHttpRequest();
                  } else {  // code for IE6, IE5
                         xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                  }
                  
                  xmlhttp.onreadystatechange=function() {
                        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                          document.getElementById("overallSearchInput").innerHTML=xmlhttp.responseText;
                        }
                  }
                  
                  xmlhttp.open("GET","overallSearch.php?q="+str,true);
                  xmlhttp.send();
                }
        </script>

<div id="header">
        <div class="container clearfix">
            <h1 id="logo"><a href="/events.php"><img src="/images/logo.png" alt="Place" /></a></h1>
            
            <?php 

                if(isset($_SESSION['usr_id'])){ ?>

                <div class="header_search">
                
                    <div class="search_zoom search_btn" onclick="overallSearchResult('')"></div> 
                    <input type="text" placeholder="Type &amp; Search for Pikes and Friends" class="search_box" onkeyup="overallSearchResult(this.value)">
                    <div style="position:inherit; ; left:0px; top:36px; width:63%; border-color: rgb(10, 10, 10);box-shadow: 4px 4px 4px #888888;" class="tab_content search_results">
                        <ul id="overallSearchInput" style="background-color:white">
                            
                        </ul>
                    </div>
                </div>

            <?php 
                require_once('connect.php');

                $users_query = $connect->query("

                    SELECT *
                    FROM userapps
                    WHERE Facebook_ID = $sessionUser
                ");

                                
                if($user = $users_query->fetch()){ ?>
                <a href="/userProfile.php?user_id=<?php echo $sessionUser ?>" title="view your profile" style="float:right"><img alt="" src="/include/Profil_pictures/<?php echo $user['picture_link']; ?>" class="avatar avatar-50 photo hoverZoomLink" height="50" width="50"></a>

            <?php }
            }
             ?>
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
                                        <span class="user">by <a href="/userProfile.php?user_id=<?php echo $event["Facebook_ID"]; ?>"><?php echo $event['usr_lname'] . ' '. $event['usr_fname']; ?></a></span> 
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
                                        <?php if($event['event_type'] != "Private" || ($event['event_type'] == "Private" && $event['usr_create'] == $sessionUser) || ($type["event_type"] == "Private" && $invited == 1)){
                                                        if(isset($_SESSION['usr_id']) && $event['Facebook_ID'] != $sessionUser){
                                                            $participated_query = $connect->query("
                                                                SELECT count(*) AS participanted FROM joinevents
                                                                WHERE event_id = ".$event['event_id']." and usr_ID = ". $sessionUser . "
                                                            ");

                                                            if($participanted = $participated_query->fetch()){
                                                                if(isset($_SESSION['usr_id']) && $participanted["participanted"] > 0){?>
                                                                    <span style="color:green;border:2px solid green;padding:10px 10px 10px 10px">Joined</span>
                                                                <?php }elseif (isset($_SESSION['usr_id'])){ 
                                                                        $participated_query = $connect->query("
                                                                            SELECT count(*) AS participanted FROM friends
                                                                            where user_other = " . $event['usr_create'] . " and user_me = " . $sessionUser . " and friend_request = 'Friends'
                                                                        ");
                                                                        if($follow = $participated_query->fetch()){
                                                                            if($follow["participanted"] > 0 ){?>
                                                                                <a href="/joinEvents.php?event_id=<?php echo $event['event_id']; ?>" class="button green">Join</a>
                                                                                <!-- <span style="color:green;border:2px solid green;padding:10px 10px 10px 10px">Following</span>-->
                                                                            <?php }
                                                                        }

                                                                    ?>
                                                                    
                                                            <?php }
                                                                }
                                                            }elseif (isset($_SESSION['usr_id'])){ ?>
                                                                <a href="/modify.php?event_id=<?php echo $event['event_id']; ?>" class="button green">Modify</a>
                                                                <a href="/delete.php?event_id=<?php echo $event['event_id']; ?>" class="button red">End it</a>
                                                            <?php }else{?>
                                                                <a href="/" class="button green">You must be logged in to join, click to go login </a>
                                                            <?php } 
                                                        }?>


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

            <?php
                require_once('connect.php');
                
                $feedbacks_query = $connect->query("
                    SELECT COUNT(*) AS event_num
                    FROM feedback
                    JOIN userapps U ON U.Facebook_ID = feedback.feedback_user_id
                    where feedback.feedback_event_id = ".$event_id."
                ");
                                   
                $feedback = $feedbacks_query->fetch();

                $discussion_num = $feedback["event_num"];

                $participants_query = $connect->query("
                    SELECT COUNT(*) AS event_num
                    FROM joinevents
                    JOIN userapps U ON U.Facebook_ID = joinevents.usr_id
                    where event_id = ".$event_id."
                ");
                                   
                $participant = $participants_query->fetch();

                $participant_num = $participant["event_num"];

                $pictures_query = $connect->query("
                    SELECT COUNT(*) AS event_num
                    FROM picture
                    left join userapps U on U.Facebook_ID = usr_upload
                    where event_id = ".$event_id."
                ");
                                   
                $picture = $pictures_query->fetch();

                $picture_num = $picture["event_num"];

                $files_query = $connect->query("
                    SELECT COUNT(*) AS event_num
                    FROM files
                    left join userapps U on U.Facebook_ID = usr_upload
                    where file_event_id = ".$event_id."
                ");
                                   
                $file = $files_query->fetch();

                $file_num = $file["event_num"];
            ?>

        <script type="text/javascript">
            $(document).ready(function(){

                var participants_load = 0;
                var discussions_load = 0;
                var images_load = 0;
                var files_load = 0;

                var event_id = "<?php echo $event_id; ?>";

                var max_files = "<?php echo $file_num; ?>";
                var max_discussions = "<?php echo $discussion_num; ?>";
                var max_pictures = "<?php echo $picture_num; ?>";
                var max_participants = "<?php echo $participant_num; ?>";

                $('#participants_view').bind('scroll', function(){
                   if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight){
                        participants_load++;
                        if(participants_load * 20 <= max_participants){
                            $.post("participantsInfiniteScroll.php",{participants_load:participants_load, event_id:event_id},function(data){
                                $('#participants_view').append(data);
                            });
                        }     
                   }
                });

                $('#discussions_view').bind('scroll', function(){
                   if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight){
                        discussions_load++;
                        if(discussions_load * 10 <= max_discussions){
                            $.post("discussionsInfiniteScroll.php",{discussions_load:discussions_load, event_id:event_id},function(data){
                                $('#feedbackSearch').append(data);
                             });
                        } 
                   }
                });

                $('#images_load').bind('scroll', function(){
                   if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight){
                        images_load++;
                        if(images_load * 20 <= max_pictures){
                            $.post("picturesInfiniteScroll.php",{images_load:images_load, event_id:event_id},function(data){
                                $('#images_load').append(data);
                            });
                        }
                   }
                });

                $('#files_view').bind('scroll', function(){
                   if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight){
                        files_load++;
                        if(files_load * 10 <= max_files){
                            $.post("filesInfiniteScroll.php",{files_load:files_load, event_id:event_id},function(data){
                                $('#files_view').append(data);
                            });
                        }
                   }
                });
            });
        </script>
<div class="related_posts white_box">
    <a id="Participants"><h3 class="rp_title">Participants</h3></a>
    <div class="rp_col_wrapper clearfix" id="participants_view">
        
        <?php 

            $participants_query = $connect->query("
                SELECT * FROM joinevents
                JOIN userapps U ON U.Facebook_ID = joinevents.usr_id
                where event_id = ".$event_id."
                LIMIT 0, 20
            ");

            while($participant = $participants_query->fetch()){ ?>

            <div class="rp_col">
                <?php if(isset($_SESSION['usr_id']) && $participant["Facebook_ID"] == $sessionUser){
                    $piked = true;
                } ?>

                <?php if(isset($_SESSION['usr_id']) && $event["Facebook_ID"] == $sessionUser){ ?>
                    <a href="/userProfile.php?user_id=<?php echo $participant["Facebook_ID"]; ?>"><div style="text-align:center" class="small_thumb"><img src="/include/Profil_pictures/<?php echo $participant["picture_link"]; ?>" title="<?php echo $participant["usr_lname"] . ' ' . $participant["usr_fname"]; ?>"  /></a><a href="/deleteParticipants.php?event_id=<?php echo $event_id; ?>&amp;joinevent_id=<?php echo $participant["joinevent_id"]; ?>">remove</a></div>
                <?php }else{ ?>
                    <a href="/userProfile.php?user_id=<?php echo $participant["Facebook_ID"]; ?>"><div class="small_thumb"><img src="/include/Profil_pictures/<?php echo $participant["picture_link"]; ?>" title="<?php echo $participant["usr_lname"] . ' ' . $participant["usr_fname"]; ?>"  /></div></a>
                <?php } ?> 
            </div>
        <?php } ?>
        

    </div>
</div>  

<script type="text/javascript">

            function addFeedback(element, event_id, e) {
                var characterCode
                if(e && e.which){ // NN4 specific code
                    e = e
                    characterCode = e.which
                }
                else {
                    e = event
                    characterCode = e.keyCode // IE specific code
                }if (characterCode == 13){
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
    <a id="Discussions"><h3 class="rp_title">Discussions</h3></a>
    <div class="rp_col_wrapper clearfix" id="discussions_view">
            
        <div id="comment_tab" class="tab_content recent_comments" style="overflow: auto;">
                    <ul id="feedbackSearch">
                        <?php 

                            $feedbacks_query = $connect->query("
                                SELECT * FROM feedback
                                JOIN userapps U ON U.Facebook_ID = feedback.feedback_user_id
                                where feedback.feedback_event_id = ".$event_id."
                                ORDER BY feedback_time DESC
                                LIMIT 0, 10
                            ");

                            while($feedback = $feedbacks_query->fetch()){ ?>
                                <li><img src='/include/Profil_pictures/<?php echo $feedback["picture_link"]; ?>' class='avatar avatar-50 photo' height='50' width='50' /><p><cite><?php echo $feedback["usr_lname"] . ' '. $feedback["usr_fname"]; ?>:</cite> <em><?php echo $feedback["feedback_time"]; ?></em><br> <a href="#"><?php echo $feedback["feedback_message"]; ?></a></p>
                                <?php if(isset($_SESSION['usr_id']) && ($event["Facebook_ID"] == $sessionUser || $feedback["feedback_user_id"] == $sessionUser)){ ?>
                                    <em><a style="color:red" href="/deleteDiscussions.php?event_id=<?php echo $event_id; ?>&amp;feedback_id=<?php echo $feedback["feedback_id"]; ?>">remove</a></em>
                                <?php } ?> 
                                    <div class="clear"></div></li>
                            <?php } ?>

                    </ul><br>         

                </div>
                
    </div>
    <?php if(isset($_SESSION['usr_id']) && $piked){ ?>
        <div style="text-align: center">
            <form>
                <textarea type="text" placeholder="say what you think ;)" style="width:756px; height:131px" onkeydown="addFeedback(this, <?php echo $event_id ?>, event)"></textarea><br>
            </form>
        </div> 
    <?php } ?>
</div>

<div class="related_posts white_box">
    <a id="Pictures"><h3 class="rp_title">Pictures</h3></a>
    <div class="rp_col_wrapper clearfix" id="pictures_view">
        <?php 

            $pictures_query = $connect->query("
                SELECT * FROM picture
                left join userapps U on U.Facebook_ID = usr_upload
                where event_id = ".$event_id."
                LIMIT 0, 20
            ");

            while($picture = $pictures_query->fetch()){ ?>
                <div class="rp_col">
                    <div class="small_thumb" style="text-align:center"><a href="/img/upload/pictures/<?php echo $picture["pic_link"]; ?>" class="icon view fancybox"><img src="/img/upload/pictures/<?php echo $picture["pic_link"]; ?>"/></a><em>Uploaded by<br><strong><?php echo $picture["usr_lname"] . ' '. $picture["usr_fname"]; ?></strong></em>
                        <?php if(isset($_SESSION['usr_id']) && ($event["Facebook_ID"] == $sessionUser || $picture["Facebook_ID"] == $sessionUser)){ ?>
                            <br><em><a style="color:red" href="/deleteEventPicture.php?event_id=<?php echo $event_id; ?>&amp;picture_id=<?php echo $picture["picture_id"]; ?>">remove</a></em>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>

    </div>
    <?php if(isset($_SESSION['usr_id']) && $piked){ ?>
        <div style="text-align:center">
            <br>
            <form action="/addEventPicture.php?event_id=<?php echo $event_id ?>" method="post" enctype="multipart/form-data">
                <label> Limitted size is 10Mb and only jpeg, jpg, pjpeg, x-png, and png are allowed</label>
                <input type="file" name="file"><br><br>
                <input class="button gray small" type="submit" name="submit" value="Upload Picture"><br><br>
            </form>
        </div>
    <?php } ?>
</div>

<div class="related_posts white_box">
    <a id="Files"><h3 class="rp_title">Files</h3></a>
    <div class="rp_col_wrapper clearfix" id="files_view">

        <?php 

            $files_query = $connect->query("
                SELECT * FROM files
                left join userapps U on U.Facebook_ID = usr_upload
                where file_event_id = ".$event_id."
                LIMIT 0, 10
            ");

            while($file = $files_query->fetch()){ ?>
                <div class="rp_col" style="width:100%; height:100px">
                    <div class="pdf_small_thumb"><?php echo $file["file_name"]; ?><br><strong>Uploaded by <?php echo $file["usr_lname"] . ' ' . $file["usr_fname"]; ?></strong><br><a href="/img/upload/files/<?php echo $file["file_link"]; ?>" target="_blank">
                    <?php if($piked == 1){ ?>
                        <em style="color:blue">view</em>
                    <?php } ?>
                    </a>
                    <?php if(isset($_SESSION['usr_id'])&& ($event["Facebook_ID"] == $sessionUser || $file["Facebook_ID"] == $sessionUser)){ ?>
                        <br><em><a style="color:red" href="/deleteEventFile.php?event_id=<?php echo $event_id; ?>&amp;file_id=<?php echo $file["file_id"]; ?>">remove</a></em>
                    <?php } ?>
                    </div>
                </div>
            <?php } ?>
    </div>
    <?php if(isset($_SESSION['usr_id']) && $piked){ ?>
        <div style="text-align:center">
            <br>
            <form action="/addEventFile.php?event_id=<?php echo $event_id ?>" method="post" enctype="multipart/form-data">
                <label>only pdf is allowed<br> Limitted size is 10Mb and only pdf, ppt, doc, docx, and pptx are allowed</label>
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

<?php if (isset($_SESSION['usr_id'])) { ?>
        <div id="sidebar">

            <script type="text/javascript">
            jQuery(function($){

                $('.month').hide();
                var current = parseInt("<?php echo $qmonth; ?>");
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
                        <td colspan="3"><a href="/add.php">Add a Pike ?</a></td>
                        <td colspan="2" id="monthNext"><a href="#">&raquo;</a></td>
                    </tr>
                    <tr>
                        <td colspan="2" id="monthPrev"><a href="#"></a></td>
                        <td colspan="3" id="monthPrev"><a href="/logout.php">logout</a></td>
                        <td colspan="2" id="monthNext"><a href="#"></a></td>   
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

        <?php
            $participated_query = $connect->query("
                SELECT count(*) AS participanted FROM friends
                where user_other = " . $event['usr_create'] . " and user_me = " . $sessionUser . " and friend_request = 'Friends'
            ");
            
            if($follow = $participated_query->fetch()){
                if($follow["participanted"] > 0 || $sessionUser == $event["usr_create"]){?>
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

                <script type="text/javascript">
                    $(document).ready(function(){

                        var contact_load = 0;
                        var event_id = "<?php echo $event_id; ?>"

                        $('#invitationSearch').bind('scroll', function(){
                           if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight){
                                contact_load++;
                                $.post("invitationInfiniteScroll.php",{contact_load:contact_load, event_id:event_id},function(data){
                                    $('#invitationSearch').append(data);
                                });
                           }
                        });
                    });

                </script>

                <div class="widget widget_invitations white_box"><h3 class="widget_title">Send Invitations</h3>
                    <form>
                        <input type="text" placeholder="click here to start searching in your contacts" onkeyup="showinvitations(this.value, <?php echo $event_id; ?>)">
                    </form> 
                            <ul class="ul_scrolling" id="invitationSearch">
                                <?php      
                                    require_once('connect.php');

                                    $invitations_query = $connect->query("
                                        SELECT * 
                                        FROM  friends 
                                        JOIN userapps U ON U.Facebook_ID = friends.user_other
                                        WHERE user_me = $sessionUser AND friend_request = 'Friends' and friends.user_other NOT IN (SELECT notification_user from notification where event_id = $event_id)
                                        and friends.user_other NOT IN (SELECT joinevents.usr_id from joinevents where event_id = $event_id)
                                        LIMIT 0, 5
                                    ");

                                    while($invitation = $invitations_query->fetch()){
                                ?>
                                    <li ><img alt='' src='/include/Profil_pictures/<?php echo $invitation["picture_link"]; ?>' class='avatar avatar-50 photo' height='50' width='50' />
                                        <p><cite><?php echo $invitation["usr_lname"] . ' ' . $invitation["usr_fname"] ?></cite><br><a href="/pike_invitation.php?event_id=<?php echo $event_id ?>&amp;user_invited=<?php echo $invitation["Facebook_ID"]; ?>" style="width:55%;margin-top:10px;text-align:center;" class="button blue small">Invite</a><div class='clear'><br></li>
                                 <?php } ?>

                            </ul>
                </div> 
        <?php }
            }
        ?> 

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

            function TabsUpdate(){
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp=new XMLHttpRequest();
                    } else {  // code for IE6, IE5
                        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                    }
                      
                    xmlhttp.onreadystatechange=function() {
                        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                            document.getElementById("chatTabUptdate").innerHTML=xmlhttp.responseText;
                        }
                    }
              
                    xmlhttp.open("GET","tabUpdate.php",true);
                    xmlhttp.send();

            }
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
                                TabsUpdate();
                            }
                        }
                    
                    xmlhttp.open("GET","chatFetch.php?q="+user_sender,true);
                    xmlhttp.send();

                    jQuery(document).ready(function($){ 
                        $('#contactSearch').hide();
                        $('#contactSearchForm').hide();
                        $('#chatBox').show();
                        $('#chatBoxForm').show(); 
                     });            
            }

            function sendChat(element, e) {
                var characterCode
                if(e && e.which){ // NN4 specific code
                    e = e
                    characterCode = e.which
                }
                else {
                    e = event
                    characterCode = e.keyCode // IE specific code
                }if (characterCode == 13){
                    if (window.XMLHttpRequest) {
                        // code for IE7+, Firefox, Chrome, Opera, Safari
                        xmlhttp=new XMLHttpRequest();
                    } else {  // code for IE6, IE5
                        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                    }

                    xmlhttp.onreadystatechange=function() {
                        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
                            document.getElementById("chatBox").innerHTML=xmlhttp.responseText;
                            TabsUpdate();
                        }
                        element.value = '';
                    }
                      
                    xmlhttp.open("GET","chatSend.php?q="+userSender+"&post="+element.value,true);
                    xmlhttp.send();
                }          
            }

            function returnContact(){
                jQuery(document).ready(function($){
                    contactResult("");
                    $('#chatBoxForm').hide();
                    $('#chatBox').hide();
                    $('#contactSearchForm').show();
                    $('#contactSearch').show();
                });
            }
            
            $(document).ready(function(){

                var chat_load = 0;
                var contact_load = 0;

                $('#contactSearch').bind('scroll', function(){
                   if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight){
                        contact_load++;
                        $.post("contactInfiniteScroll.php",{contact_load:contact_load},function(data){
                            $('#contactSearch').append(data);
                        });
                   }
                });

                $('#chatBox').bind('scroll', function(){
                   if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight){
                        chat_load++;
                        console.log(userSender, chat_load);
                        $.post("chatInfiniteScroll.php",{chat_load:chat_load, userSender: userSender},function(data){
                            $('#chatBox').append(data);
                        });
                   }
                });
            });
        </script>

        <div class="widget widget_invitations white_box">
            <div id="chatTabUptdate"><?php
                require_once('connect.php');
                $newUpdate_query = $connect->query("
                    SELECT count(*) as new_chat from friends where sent_chat = 'yes' and user_me = $sessionUser  AND friend_request = 'Friends'
                ");

                if($newUpdate = $newUpdate_query->fetch()){ 
                        if($newUpdate["new_chat"] > 0){
                    ?>
                        <h3 class="widget_title">Chats<span style="background-color:red; padding:1px 3px 1px 3px; margin-left:4px; color: white;border-radius: 10px;border-color: rgb(10, 10, 10);box-shadow: 2px 2px 2px #888888;"><?php echo $newUpdate["new_chat"] ?></span></a></h3>
                <?php }else{ ?>
                        <h3 class="widget_title"><a href="#comment_tab" id="notif_tab">Chats</a></h3>
                <?php }} ?>
            </div>
                    <form id="contactSearchForm">
                            <input type="text" placeholder="Search Contacts by Last Name ..." onkeyup="contactResult(this.value)">
                    </form>

                    <div id='chatBoxForm'>
                        <a class='button red full' onclick='returnContact()'>Return to contacts</a>
                        <textarea placeholder='send your message here' onkeydown='sendChat(this, event)'></textarea>
                    </div>

                    <ul class="ul_scrolling" id="contactSearch">
                        
                        <?php      
                            require_once('connect.php');

                            $contact_query = $connect->query("
                                SELECT * 
                                FROM  friends 
                                JOIN userapps U ON U.Facebook_ID = friends.user_other  AND friend_request = 'Friends'
                                WHERE user_me =$sessionUser
                                ORDER BY last_chat DESC
                                LIMIT 0,5
                            ");

                        while($contact = $contact_query->fetch()){
                            if($contact['sent_chat'] == "yes"){ ?>
                                <li style="background-color:rgb(255, 226, 226)">
                            <?php }else{ ?>
                                <li >
                            <?php } ?>
                                    <img alt='' src='/include/Profil_pictures/<?php echo $contact["picture_link"]; ?>' class='avatar avatar-50 photo' height='50' width='50' />
                                    <p>
                                        <cite><a href="/userProfile.php?user_id=<?php echo $contact["user_other"]; ?>"><?php echo $contact["usr_lname"]; ?> <?php echo $contact["usr_fname"]; ?></a></cite><br>
                                        <em style="cursor:pointer" onclick="chatResult(<?php echo $contact["user_other"]; ?>)">click to view conversation</em>
                                    </p>
                                    <div class="clear"></div>
                                </li>
                            <?php } ?>
                    </ul>
                    <ul class="ul_scrolling"  id="chatBox">
                        
                    </ul>                          

        </div>

        <script type="text/javascript">
            $(document).ready(function(){

                var pikes_load = 0;
                var notifications_load = 0;

                $('#notifsSearch').bind('scroll', function(){
                   if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight){
                        notifications_load++;
                        $.post("notificationInfiniteScroll.php",{notifications_load:notifications_load},function(data){
                            $('#notifsSearch').append(data);
                        });
                   }
                });

                $('#PikesSearch').bind('scroll', function(){
                   if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight){
                        pikes_load++;
                        $.post("pikesInfiniteScroll.php",{pikes_load:pikes_load},function(data){
                            $('#PikesSearch').append(data);
                        });
                   }
                });
            });
        </script>

        
        
        <!-- BEGIN WIDGET -->
        <div class="widget tab_wrapper white_box" id="tab_wrapper_tab_widget-2">
            <?php 
                require_once('connect.php');
                $newUpdate_query = $connect->query("
                    SELECT count(*) as new_notif from notification where notification_status = 'new' and notification_user = $sessionUser
                ");
            ?>

            <ul class="tab_menu">
                <?php if($newUpdate = $newUpdate_query->fetch()){ 
                        if($newUpdate["new_notif"] > 0){
                    ?>
                        <li class="tab_post" >
                            <a href="#post_tab" id="notif_tab">News<span style="background-color:red; padding:1px 3px 1px 3px; margin-left:4px; color: white;border-radius: 10px;border-color: rgb(10, 10, 10);box-shadow: 2px 2px 2px #888888;"><?php echo $newUpdate["new_notif"] ?></span></a>
                        </li>
                    <?php }else{ ?>
                        <li class="tab_post">
                            <a href="#post_tab" id="notif_tab">News</a>
                        </li>
                <?php }} ?>
                
                    <li class="tab_tag"><a href="#tag_tab">Pikes</a></li></ul>
                    <div class="clear"></div>
                    <div class="tabs_container">
                    <div id="post_tab" class="tab_content recent_posts">
                    <form>
                        <input type="text" placeholder="Click to search in your notifications ..." onkeyup="notifsResult(this.value)">
                    </form>
                    <ul class="ul_scrolling" id="notifsSearch">
                        <?php      
                            require_once('connect.php');

                            $notification_query = $connect->query("
                                SELECT * 
                                FROM  notification 
                                WHERE notification_user =$sessionUser
                                ORDER BY notification_time DESC
                                LIMIT 0, 10
                            ");

                            while($notification = $notification_query->fetch()){
                                if($notification['notification_status'] == "new"){ ?>
                                    <li style="background-color:rgb(255, 226, 226)">
                                        
                                        <?php if($notification['notification_type'] == "Event"){ ?>
                                            <a href="/notificationUpdate.php?event_id=<?php echo $notification['event_id'] ?>" class="small_thumb">
                                            <img src="img/upload/events/<?php echo $notification['notification_image'] ?>" width="50" height="50">
                                            </a>
                                            <a href="/notificationUpdate.php?event_id=<?php echo $notification['event_id'] ?>" class="title"><?php echo $notification['notification_title'] ?></a><em><?php echo $notification['notification_time'] ?></em><div class="clear"></div>   
                                            </a> 
                                        <?php }else{ ?>
                                            <a href="/notificationUpdate.php?user_id=<?php echo $notification['sender_id'] ?>" class="small_thumb">
                                            <img src="/include/Profil_pictures/<?php echo $notification['notification_image'] ?>" width="50" height="50">
                                            </a>
                                            <a href="/notificationUpdate.php?user_id=<?php echo $notification['sender_id'] ?>" class="title"><?php echo $notification['notification_title'] ?></a><em><?php echo $notification['notification_time'] ?></em><div class="clear"></div>   
                                            </a> 
                                        <?php } ?>
                                <?php }else{ ?>
                                    <li>
                                        
                                        
                                        <?php if($notification['notification_type'] == "Event"){ ?>
                                                <a href="/view.php?event_id=<?php echo $notification['event_id'] ?>" class="small_thumb">
                                                <img src="img/upload/events/<?php echo $notification['notification_image'] ?>" width="50" height="50">
                                                </a>
                                                <a href="/view.php?event_id=<?php echo $notification['event_id'] ?>" class="title"><?php echo $notification['notification_title'] ?></a><em><?php echo $notification['notification_time'] ?></em><div class="clear"></div>   
                                                </a>
                                        <?php }else{ ?>
                                                <a href="/userProfile.php?user_id=<?php echo $notification['sender_id'] ?>" class="small_thumb">
                                                <img src="/include/Profil_pictures/<?php echo $notification['notification_image'] ?>" width="50" height="50">
                                                </a>
                                                <a href="/userProfile.php?user_id=<?php echo $notification['sender_id'] ?>" class="title"><?php echo $notification['notification_title'] ?></a><em><?php echo $notification['notification_time'] ?></em><div class="clear"></div>   
                                                </a>
                                        <?php } ?>

                                     
                                <?php } ?>
                                    
                                    </li>
                            <?php } ?>
                        
                    </ul>                         
                </div>
                                
    
                                
                  <div id="tag_tab" class="tab_content recent_posts">

                    <form>
                        <input type="text" placeholder="Click to search your pikes ..." onkeyup="pikesResult(this.value)">
                    </form>
                    <ul id="PikesSearch" class="ul_scrolling">
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
                                LIMIT 0, 10
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
                    $('#interestsForm').show();
                    $('#createButton').hide();
                });
            }

            function addInterest(element, e) {
                var characterCode
                if(e && e.which){ // NN4 specific code
                    e = e
                    characterCode = e.which
                }
                else {
                    e = event
                    characterCode = e.keyCode // IE specific code
                }if (characterCode == 13){
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
                        $('#createButton').show();
                        $('#interestsForm').hide();
                      });
                }
            }

        </script>

        <script type="text/javascript">
            $(document).ready(function(){
                var load = 0;
                $('#categorySearch').bind('scroll', function(){
                   if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight){
                        load++;
                        $.post("interestInfiniteScroll.php",{load:load},function(data){
                            $('#categorySearch').append(data);
                        });
                   }
                });
            });
        </script>

        <div id="categories-3" class="widget widget_categories white_box"><h3 class="widget_title">Interests</h3>
            <form>
                <input type="text" placeholder="click here to start searching in communities" onkeyup="showResult(this.value)">
            </form> 
                    <ul class="ul_scrolling" id="categorySearch">
                        <?php      
                            require_once('connect.php');

                            $interests_query = $connect->query("
                                SELECT *
                                FROM interests
                                ORDER BY interest_score DESC, interest_name ASC
                                LIMIT 0, 10
                            ");

                            while($interest = $interests_query->fetch()){
                        ?>
                            <li class="cat-item cat-item-2"><a href="/events.php?interest=<?php echo $interest['interest_id'] ?>"><?php echo $interest['interest_name'] ?></a></li>
                        <?php } ?>

                    </ul>
                    
                    <div id='interestsForm'>
                        <textarea placeholder='enter your interest' onkeyup='addInterest(this, event)'></textarea>
                    </div>
                    <a id="createButton" class="button red full" onclick='showTextBox()'>New Interest</a>
        </div>
        
        
        <div id="footer">
            <div class="container clearfix">
                <div style="text-align:center">&copy; 2014 <a href="/events.php">PikeLife</a> - <a href="/contactUs.php">Contact Us</a></div>
                <div class="clear"></div>
            </div>
        </div>
        
        </div>
    <?php } ?>
</div><!-- #main -->
    

<div id="toTop"><a href="#">TOP</a></div>   
</body>
</html>
