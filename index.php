<?php
//include directory
function include_dir($path,$read=false) {
	//separador de directorios
	$s = '/';
	//vemos si es la primera vez que usamos la funcion
	if(!$read) {
		//obtenemos los dos ultimos caracteres
		$tree = substr($path,-2);
		if($tree=='.*') {
			//eliminamos el asterisco y activamos la recursividad
			$path = preg_replace('!\.\*$!','',$path);
			$read = true;
		}
		//obtenemos el document_root del archivo en caso de usarse
		$path = preg_replace('!^root\.!',$_SERVER['DOCUMENT_ROOT'].$s,$path);
		//cambiamos el punto por el separador
		$path = str_replace('.',$s,$path);
	}
	//abrimos el directorio
	if ($handle = opendir($path)) {
		while (false !== ($file = readdir($handle))) {
			if ($file != "." && $file != "..") {
				//si es un directorio lo recorremos en caso de activar la recursividad
				if(is_dir($path.$s.$file) and $read) {
					include_dir($path.$s.$file,true);
				} else {
					$ext = substr(strtolower($file),-3);
					if($ext == 'php') @include_once($path.$s.$file);
				}
			}
		}
		//cerramos el directorio
		closedir($handle);
	}
}


include_dir('dom');
foreach (get_declared_classes() as &$valor) {
	$rc = new ReflectionClass($valor);
	if($rc->getNamespaceName()=="dom")
	{
		echo $rc->getName();
	}
	
}


//echo $rc->getNamespaceName();

?>
