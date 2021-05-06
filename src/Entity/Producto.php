<?php

namespace App\Entity;

use App\Repository\ProductoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductoRepository::class)
 */
class Producto
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ref;



    /**
     * @ORM\ManyToOne(targetEntity=Categoria::class, inversedBy="productos")
     */
    private $categoria;

    /**
     * @ORM\ManyToOne(targetEntity=Bodega::class, inversedBy="productos")
     */
    private $bodega;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lote;

    /**
     * @ORM\Column(type="text")
     */
    private $descripcion;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imagen;

    /**
     * @ORM\OneToMany(targetEntity=Stock::class, mappedBy="producto")
     */
    private $stocks;

    /**
     * @ORM\Column(type="integer")
     */
    private $cantidad = 0;

    /**
     * @ORM\Column(type="integer")
     */
    private $precio;

    /**
     * @ORM\OneToMany(targetEntity=ProductosPedido::class, mappedBy="producto")
     */
    private $productosPedidos;

   


    public function __toString()
    {
        return $this->ref."-".$this->categoria->getNombre()."-".$this->nombre;
    }

    public function __construct()
    {
        $this->stocks = new ArrayCollection();
        $this->productosPedidos = new ArrayCollection();
    }

   
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function setRef(string $ref): self
    {
        $this->ref = $ref;

        return $this;
    }

    public function getLote(): ?string
    {
        return $this->lote;
    }

    public function setLote(string $lote): self
    {
        $this->lote = $lote;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(string $imagen): self
    {
        $this->imagen = $imagen;

        return $this;
    }

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getCategoria(): ?Categoria
    {
        return $this->categoria;
    }

    public function setCategoria(?Categoria $categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }

    public function getBodega(): ?Bodega
    {
        return $this->bodega;
    }

    public function setBodega(?Bodega $bodega): self
    {
        $this->bodega = $bodega;

        return $this;
    }

    /**
     * @return Collection|Stock[]
     */
    public function getStocks(): Collection
    {
        return $this->stocks;
    }

    public function addStock(Stock $stock): self
    {
        if (!$this->stocks->contains($stock)) {
            $this->stocks[] = $stock;
            $stock->setProducto($this);
        }

        return $this;
    }

    public function removeStock(Stock $stock): self
    {
        if ($this->stocks->removeElement($stock)) {
            // set the owning side to null (unless already changed)
            if ($stock->getProducto() === $this) {
                $stock->setProducto(null);
            }
        }

        return $this;
    }

    public function getPrecio(): ?int
    {
        return $this->precio;
    }

    public function setPrecio(int $precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * @return Collection|ProductosPedido[]
     */
    public function getProductosPedidos(): Collection
    {
        return $this->productosPedidos;
    }

    public function addProductosPedido(ProductosPedido $productosPedido): self
    {
        if (!$this->productosPedidos->contains($productosPedido)) {
            $this->productosPedidos[] = $productosPedido;
            $productosPedido->setProducto($this);
        }

        return $this;
    }

    public function removeProductosPedido(ProductosPedido $productosPedido): self
    {
        if ($this->productosPedidos->removeElement($productosPedido)) {
            // set the owning side to null (unless already changed)
            if ($productosPedido->getProducto() === $this) {
                $productosPedido->setProducto(null);
            }
        }

        return $this;
    }

    
    
}
