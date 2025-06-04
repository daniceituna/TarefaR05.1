<?php

namespace App\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PedidoOptionsResolver extends OptionsResolver
{
  public function configureDireccion(bool $isRequired = true): self
  {
    $this->setDefined("direccion")->setAllowedTypes("direccion", "string");

    if($isRequired) {
      $this->setRequired("direccion");
    }

    return $this;
  }

  public function configureTotal(bool $isRequired = true): self
  {
    $this->setDefined("total")->setAllowedTypes("total", "float");

    if($isRequired) {
      $this->setRequired("total");
    }

    return $this;
  }
  public function configureCantidad(bool $isRequired = true): self
  {
    $this->setDefined("cantidad")->setAllowedTypes("cantidad", "integer");

    if($isRequired) {
      $this->setRequired("cantidad");
    }

    return $this;
  }

}