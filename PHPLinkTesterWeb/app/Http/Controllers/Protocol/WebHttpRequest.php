<?php

namespace App\Http\Controllers\Protocol;

use PHPLinkTester\Entities\Request\HttpRequest;

class WebHttpRequest extends WebRequest
{
    public function validateRequestType(string $method)
    {
      if ($method === 'HTTP') {
        return new HttpRequest();
      }

      return $this->nextRequest->validateRequestType($method);
    }
}
