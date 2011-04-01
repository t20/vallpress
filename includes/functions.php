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

function get_messages($start = 0, $limit=20)
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

function filter($data) 
{
    $data = trim(htmlentities(strip_tags($data)));	
    if (get_magic_quotes_gpc())
        $data = stripslashes($data);
    $data = mysql_real_escape_string($data);
    return $data;
}

function is_logged_in()
{
    session_start();

    if (isset($_SESSION['HTTP_USER_AGENT']))
    {
        if ($_SESSION['HTTP_USER_AGENT'] != md5($_SERVER['HTTP_USER_AGENT']))
        {
            logout();
            exit;
        }
    }

    if (!isset($_SESSION['user_id']) && !isset($_SESSION['user_name']) ) 
    {
    	if(isset($_COOKIE['user_id']) && isset($_COOKIE['user_key']))
    	{
        	$cookie_user_id  = filter($_COOKIE['user_id']);
        	$rs_ctime = mysql_query("select `ckey`,`ctime` from `users` where `id` ='$cookie_user_id'") or die(mysql_error());
        	list($ckey,$ctime) = mysql_fetch_row($rs_ctime);
        	// coookie expiry
        	if( (time() - $ctime) > 60*60*24*2) 
        	{
        		logout();
        	}
    	
        	if( !empty($ckey) && is_numeric($_COOKIE['user_id']) && isUserID($_COOKIE['user_name']) && $_COOKIE['user_key'] == sha1($ckey))
        	{
        	    session_regenerate_id(); //against session fixation attacks.
                $_SESSION['user_id'] = $_COOKIE['user_id'];
                $_SESSION['user_name'] = $_COOKIE['user_name'];
                $_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
        	}
        	else
        	{
        	    header("Location: login.php");
        	    exit;
        	    logout();
        	}
        }
        else   
        {
        	header("Location: login.php");
        	exit;
        }
    }
}

function logout()
{
    if(isset($_SESSION['user_id']) || isset($_COOKIE['user_id'])) 
    {
        mysql_query("update `users` 
    			set `ckey`= '', `ctime`= '' 
    			where `id`='$_SESSION[user_id]' OR  `id` = '$_COOKIE[user_id]'") or die(mysql_error());
    }			

    /************ Delete the sessions****************/
    session_start();
    $_SESSION = array();
    session_unset();
    session_destroy();

    /* Delete the cookies*******************/
    setcookie("user_id", '', time()-60*60*24*2, "/");
    setcookie("user_name", '', time()-60*60*24*2, "/");
    setcookie("user_key", '', time()-60*60*24*2, "/");

    header("Location: login.php");
}

function isUserID($username)
{
	if (preg_match('/^[a-z\d_]{5,20}$/i', $username)) {
		return true;
	} else {
		return false;
	}
}

?>