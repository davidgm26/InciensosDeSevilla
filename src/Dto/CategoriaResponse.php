<?php

namespace App\Dto;

use App\Entity\Categoria;

class CategoriaResponse
{

    private $id;
    private $nombre;

    public function getNombre():string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre)
    {
        $this->nombre = $nombre;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public static function createCategoriaResponse(Categoria $categoria):CategoriaResponse
    {
        $dto = new self();
        $dto->nombre = $categoria->getNombre();
        $dto->id = $categoria->getId();
        return $dto;
    }
}