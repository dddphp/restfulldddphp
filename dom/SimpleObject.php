<?php
namespace dom;
class SimpleObject {
    private  $nombre = 'hola';
    private  $apellido = 'hola';

    public function getNombre(){
        return $this->nombre;
    }

    public function title($name){
        return 'SimpleObject';
    }
    
    public function mostrarAlgo(){
    	return 'titulo';
    }

}
?>
