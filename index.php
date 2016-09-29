<?php
include 'framework/reflectiontools.php';



function parseCamelCase($str)
{
	return preg_replace('/(?!^)[A-Z]{2,}(?=[A-Z][a-z])|[A-Z][a-z]|[0-9]{1,}/', ' $0', $str);
}


include_dir('dom');
include_dir('repository');
foreach (get_declared_classes() as &$valor) {
	$rc = new ReflectionClass($valor);
	if($rc->getNamespaceName()=="dom")
	{
		echo $rc->getName();
		//$rm = new ReflectionMethod($valor);
		$métodos_clase = $rc->getMethods(ReflectionMethod::IS_PUBLIC);
		//var_dump($métodos_clase)
		echo "<br>";
		foreach ($métodos_clase as $nombre_método) {

			echo parseCamelCase($nombre_método->name);
			
			$rm = new ReflectionMethod($rc->getName(),$nombre_método->name);
			$rm->invoke($rc->newInstanceArgs());
			echo "<br>";
		}
		
	}
	if($rc->getNamespaceName()=="repo")
	{
		echo "<br>".$rc->getName();
		$métodos_clase = $rc->getMethods(ReflectionMethod::IS_PUBLIC);
		echo "<br>";
		foreach ($métodos_clase as $nombre_método) {
			echo $nombre_método->name;
			echo "<br>";
		}
	}
	
}


//echo $rc->getNamespaceName();

?>
