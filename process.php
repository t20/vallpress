<?php

include 'models.php';
include 'config.php';
include 'includes/database.php';
include 'includes/functions.php';

if ($_POST['submit'] == 'Write')
{
   $message = new message();
   $message->content = $_POST['message_box'];
   $message->mood = $_POST['mood'];
   
   $result = insert_message($message);
   
   echo "Result:" . $result;
   
}

?>