<?php

namespace App\Entity;

use App\Repository\LineaPedidoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LineaPedidoRepository::class)]
#[ORM\Table(name: "lineapedido", schema: "inciensosdesevilla")]
class LineaPedido
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;

    #[ORM\Column]
    private ?int $cantidad;

    #[ORM\Column(type: "decimal", precision: 10, scale: 2)]
    private ?float $precioUnitario;

    #[ORM\Column(type: "decimal", precision: 10, scale: 2)]
    private ?float $precioLinea;

    #[ORM\ManyToOne(targetEntity: Producto::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Producto $producto;

    #[ORM\ManyToOne(targetEntity: Pedido::class, inversedBy: "lineas")]
    #[ORM\JoinColumn(nullable: false)]
    private ?Pedido $pedido;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): static
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getPrecioUnitario(): ?float
    {
        return $this->precioUnitario;
    }

    public function setPrecioUnitario(float $precioUnitario): static
    {
        $this->precioUnitario = $precioUnitario;

        return $this;
    }

    public function getPrecioLinea(): ?float
    {
        return $this->precioLinea;
    }

    public function setPrecioLinea(float $precioLinea): static
    {
        $this->precioLinea = $precioLinea;

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

    public function getPedido(): ?Pedido
    {
        return $this->pedido;
    }

    public function setPedido(?Pedido $pedido): static
    {
        $this->pedido = $pedido;

        return $this;
    }
}
