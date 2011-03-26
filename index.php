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
                        $("#write").fadeIn("slow");
                    else
                        $("#write").fadeOut("slow");
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
            <div id="add_message">
               <input type="button" name="add_message" value="Add Message" id="add_message"/>
               <input type="hidden" name="add_message_status" value="0" id="add_message_status"/>
            </div>
            <div id="write">
                <form action="process.php" method="POST" id="write_form">
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
                <?php 
                    include 'models.php';
                    $messages = get_messages();
                ?>
                <?php include 'messages.php'; ?>
            </div>
        </div><!--end wrapper-->
    </body>
</html>