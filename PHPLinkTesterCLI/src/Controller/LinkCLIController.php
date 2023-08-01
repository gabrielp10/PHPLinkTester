<?php

namespace PHPLinkTesterCLI\Controller;

use PHPLinkTester\Application\Request\RequestDto;
use PHPLinkTester\Application\Request\ValidateLinkCode;
use PHPLinkTester\Entities\Request\HttpRequest;
use PHPLinkTester\Infrastructure\Link\LinkRepositoryCurl;

class LinkCLIController
{
  private array $requiredArgs = ['u', 'p', 't', 'm', 'i'];

  public function __construct(int $argCount, array $argValues)
  {
    // Self encapsulation
    if ($argCount > 0) {
      $args = $this->argsValidator($argValues);
      
      if ($this->isValidArgs($args)) {
        return $this->doRequest($args);
      }
    }
  }

  private function argsValidator(array $argValues): array
  {
    // Check if any argument were passed
      foreach ($argValues as $arg) {
        $e=explode("=",$arg);
        if (count($e)==2) { $args[$e[0]]=$e[1]; }
        else { $args[$e[0]]=0; }  
      }

      // Change all args to first letter only
      $args = array_reduce(array_keys($args), function ($result, $key) use ($args) {
        $newKey = substr($key, 0, 1);
        $result[$newKey] = $args[$key];
        return $result;
      }, []);

      return $args;
  }

  private function isValidArgs(array $argsValues)
  {
    // Check if all required arguments exist
    if (count(array_intersect_key(array_flip($this->requiredArgs), $argsValues)) < count($this->requiredArgs)) {
      $this->throwMessage("Missing arguments");

      return false;
    }

    return true;
  }

  private function  throwMessage(string $text): void
  {
    echo $text . PHP_EOL;
  }

  private function doRequest(array $argsValues)
  {
    $link = $argsValues['u'];
    $dto = new RequestDto($link, $argsValues['p'], $argsValues['m']);
    $curl = new LinkRepositoryCurl();
    $http =  new HttpRequest();

    $useCase = new ValidateLinkCode($curl, $http);
    $code = $useCase->execute($dto)->getCode();

    return $this->throwMessage("Link: $link Code: $code");
  }
}