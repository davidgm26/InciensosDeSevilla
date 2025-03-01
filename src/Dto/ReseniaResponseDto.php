<?php

namespace App\Dto;



use App\Entity\Resenia;

class ReseniaResponseDto

{
    private $id;
    private $imagen;
    private $resenia;
    private $fecha;
    private $nombre;
    private $rating;

    /**
     * @return mixed
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * @param mixed $imagen
     */
    public function setImagen($imagen): void
    {
        $this->imagen = $imagen;
    }

    /**
     * @return mixed
     */
    public function getResenia()
    {
        return $this->resenia;
    }

    /**
     * @param mixed $resenia
     */
    public function setResenia($resenia): void
    {
        $this->resenia = $resenia;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param mixed $fecha
     */
    public function setFecha($fecha): void
    {
        $this->fecha = $fecha;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating): void
    {
        $this->rating = $rating;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }



    public static function createDtoFromResenia(Resenia $resenia): ReseniaResponseDto
    {
        $dto = new self();
        $dto->nombre = $resenia->getProducto()->getNombre();
        $dto->resenia = $resenia->getTexto();
        $dto->fecha = $resenia->getFecha();
        $dto->imagen = $resenia->getProducto()->getUrlFoto();
        $dto->rating = $resenia->getValoracion();
        $dto->id = $resenia->getId();
        return $dto;
    }

}