<?php

namespace App\Entity;

use App\Repository\TipoIdentificacionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TipoIdentificacionRepository::class)
 */
class TipoIdentificacion
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
    private $sigla;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSigla(): ?string
    {
        return $this->sigla;
    }

    public function setSigla(string $sigla): self
    {
        $this->sigla = $sigla;

        return $this;
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
}
