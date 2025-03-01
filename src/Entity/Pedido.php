<?php

namespace App\Entity;

use App\Repository\PedidoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PedidoRepository::class)]
#[ORM\Table(name: "pedido", schema: "inciensosdesevilla")]
class Pedido
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;

    #[ORM\Column(type: "date")]
    private ?\DateTimeInterface $fecha;

    #[ORM\Column(type: "decimal", precision: 10, scale: 2)]
    private ?float $total;

    #[ORM\Column(type: "string", name: "nombre", length: 200)]
    private ?string $nombre;

    #[ORM\ManyToOne(targetEntity: Cliente::class, inversedBy: "pedidos")]
    #[ORM\JoinColumn(name: "id_cliente",referencedColumnName: "id" ,nullable: false)]
    private ?Cliente $cliente;

    #[ORM\ManyToOne(targetEntity: Estado::class)]
    #[ORM\JoinColumn(name: "estado",referencedColumnName: "id",nullable: false)]
    private ?Estado $estado;

    #[ORM\OneToMany(mappedBy: "pedido", targetEntity: LineaPedido::class, cascade: ["persist", "remove"])]
    private Collection $lineas;

    #[ORM\Column(name: "direccion_entrega", type: "string", nullable: false)]
    private ?String $direccionEntrega;

    public function __construct()
    {
        $this->lineas = new ArrayCollection();
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getDireccionEntrega(): ?string
    {
        return $this->direccionEntrega;
    }           

    public function setDireccionEntrega(?string $direccionEntrega): void
    {
        $this->direccionEntrega = $direccionEntrega;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): static
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): static
    {
        $this->total = $total;

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

    public function getEstado(): ?Estado
    {
        return $this->estado;
    }

    public function setEstado(?Estado $estado): static
    {
        $this->estado = $estado;

        return $this;
    }

    public function getLineas(): Collection
    {
        return $this->lineas;
    }

    public function addLinea(LineaPedido $linea): static
    {
        if (!$this->lineas->contains($linea)) {
            $this->lineas->add($linea);
            $linea->setPedido($this);
        }

        return $this;
    }

    public function removeLinea(LineaPedido $linea): static
    {
        if ($this->lineas->removeElement($linea)) {
            // Set the owning side to null (unless already changed)
            if ($linea->getPedido() === $this) {
                $linea->setPedido(null);
            }
        }

        return $this;
    }
}
