<?php

    if ($messages)
    foreach ($messages as $message) 
    {
        ?>
        <div class='amessage'>
        <div class='message <?php echo $message->mood; ?>' 
            id='<?php echo $message->id; ?>'>";
        <?php echo $message->content; ?>
        </div>";
        <div class='actions'>
        <input type="button" name="disable" value="Disable" id="disable"/>
        <input type="button" name="Delete" value="Delete" id="Delete"/>
        </div>
        </div>
<?php 
    }
?>