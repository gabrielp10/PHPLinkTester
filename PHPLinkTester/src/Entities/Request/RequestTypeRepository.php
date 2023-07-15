<?php

namespace PHPLinkTester\Entities\Request;

interface RequestTypeRepository
{
  public function isAValidRequest(string $requestType): bool;
}