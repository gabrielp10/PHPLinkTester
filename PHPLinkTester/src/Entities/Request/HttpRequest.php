<?php

namespace PHPLinkTester\Entities\Request;


class HttpRequest implements RequestTypeRepository
{
  public function isAValidRequest(string $request): bool
  {
    $types = [
      'GET', 'POST', 'PATCH', 'PUT', 'DELETE'
    ];

    return in_array($request, $types);
  }
}