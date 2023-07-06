<?php

namespace App\Exceptions;

use Exception;

class ApiException extends Exception
{
    private $_messages;

    public function __construct($message, $code = 0, Exception $previous = null, $messages = [])
    {
        parent::__construct($message, $code, $previous);
        if (!empty($messages)) {
            $this->_messages = $messages;
        } else {
            $this->_messages = $message;
        }
    }

    public function getMessages()
    {
        return $this->_messages;
    }
}
