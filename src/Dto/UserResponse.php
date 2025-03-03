<?php

namespace App\Dto;

use App\Entity\Usuario;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'user_response')]
class UserResponse
{

    protected $id;
    protected $activo;
    protected $username;
    protected $rol;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * @param mixed $activo
     */
    public function setActivo($activo): void
    {
        $this->activo = $activo;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * @param mixed $rol
     */
    public function setRol($rol): void
    {
        $this->rol = $rol;
    }


    public static function createUserResponse(Usuario $usuario)
    {
        $dto = new self();
        $dto->activo = $usuario->getEsActivo();
        $dto->username = $usuario->getUsername();
        $dto->rol = $usuario->getRol();
        $dto->id = $usuario->getId();
        return $dto;
    }


}