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
      $type = $request->testTypeSelect;

      switch($type) {
        case 1:
          return $this->SimpleRequest($request);
        case 2:
          return $this->multipleRequest1($request->linkInput);
      }
    }

    private function SimpleRequest(Request $request)
    {
      $methodHandler = $this->methodHandler()[$request->testProtocolSelect];
      $methodHandler = $request->$methodHandler;
      
      $interfaceHandler = $this->interfaceHandler()[$request->testProtocolSelect];
      $interfaceHandler = $request->$interfaceHandler;
      
      return $this->doRequest ($request->link, $request->port, $methodHandler, $interfaceHandler);
    }

    private function multipleRequest1(string $linkInput)
    {
      $lines = explode(PHP_EOL, $linkInput);
      $array = array();
      foreach ($lines as $line) {
          $array[] = str_getcsv($line, ';');
      }

      foreach ($array as $newRequest) {
        echo $this->doRequest (
          $newRequest[0], $newRequest[1], $newRequest[2], $newRequest[3] ) . PHP_EOL;
      }
    }

    private function doRequest($link, $port, $method, $interface): string
    {      
      $linkIRepository = $this->LinkRepositoryHandler($method, $interface);
      
      $linkDto = new RequestDto($link, $port, $method);
  
      $useCase = new ValidateLinkCode($linkIRepository);
      $result = $useCase->execute($linkDto);
  
      return "Link: $link Code: ".$result->getCode();
    }

    private function LinkRepositoryHandler(string $method, string $interface)
    {
      if (in_array($method, ['GET', 'POST'])) {
        $interfaceChain = new WebCurlInterface(new WebGuzzleInterface(new WebInterfaceNotFound()));
        return $interfaceChain->validateInterfaceType($interface);
      }

      $interfaceChain = new WebFsockInterface(new WebInterfaceNotFound());
      return $interfaceChain->validateInterfaceType($interface);
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
