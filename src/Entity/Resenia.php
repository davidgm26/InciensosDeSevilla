<?php

namespace App\Entity;

use App\Repository\ReseniaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReseniaRepository::class)]
#[ORM\Table(name: "resenia", schema: "inciensosdesevilla")]
class Resenia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;

    #[ORM\Column]
    private int $valoracion;

    #[ORM\Column(length: 500)]
    private ?string $texto;

    #[ORM\ManyToOne(targetEntity: Cliente::class, inversedBy: 'resenias')]
    #[ORM\JoinColumn(nullable: false, name: "id_cliente")]
    private ?Cliente $cliente;

    #[ORM\ManyToOne(targetEntity: Producto::class, inversedBy: 'resenias')]
    #[ORM\JoinColumn(nullable: false, name: "id_producto")]
    private ?Producto $producto = null;

    #[ORM\Column(type: 'date')]
    private ?\DateTime $fecha;

    public function getFecha(): ?\DateTime
    {
        return $this->fecha;
    }

    public function setFecha(?\DateTime $fecha): void
    {
        $this->fecha = $fecha ?? new \DateTime();

    }

    public function getValoracion(): int
    {
        return $this->valoracion;
    }

    public function setValoracion(int $valoracion): void
    {
        $this->valoracion = $valoracion;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTexto(): ?string
    {
        return $this->texto;
    }

    public function setTexto(string $texto): static
    {
        $this->texto = $texto;

        return $this;
    }

    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): static
    {
        $this->cliente = $cliente;

        return $this;
    }

    public function getProducto(): ?Producto
    {
        return $this->producto;
    }

    public function setProducto(?Producto $producto): static
    {
        $this->producto = $producto;

        return $this;
    }
}
