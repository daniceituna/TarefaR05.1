<?php

namespace App\Repository;

use App\Entity\Pedido;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Pedido>
 */
class PedidoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, private EntityManagerInterface $em)
    {
        parent::__construct($registry, Pedido::class);
    }


    public function save(Pedido $pedido, bool $flush = true): void
    {
        $this->em->persist($pedido);
        if ($flush) {
            $this->em->flush();
        }
    }

    public function remove(Pedido $pedido, bool $flush = false): void
    {
        $this->em->remove($pedido);
        if ($flush) {
            $this->em->flush();
        }
    }
}
