<?php

namespace App\Entity;

use App\Repository\PedidoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PedidoRepository::class)
 */
class Pedido
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Cliente::class, inversedBy="solicitudes")
     */
    private $cliente;

    /**
     * @ORM\Column(type="date")
     */
    private $fechaInicial;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fechaEntrega;

    /**
     * @ORM\ManyToOne(targetEntity=Vehiculo::class, inversedBy="pedidos")
     */
    private $vehiculo;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $anotacionesCliente;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $anotacionesPedido;

    /**
     * @ORM\OneToMany(targetEntity=ProductosPedido::class, mappedBy="pedido")
     */
    private $productosPedidos;

    /**
     * @ORM\ManyToOne(targetEntity=EstadoPedido::class, inversedBy="pedidos")
     */
    private $estadoPedido;

    public function __construct()
    {
        $this->productosPedidos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

       public function getFechaInicial(): ?\DateTimeInterface
    {
        return $this->fechaInicial;
    }

    public function setFechaInicial(\DateTimeInterface $fechaInicial): self
    {
        $this->fechaInicial = $fechaInicial;

        return $this;
    }

    public function getFechaEntrega(): ?\DateTimeInterface
    {
        return $this->fechaEntrega;
    }

    public function setFechaEntrega(?\DateTimeInterface $fechaEntrega): self
    {
        $this->fechaEntrega = $fechaEntrega;

        return $this;
    }

    public function getVehiculo(): ?Vehiculo
    {
        return $this->vehiculo;
    }

    public function setVehiculo(?Vehiculo $vehiculo): self
    {
        $this->vehiculo = $vehiculo;

        return $this;
    }

    public function getAnotacionesCliente(): ?string
    {
        return $this->anotacionesCliente;
    }

    public function setAnotacionesCliente(string $anotacionesCliente): self
    {
        $this->anotacionesCliente = $anotacionesCliente;

        return $this;
    }

    public function getAnotacionesPedido(): ?string
    {
        return $this->anotacionesPedido;
    }

    public function setAnotacionesPedido(?string $anotacionesPedido): self
    {
        $this->anotacionesPedido = $anotacionesPedido;

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
            $productosPedido->setPedido($this);
        }

        return $this;
    }

    public function removeProductosPedido(ProductosPedido $productosPedido): self
    {
        if ($this->productosPedidos->removeElement($productosPedido)) {
            // set the owning side to null (unless already changed)
            if ($productosPedido->getPedido() === $this) {
                $productosPedido->setPedido(null);
            }
        }

        return $this;
    }

    public function getEstadoPedido(): ?EstadoPedido
    {
        return $this->estadoPedido;
    }

    public function setEstadoPedido(?EstadoPedido $estadoPedido): self
    {
        $this->estadoPedido = $estadoPedido;

        return $this;
    }

    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): self
    {
        $this->cliente = $cliente;

        return $this;
    }
}
