<?php

namespace PHPLinkTester\Entities\Request;

use PHPLinkTester\Entities\Response\RequestResponse;

interface RequestTypeInterface
{
  public function isAValidRequest(string $requestType): bool;
}