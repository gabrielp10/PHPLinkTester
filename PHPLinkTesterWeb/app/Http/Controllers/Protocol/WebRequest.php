<?php

namespace App\Http\Controllers\Protocol;


abstract class WebRequest
{
    public function __construct(protected ?WebRequest $nextRequest) { }

    abstract public function validateRequestType(string $method);
}
