<?php

function get_settings($keys)
{
    $select_settings_query = "select setting,value from settings where setting in ('sitename', 'tagline','username', 'password')";
    $result = db_query($select_settings_query);
    $settings = array();
    while($row = db_fetch_array($result))
    {
        $setting = $row['setting'];
        $settings[$setting] = $row['value'];
    }
    return $settings;
}

function get_messages($limit=20)
{
    $select_message_query = "SELECT * FROM `MESSAGES` WHERE `enabled` = 1 order by updated desc limit $limit";
    $result = db_query($select_message_query);
    $messages = null;
    while($mes = db_fetch_array($result)) 
    {
        $message = new Message();	
        $message->id = $mes['id'];
        $message->content = $mes['content'];
        $message->mood = $mes['mood'];
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
    if ($result)
        return db_insert_id();
    else 
        return false;
}

function get_moods_stats()
{
    $select_moods_query = "SELECT `mood`, count(*) as count FROM `MESSAGES` WHERE `enabled` = 1 GROUP BY `mood`";
    $result = db_query($select_moods_query);
    $moods = array();
    while($mood = db_fetch_array($result)) 
    {
        //create associate array of mood => count
        $moods[$mood['mood']] = $mood['count'];
    }
    return $moods;
}
?>