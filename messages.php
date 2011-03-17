<?php

if ($messages)
foreach ($messages as $message) 
{
    echo "<div class='message $message->mood' id='$message->id'>";
    echo $message->content;
    echo "</div>";
}

?>