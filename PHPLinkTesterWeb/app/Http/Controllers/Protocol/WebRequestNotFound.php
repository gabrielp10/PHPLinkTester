<?php

namespace App\Http\Controllers\Protocol;

class WebRequestNotFound extends WebRequest
{
    public function __construct()
    {
      parent::__construct(null);
    }

    public function validateRequestType(string $method): \InvalidArgumentException
    {
      throw new \InvalidArgumentException('Request type not valid!');
    }
}
