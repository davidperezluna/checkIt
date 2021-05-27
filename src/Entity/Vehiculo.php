<?php

namespace App\Entity;

use App\Repository\VehiculoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VehiculoRepository::class)
 */
class Vehiculo
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
    private $placa;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $modelo;

    /**
     * @ORM\ManyToOne(targetEntity=TipoVehiculo::class, inversedBy="vehiculos")
     */
    private $tipoVehiculo;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="vehiculos")
     */
    private $conductor;

    /**
     * @ORM\OneToMany(targetEntity=Pedido::class, mappedBy="vehiculo")
     */
    private $pedidos;

    public function __toString()
    {
        return $this->placa;
    }

    public function __construct()
    {
        $this->pedidos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlaca(): ?string
    {
        return $this->placa;
    }

    public function setPlaca(string $placa): self
    {
        $this->placa = $placa;

        return $this;
    }

    public function getModelo(): ?string
    {
        return $this->modelo;
    }

    public function setModelo(string $modelo): self
    {
        $this->modelo = $modelo;

        return $this;
    }

    public function getTipoVehiculo(): ?TipoVehiculo
    {
        return $this->tipoVehiculo;
    }

    public function setTipoVehiculo(?TipoVehiculo $tipoVehiculo): self
    {
        $this->tipoVehiculo = $tipoVehiculo;

        return $this;
    }

    public function getConductor(): ?User
    {
        return $this->conductor;
    }

    public function setConductor(?User $conductor): self
    {
        $this->conductor = $conductor;

        return $this;
    }

    /**
     * @return Collection|Pedido[]
     */
    public function getPedidos(): Collection
    {
        return $this->pedidos;
    }

    public function addPedido(Pedido $pedido): self
    {
        if (!$this->pedidos->contains($pedido)) {
            $this->pedidos[] = $pedido;
            $pedido->setVehiculo($this);
        }

        return $this;
    }

    public function removePedido(Pedido $pedido): self
    {
        if ($this->pedidos->removeElement($pedido)) {
            // set the owning side to null (unless already changed)
            if ($pedido->getVehiculo() === $this) {
                $pedido->setVehiculo(null);
            }
        }

        return $this;
    }
}
