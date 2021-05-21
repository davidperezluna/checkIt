<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombres;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $apellidos;

    /**
     * @ORM\Column(type="string", length=11)
     */
    private $cedula;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $telefono;

    /**
     * @ORM\ManyToOne(targetEntity=TipoIdentificacion::class, inversedBy="users")
     */
    private $tipoIdentificacion;

    /**
     * @ORM\OneToMany(targetEntity=Vehiculo::class, mappedBy="conductor")
     */
    private $vehiculos;

    /**
     * @ORM\OneToMany(targetEntity=Bodega::class, mappedBy="responzable")
     */
    private $bodegas;

    /**
     * @ORM\OneToMany(targetEntity=Cliente::class, mappedBy="responzable")
     */
    private $clientes;

    /**
     * @ORM\OneToMany(targetEntity=Stock::class, mappedBy="usuario")
     */
    private $stocks;

    /**
     * @ORM\OneToMany(targetEntity=Pedido::class, mappedBy="clienteResponzable")
     */
    private $pedidos;

    public function __construct()
    {
        $this->vehiculos = new ArrayCollection();
        $this->bodegas = new ArrayCollection();
        $this->clientes = new ArrayCollection();
        $this->stocks = new ArrayCollection();
        $this->pedidos = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        global $kernel;
        if (method_exists($kernel, 'getKernel'))
            $kernel = $kernel->getKernel();

        $this->password = $kernel->getContainer()->get('security.password_encoder')->encodePassword($this, $password);
        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNombres(): ?string
    {
        return $this->nombres;
    }

    public function setNombres(string $nombres): self
    {
        $this->nombres = $nombres;

        return $this;
    }

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): self
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getCedula(): ?string
    {
        return $this->cedula;
    }

    public function setCedula(string $cedula): self
    {
        $this->cedula = $cedula;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getTipoIdentificacion(): ?TipoIdentificacion
    {
        return $this->tipoIdentificacion;
    }

    public function setTipoIdentificacion(?TipoIdentificacion $tipoIdentificacion): self
    {
        $this->tipoIdentificacion = $tipoIdentificacion;

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
            $vehiculo->setConductor($this);
        }

        return $this;
    }

    public function removeVehiculo(Vehiculo $vehiculo): self
    {
        if ($this->vehiculos->removeElement($vehiculo)) {
            // set the owning side to null (unless already changed)
            if ($vehiculo->getConductor() === $this) {
                $vehiculo->setConductor(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->cedula ." ". $this->nombres ." ". $this->apellidos;
    }

    /**
     * @return Collection|Bodega[]
     */
    public function getBodegas(): Collection
    {
        return $this->bodegas;
    }

    public function addBodega(Bodega $bodega): self
    {
        if (!$this->bodegas->contains($bodega)) {
            $this->bodegas[] = $bodega;
            $bodega->setResponzable($this);
        }

        return $this;
    }

    public function removeBodega(Bodega $bodega): self
    {
        if ($this->bodegas->removeElement($bodega)) {
            // set the owning side to null (unless already changed)
            if ($bodega->getResponzable() === $this) {
                $bodega->setResponzable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Cliente[]
     */
    public function getClientes(): Collection
    {
        return $this->clientes;
    }

    public function addCliente(Cliente $cliente): self
    {
        if (!$this->clientes->contains($cliente)) {
            $this->clientes[] = $cliente;
            $cliente->setResponzable($this);
        }

        return $this;
    }

    public function removeCliente(Cliente $cliente): self
    {
        if ($this->clientes->removeElement($cliente)) {
            // set the owning side to null (unless already changed)
            if ($cliente->getResponzable() === $this) {
                $cliente->setResponzable(null);
            }
        }

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
            $stock->setUsuario($this);
        }

        return $this;
    }

    public function removeStock(Stock $stock): self
    {
        if ($this->stocks->removeElement($stock)) {
            // set the owning side to null (unless already changed)
            if ($stock->getUsuario() === $this) {
                $stock->setUsuario(null);
            }
        }

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
            $pedido->setClienteResponzable($this);
        }

        return $this;
    }

    public function removePedido(Pedido $pedido): self
    {
        if ($this->pedidos->removeElement($pedido)) {
            // set the owning side to null (unless already changed)
            if ($pedido->getClienteResponzable() === $this) {
                $pedido->setClienteResponzable(null);
            }
        }

        return $this;
    }

}
