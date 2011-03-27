<?php

include 'config.php';
if (!defined('CONFIG')) 
{
    header("Location: install/index.php");
}

include 'includes/database.php';
$connected = db_connect();
if (!$connected)
{
   header("Location: dberror.php");
}
?>

<html>
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <title>{{Sitename}}</title>
        <link rel="stylesheet" href="style.css" type="text/css" media="screen" title="no title" charset="utf-8">
        <script src="static/js/jquery-1.4.4.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="static/js/jquery-ui-1.8.10.custom.min.js" type="text/javascript" charset="utf-8"></script>
        <script >
        	$(function() {
        		$( "#moods" ).buttonset();
        		$("#add_message").click(function () 
        		{
                    var newval = ($("#add_message_status").val() == 0)? 1 : 0;
                    $("#add_message_status").val(newval);
                    if (newval)
                    {
                        $("#write_form").fadeIn("slow");
                        $('#add_message').val('Hide Write Controls');
                    }
                    else
                    {
                        $("#write_form").fadeOut("slow");
                        $('#add_message').val('Add Message');
                    }
                });
                $("#write_form").submit(function (event) {
                    event.preventDefault();
                    $.post ( 'process.php',
                            $(this).serialize(),
                            function(data) { 
                                if (data['id'])
                                $('#content').prepend(data['message']);
                                $('.hidden').show('slow');
                            } ,
                            'json'
                           );
                });
                $('#refresh').click(function() {
                    
                });
        	});
        </script>
    </head>
    <body>
        <div id="wrapper">
            <div id="header">
                <h1>{{SITENAME}}</h1>
                <h3>{{TAGLINE}}</h3>
                <h3>{{GIVE FEEDBACK MESSAGE}}</h3>
            </div>
            <div id="add_message_control">
               <input type="button" name="add_message" value="Add Message" id="add_message"/>
               <input type="hidden" name="add_message_status" value="0" id="add_message_status"/>
            </div>
            <div id="write">
                <form action="process.php" method="POST" id="write_form">
                   <div id="moods">
                       <input type="radio" name="mood" class="ui-helper-hidden-accessible" id="radio1" value="great" checked="checked">
                       <label for="radio1" role="button" ><img src="static/images/moods/great.png"/></label>
                        <input type="radio" name="mood" class="ui-helper-hidden-accessible" id="radio2" value="good" >
                        <label for="radio2" role="button" ><img src="static/images/moods/smile.png"/></label>
                        <input type="radio" name="mood" class="ui-helper-hidden-accessible" id="radio3" value="sad" >
                        <label for="radio3"  role="button" ><img src="static/images/moods/sad.png"/></label>
                        <input type="radio" name="mood" class="ui-helper-hidden-accessible" id="radio4" value="bad" >
                        <label for="radio4"  role="button" ><img src="static/images/moods/bad.png"/></label>
                   </div>
                   <textarea name="message_box" id="message_box"></textarea>
                   <p><input type="submit" value="Write" name="submit"></p>
               </form>
            </div>
            <div id="stats">
                <?php
                    include 'includes/functions.php';
                    $stats = get_moods_stats();
                    foreach ($stats as $mood => $count) {
                        echo "$mood : $count " ;
                    }
                ?>
            </div>
            <div class="clear"></div>
            <div id="content">
                <input type="button" name="refresh" value="Refresh" id="refresh"/>
                <?php 
                    include 'models.php';
                    $messages = get_messages();
                ?>
                <?php include 'messages.php'; ?>
            </div>
        </div><!--end wrapper-->
    </body>
</html>