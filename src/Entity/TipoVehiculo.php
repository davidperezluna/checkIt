<?php

namespace App\Entity;

use App\Repository\TipoVehiculoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TipoVehiculoRepository::class)
 */
class TipoVehiculo
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
     * @ORM\OneToMany(targetEntity=Vehiculo::class, mappedBy="tipoVehiculo")
     */
    private $vehiculos;

    public function __toString()
    {
        return $this->nombre;
    }

    public function __construct()
    {
        $this->vehiculos = new ArrayCollection();
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

    /**
     * @return Collection|Vehiculo[]
     */
    public function getVehiculos(): Collection
    {
        return $this->vehiculos;
    }

    public function addVehiculo(Vehiculo $vehiculo): self
    {
        if (!$this->vehiculos->contains($vehiculo)) {
            $this->vehiculos[] = $vehiculo;
            $vehiculo->setTipoVehiculo($this);
        }

        return $this;
    }

    public function removeVehiculo(Vehiculo $vehiculo): self
    {
        if ($this->vehiculos->removeElement($vehiculo)) {
            // set the owning side to null (unless already changed)
            if ($vehiculo->getTipoVehiculo() === $this) {
                $vehiculo->setTipoVehiculo(null);
            }
        }

        return $this;
    }
}
