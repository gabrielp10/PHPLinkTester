<?php

namespace PHPLinkTester\Application\Request;

use PHPLinkTester\Entities\Request\Request;
use PHPLinkTester\Entities\Request\RequestRepository;
use PHPLinkTester\Entities\Request\RequestTypeRepository;
use PHPLinkTester\Entities\Response\RequestResponse;

class ValidateLinkCode
{
  public function __construct(
    private RequestRepository $requestRepository,
    private RequestTypeRepository $RequestTypeRepository  
  ) { }

  public function execute(RequestDto $requestData): RequestResponse
  {
    $request = Request::LinkPort (
      $requestData->link, 
      $requestData->port
    );

    if (!$this->RequestTypeRepository->isAValidRequest($requestData->requestType)) {
      $className = get_class($this->RequestTypeRepository);
        throw new \InvalidArgumentException (
          "Invalid request type: '$requestData->requestType' for class $className" );
    }

    $request->setRequestType($requestData->requestType);

    return $this->requestRepository->queryCode($request);
  }
}
