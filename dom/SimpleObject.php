<?php
namespace dom;
class SimpleObject {
    private  $nombre = 'hola';
    private  $apellido = 'hola';

    public function getNombre(){
        return $this->nombre;
    }

    public function setName($name){
        $this->nombre = $nombre;
    }

}
?>
