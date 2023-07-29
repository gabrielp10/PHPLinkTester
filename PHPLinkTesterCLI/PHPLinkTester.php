<?php

use PHPLinkTester\Application\Request\RequestDto;
use PHPLinkTester\Application\Request\ValidateLinkCode;
use PHPLinkTester\Entities\Request\HttpRequest;
use PHPLinkTester\Infrastructure\Link\LinkRepositoryCurl;

require 'vendor/autoload.php';


if ($argc > 0) {
  foreach ($argv as $arg) {
    
    $e=explode("=",$arg);
    
    if (count($e)==2) { $args[$e[0]]=$e[1]; }
    else { $args[$e[0]]=0; }  
  }
}

$dto = new RequestDto($args['link'], $args['port'], $args['HTTP']);
$curl = new LinkRepositoryCurl();
$http =  new HttpRequest();

$useCase = new ValidateLinkCode($curl, $http);



var_dump($useCase->execute($dto));