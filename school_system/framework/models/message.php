<?php
class App_Message {
    public function __construct($success, $message="") 
    {
        $this->success = $success;
        $this->message = $message;
    }
}
?>