<?php

declare(strict_types=1);

namespace APP\Exceptions;

use Exception;

class ClientException extends Exception
{
    public function __construct(string $message, int $code)
    {
        parent::__construct($message, $code);
    }
}