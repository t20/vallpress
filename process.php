<?php

include 'models.php';
include 'config.php';
include 'includes/database.php';
include 'includes/functions.php';


    $message = new message();
    $message->content = $_POST['message_box'];
    $message->mood = $_POST['mood'];

    $result = insert_message($message);

    $out['id'] = $result;

    if ($result)
        $out['message'] = "<div class='message $message->mood hidden' id='$result'>" .
        "$message->content" .
        "</div>";
    else
        $out['message'] = '';

    echo json_encode($out);

?>