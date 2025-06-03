<?php

namespace App\Entity;

use App\Repository\PedidoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PedidoRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Pedido
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Direccion = null;

    #[ORM\Column]
    private ?float $Total = null;

    #[ORM\Column]
    private ?int $Cantidad = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $Creado = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $Modificado = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDireccion(): ?string
    {
        return $this->Direccion;
    }

    public function setDireccion(string $Direccion): static
    {
        $this->Direccion = $Direccion;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->Total;
    }

    public function setTotal(float $Total): static
    {
        $this->Total = $Total;

        return $this;
    }

    public function getCantidad(): ?int
    {
        return $this->Cantidad;
    }

    public function setCantidad(int $Cantidad): static
    {
        $this->Cantidad = $Cantidad;

        return $this;
    }

    public function getCreado(): ?\DateTime
    {
        return $this->Creado;
    }

    #[ORM\PrePersist]
    public function setCreado(?\DateTime $Creado): self
    {
        $this->Creado = $Creado;

        return $this;
    }

    public function getModificado(): ?\DateTime
    {
        return $this->Modificado;
    }

    public function setModificado(?\DateTime $Modificado): static
    {
        $this->Modificado = $Modificado;

        return $this;
    }
}
