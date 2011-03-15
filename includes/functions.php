<?php

function get_settings($keys='')
{
    #pass
}

function get_messages($limit=20)
{
    $select_message_query = "SELECT * FROM `MESSAGES` WHERE `enabled` = 1 order by updated desc limit $limit";
    $result = db_query($select_message_query);
    $messages = null;
    while($mes = db_fetch_array($result)) 
    {
    	//Return each page title seperated by a newline.
        $message = new Message();	
        $message->id = $mes['id'];
        $message->content = $mes['content'];
        $message->maxitems = $mes['mood'];
        $messages[] = $message;
    }
    return $messages;
}

function insert_message($message)
{
   if(!$message) return false;
   $content = $message->content;
   $mood = $message->mood;
   
   $insert_message_query = "INSERT INTO `MESSAGES` (`content`, `updated` , `mood`, `enabled`) values ('$content' , now(), '$mood', 1)";
    $result = db_query($insert_message_query);
    return $result;
}

?>