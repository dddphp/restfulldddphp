<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use phpDocumentor\Reflection\Types\Array_;
use phpDocumentor\Reflection\Types\Object_;
require 'vendor/autoload.php';
include 'framework/reflectiontools.php';
$app = new \Slim\App;
include_dir('repository');
include_dir('dom');
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
					$objecto->class=$rc->getShortName();
					$objecto->title=$rm->invoke($rc->newInstanceArgs());
					foreach ($rc->getMethods() as $métodos_clase ) {
						if (substr($métodos_clase->name,0,3)=="get")
						{
							$objecto->properties[]=$métodos_clase->name;
						}
						else
						{
							if($métodos_clase->name!=="title")
							{
								$objecto->metods[]=$métodos_clase->name;
							}
						}
					}
					array_push($response->value,$objecto);
			}
		}
		return json_encode($response);
});

$app->get('/domain', function () {
		$response->value=[];
		foreach (get_declared_classes() as &$valor) {
			$rc = new ReflectionClass($valor);
			if($rc->getNamespaceName()=="dom")
			{
				$rm = new ReflectionMethod($rc->getName(),"title");
				$objecto= new stdClass();
				$objecto->class=$rc->getShortName();
				$objecto->title=$rm->invoke($rc->newInstanceArgs());
				foreach ($rc->getMethods() as $métodos_clase ) {
				if (substr($métodos_clase->name,0,3)=="get")
				{
				$objecto->properties[]=$métodos_clase->name;
				}
				else
				{
					if($métodos_clase->name!=="title")
					{
					$objecto->metods[]=$métodos_clase->name;
					}
				}
				
				}
				array_push($response->value,$objecto);
					
			}
		}
		return json_encode($response);
});

$app->run();