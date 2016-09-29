<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use phpDocumentor\Reflection\Types\Array_;
use phpDocumentor\Reflection\Types\Object_;
require 'vendor/autoload.php';
include 'framework/reflectiontools.php';
$app = new \Slim\App;
include_dir('repository');
$app->get('/', function () {
	$response->links = new Array_();
	$response->links[0]->href="/version";
	
    return json_encode($response);
});

$app->get('/version', function () {

	$response->links = new Array_();
	$response->version = "1.0.0";
	return json_encode($response);
});

$app->get('/services', function () {	
		$response->value=[];
		foreach (get_declared_classes() as &$valor) {
			$rc = new ReflectionClass($valor);
			if($rc->getNamespaceName()=="repo")
			{
				
					$rm = new ReflectionMethod($rc->getName(),"title");
					$objecto= new stdClass();
					$objecto->href=$rc->getShortName();
					$objecto->title=$rm->invoke($rc->newInstanceArgs());
					$objecto->method="get";
					array_push($response->value,$objecto);
			
			}
		}
		return json_encode($response);
});

$app->run();