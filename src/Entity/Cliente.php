<?php

namespace App\Entity;

use App\Repository\ClienteRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClienteRepository::class)]
#[ORM\Table(name: "cliente", schema: "inciensosdesevilla")]
class Cliente
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $nombre = null;

    #[ORM\Column(length: 150)]
    private ?string $apellido = null;

    #[ORM\Column(length: 100)]
    private ?string $correo = null;

    #[ORM\Column(length: 50)]
    private ?string $telefono = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $dni = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $direccion = null;

    #[ORM\OneToOne(targetEntity: Usuario::class, cascade: ["persist", "remove"])]
    #[ORM\JoinColumn(nullable: false, name: "id_usuario")]
    private ?Usuario $usuario = null;

    #[ORM\OneToMany(targetEntity: Pedido::class, mappedBy: 'cliente', cascade: ['persist', 'remove'])]
    private Collection $pedidos;

    #[ORM\OneToMany(mappedBy: 'cliente', targetEntity: Resenia::class, cascade: ['persist', 'remove'])]
    private Collection $resenias;

    public function getPedidos(): Collection
    {
        return $this->pedidos;
    }

    public function addPedido(Pedido $pedido): static
    {
        if (!$this->pedidos->contains($pedido)) {
            $this->pedidos->add($pedido);
            $pedido->setCliente($this); // Asegura la relación bidireccional
        }

        return $this;
    }

    public function removePedido(Pedido $pedido): static
    {
        if ($this->pedidos->removeElement($pedido)) {
            // Borra la relación inversa
            if ($pedido->getCliente() === $this) {
                $pedido->setCliente(null);
            }
        }

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getCorreo(): ?string
    {
        return $this->correo;
    }

    public function setCorreo(string $correo): static
    {
        $this->correo = $correo;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): static
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getResenias(): Collection
    {
        return $this->resenias;
    }

    public function getDni(): ?string
    {
        return $this->dni;
    }

    public function setDni(?string $dni): static
    {
        $this->dni = $dni;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(?string $direccion): static
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(Usuario $usuario): static
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->apellido;
    }
    public function setApellido(string $apellido): static
    {
        $this->apellido = $apellido;

        return $this;
    }
}
