<?php

namespace App\Entity;

use App\Repository\ProductoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductoRepository::class)]
#[ORM\Table(name:"producto", schema: "inciensosdesevilla")]
class Producto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nombre = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $url_foto = null;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private ?float $precio = null;

    #[ORM\Column]
    private ?int $stock = null;

    #[ORM\Column(nullable: true)]
    private ?int $valoracion = null;

    #[ORM\ManyToOne(targetEntity: Categoria::class, inversedBy: "productos")]
    #[ORM\JoinColumn(nullable: false, name: "id_categoria")]
    private ?Categoria $categoria = null;

    #[ORM\OneToMany(mappedBy: 'producto', targetEntity: Resenia::class, cascade: ['persist', 'remove'])]
    private Collection $resenias;

    public function __construct()
    {
        $this->resenias = new ArrayCollection();  // Inicializamos la colección
    }

    // Getters y setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;
        return $this;
    }

    public function getUrlFoto(): ?string
    {
        return $this->url_foto;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setUrlFoto(string $url): static
    {
        $this->url_foto = $url;

        return $this;
    }


    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getPrecio(): ?float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio): static
    {
        $this->precio = $precio;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): static
    {
        $this->stock = $stock;

        return $this;
    }

    public function getValoracion(): ?int
    {
        return $this->valoracion;
    }

    public function setValoracion(?int $valoracion): static
    {
        $this->valoracion = $valoracion;

        return $this;
    }

    public function getCategoria(): ?Categoria
    {
        return $this->categoria;
    }

    public function setCategoria(?Categoria $categoria): static
    {
        $this->categoria = $categoria;

        return $this;
    }

    public function getResenias(): Collection
    {
        return $this->resenias;
    }


    public function addResenia(Resenia $resenia): static
    {
        if (!$this->resenias->contains($resenia)) {
            $this->resenias->add($resenia);
            $resenia->setProducto($this);
        }

        return $this;
    }

    public function removeResenia(Resenia $resenia): static
    {
        if ($this->resenias->removeElement($resenia)) {
            // Si se elimina la reseña, desasocia el producto de la reseña
            if ($resenia->getProducto() === $this) {
                $resenia->setProducto(null);
            }
        }

        return $this;
    }
}
