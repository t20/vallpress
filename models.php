<?php

/**
* Simple model file for holding a message
*/
class Message
{
    public $id;
    public $content;
    public $updated;
    public $mood;
    public $user = null;

}

class Mood 
{
    public $id;
    public $mood;
    public $image;
}

?>