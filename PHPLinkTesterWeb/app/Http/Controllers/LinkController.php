<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Protocol\{WebHttpRequest, WebOthersRequest, WebRequestNotFound};
use App\Http\Controllers\Interface\Http\{WebCurlInterface, WebGuzzleInterface};
use App\Http\Controllers\Interface\Others\WebFsockInterface;
use App\Http\Controllers\Interface\WebInterfaceNotFound;
use PHPLinkTester\Application\Request\{RequestDto, ValidateLinkCode};

class LinkController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
      return view('home.index');
    }

    public function LinkRequest(Request $request)
    {
      $methodHandler = $this->methodHandler()[$request->testProtocolSelect];
      $methodHandler = $request->$methodHandler;
      
      $interfaceHandler = $this->interfaceHandler()[$request->testProtocolSelect];
      $interfaceHandler = $request->$interfaceHandler;
      
      $linkType = $this->LinkProtocolHandler($request->testProtocolSelect);
      $linkIRepository = $this->LinkRepositoryHandler($request->testProtocolSelect, $interfaceHandler);
      
      $linkDto = new RequestDto($request->link, $request->port, $methodHandler);
  
      $useCase = new ValidateLinkCode($linkIRepository, $linkType);
      $result = $useCase->execute($linkDto);
  
      return "Link: $request->link Code: ".$result->getCode();
    }

    private function LinkProtocolHandler(string $method)
    {
      $linkChain = new WebHttpRequest (new WebOthersRequest(new WebRequestNotFound()));
      return $linkChain->validateRequestType($method);
    }

    private function LinkRepositoryHandler(string $interface, string $method)
    {
      if ($interface == 'HTTP') {
        $interfaceChain = new WebCurlInterface(new WebGuzzleInterface(new WebInterfaceNotFound()));
        return $interfaceChain->validateInterfaceType($method);
      }

      $interfaceChain = new WebFsockInterface(new WebInterfaceNotFound());
      return $interfaceChain->validateInterfaceType($method);
    }

    private function methodHandler(): array
    {
      return [
        'HTTP' => 'testMethodSelectHttp',
        'OTHERS' => 'testMethodSelectOthers'
      ];
    }

    private function interfaceHandler(): array
    {
      return [
        'HTTP' => 'testInterfaceSelectHttp',
        'OTHERS' => 'testInterfaceSelectOthers'
      ];
    }
}
