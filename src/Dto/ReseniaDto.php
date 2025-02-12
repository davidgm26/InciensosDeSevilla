<?php

namespace App\Dto;

class ReseniaDto
{
    private $cliente;
    private $texto;
    private $valoracion;
    //private $fecha;


    public function getCliente()
    {
        return $this->cliente;
    }


    public function setCliente($cliente): void
    {
        $this->cliente = $cliente;
    }


    public function getTexto()
    {
        return $this->texto;
    }


    public function setTexto($texto): void
    {
        $this->texto = $texto;
    }


    public function getValoracion()
    {
        return $this->valoracion;
    }


    public function setValoracion($valoracion): void
    {
        $this->valoracion = $valoracion;
    }


//    public function getFecha()
//    {
//        return $this->fecha;
//    }
//
//
//    public function setFecha($fecha): void
//    {
//        $this->fecha = $fecha;
//    }



}