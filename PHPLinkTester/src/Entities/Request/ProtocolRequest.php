<?php

namespace PHPLinkTester\Entities\Request;


class ProtocolRequest implements RequestTypeRepository
{
  public function isAValidRequest(string $request): bool
  {
    $types = [
      'SSH', 'FTP', 'SMTP', 'POP3', 'IMAP'
    ];

    return in_array($request, $types);
  }
}