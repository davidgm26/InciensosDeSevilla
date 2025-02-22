<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\ORM\Mapping as ORM;
use Rol;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
#[ORM\Table(name: "usuario", schema: "inciensosdesevilla")]
class Usuario implements UserInterface,PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "id")]
    private ?int $id;

    #[ORM\Column(length: 150,name: "username")]
    private ?string $username;

    #[ORM\Column(length: 500,name: "password")]
    private ?string $password;


    #[ORM\Column(length: 200, name: "rol")]
    private ?String $rol;

    #[ORM\Column(type: "boolean", options: ["default" => true],name: "es_activo")]
    private ?bool $esActivo = true;

    #[ORM\Column(type: "boolean", options: ["default" => false],name: "validado")]
    private ?bool $validado = false;


    #[ORM\Column(length: 500,name: "token")]
    private ?string $token;

    #[ORM\Column(type: "datetime",name: "fecha_cambio_contrasenia")]
    private ?\DateTimeInterface $fechaCambioPass;

    #[ORM\Column(type: "datetime",name:"fecha_validacion")]
    private ?\DateTimeInterface $fechaValidacion;

    #[ORM\Column(type: "datetime", name: "fecha_creacion")]
    private ?\DateTimeInterface $fechaCreacion;

    public function getValidado(): ?bool
    {
        return $this->validado;
    }

    public function setValidado(?bool $validado): void
    {
        $this->validado = $validado;
    }



    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): void
    {
        $this->token = $token;
    }

    public function getFechaCambioPass(): ?\DateTimeInterface
    {
        return $this->fechaCambioPass;
    }

    public function setFechaCambioPass(?\DateTimeInterface $fechaCambioPass): void
    {
        $this->fechaCambioPass = $fechaCambioPass;
    }

    public function getFechaValidacion(): ?\DateTimeInterface
    {
        return $this->fechaValidacion;
    }

    public function setFechaValidacion(?\DateTimeInterface $fechaValidacion): void
    {
        $this->fechaValidacion = $fechaValidacion;
    }

    public function getFechaCreacion(): ?\DateTimeInterface
    {
        return $this->fechaCreacion;
    }

    public function setFechaCreacion(?\DateTimeInterface $fechaCreacion): void
    {
        $this->fechaCreacion = $fechaCreacion;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getEsActivo(): ?bool
    {
        return $this->esActivo;
    }

    public function setEsActivo(bool $esActivo): static
    {
        $this->esActivo = $esActivo;

        return $this;
    }



    public function eraseCredentials(): void
    {

    }

    public function getRol(): ?string
    {
        return $this->rol;
    }

    public function setRol(?string $rol): void
    {
        $this->rol = $rol;
    }

    public function getUserIdentifier(): string
    {
        // TODO: Implement getUserIdentifier() method.
    }

    public function getRoles(): array
    {
        $roles = [];
        $roles[] = $this->getRol();
        return  $roles;
    }
}
