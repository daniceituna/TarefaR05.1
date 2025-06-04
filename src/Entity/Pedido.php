<?php

namespace App\Entity;

use App\Repository\PedidoRepository;
use Doctrine\ORM\Mapping as ORM;
use DateTimeImmutable;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PedidoRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Pedido
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    private ?string $Direccion = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?float $Total = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?int $Cantidad = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $Creado = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $Modificado = null;

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

    public function getCreado(): ?\DateTimeImmutable
    {
        return $this->Creado;
    }

    #[ORM\PrePersist]
    public function setCreado(): self
    {
        $this->Creado = new DateTimeImmutable('now');

        return $this;
    }

    public function getModificado(): ?\DateTimeImmutable
    {
        return $this->Modificado;
    }

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function setModificado(): self
    {
        $this->Modificado = new DateTimeImmutable('now');

        return $this;
    }
}
