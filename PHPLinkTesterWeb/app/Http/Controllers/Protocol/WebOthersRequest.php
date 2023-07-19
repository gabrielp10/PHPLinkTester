<?php

namespace App\Http\Controllers\Protocol;

use PHPLinkTester\Entities\Request\ProtocolRequest;

class WebOthersRequest extends WebRequest
{
    public function validateRequestType(string $method)
    {
      if ($method === 'OTHERS') {
        return new ProtocolRequest();
      }

      return $this->nextRequest->validateRequestType($method);
    }
}
