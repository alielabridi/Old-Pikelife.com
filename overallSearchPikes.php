<?php  

        $search_query = $_GET['search_query'];

        require_once('connect.php');

        session_start();
        if(isset($_SESSION['usr_id'])){
            $sessionUser = $_SESSION['usr_id'];
        }else{
            header( "Location: /") ;  
        }
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

    <style type="text/css">
            .ul_scrolling{
                overflow-x:hidden;
                height: 450px;
                -webkit-box-shadow: inset 0px -33px 35px -13px rgba(0,0,0,0.25);
                -moz-box-shadow: inset 0px -33px 35px -13px rgba(0,0,0,0.25);
                box-shadow: inset 0px -33px 35px -13px rgba(0,0,0,0.25);

            }

            #participants_view{
                overflow-x:hidden;
                height: 600px;
                -webkit-box-shadow: inset 0px -33px 35px -13px rgba(0,0,0,0.25);
                -moz-box-shadow: inset 0px -33px 35px -13px rgba(0,0,0,0.25);
                box-shadow: inset 0px -33px 35px -13px rgba(0,0,0,0.25);
            }
            #discussions_view{
                overflow-x:hidden;
                height: 600px;
                -webkit-box-shadow: inset 0px -33px 35px -13px rgba(0,0,0,0.25);
                -moz-box-shadow: inset 0px -33px 35px -13px rgba(0,0,0,0.25);
                box-shadow: inset 0px -33px 35px -13px rgba(0,0,0,0.25);
            }
            #pictures_view{
                overflow-x:hidden;
                height: 600px;
                -webkit-box-shadow: inset 0px -33px 35px -13px rgba(0,0,0,0.25);
                -moz-box-shadow: inset 0px -33px 35px -13px rgba(0,0,0,0.25);
                box-shadow: inset 0px -33px 35px -13px rgba(0,0,0,0.25);
            }
            #files_view{
                overflow-x:hidden;
                height: 600px;
                -webkit-box-shadow: inset 0px -33px 35px -13px rgba(0,0,0,0.25);
                -moz-box-shadow: inset 0px -33px 35px -13px rgba(0,0,0,0.25);
                box-shadow: inset 0px -33px 35px -13px rgba(0,0,0,0.25);
            }

        </style>

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

            <?php } ?>
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
                    

                    

        <script type="text/javascript">
            $(document).ready(function(){

                var participants_load = 0;
                var search_query = "<?php echo $search_query; ?>"

                $('#participants_view').bind('scroll', function(){
                   if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight){
                        participants_load++;
                        $.post("overallPikesSearchInfiniteScroll.php",{participants_load:participants_load, search_query:search_query},function(data){
                            $('#participants_view').append(data);
                        });
                   }
                });
            });
        </script>
<div class="related_posts white_box">
    <a id="Participants"><h3 class="rp_title">Search results of pikes having in their name '<?php echo $search_query; ?>'</h3></a>
    <div class="rp_col_wrapper clearfix" id="participants_view">
        
        <?php 
            $search_query =  mysql_real_escape_string($search_query);
            $pikes_query = $connect->query("
                SELECT * 
                FROM  events 
                WHERE event_name LIKE '%$search_query%' and event_type != 'Secret'
                ORDER BY event_name DESC
                LIMIT 0, 100
            ");

            while($picture = $pikes_query->fetch()){ ?>
                <div class="rp_col">
                    <div class="small_thumb" style="text-align:center"><a href="/view.php?event_id=<?php echo $picture["event_id"]; ?>"><img src="/img/upload/events/<?php echo $picture["event_pic"]; ?>"/></a><em><strong><?php echo $picture["event_name"]; ?></strong></em></div>
                </div>
            <?php } ?>
        

    </div>
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
                        <textarea placeholder='send your message here' onkeydown='sendChat(this)'></textarea>
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
                            ?>
                             <?php if($contact['sent_chat'] == "yes"){ ?>
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
                        <textarea placeholder='enter your interest' onkeyup='addInterest(this)'></textarea>
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
</div><!-- #main -->
    

<div id="toTop"><a href="#">TOP</a></div>   
</body>
</html>
