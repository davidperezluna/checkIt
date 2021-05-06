<?php
namespace App\services;
 
use App\Entity\Stock;
use App\Entity\Producto;
use Doctrine\ORM\Event\LifecycleEventArgs;
 
class CreateStockItem
{
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
 
        /**
         * Same entity
         */
        if ($entity instanceof Stock) {
            $fecha = new \DateTime('now');
            $em = $args->getEntityManager();
            $producto = $entity->getProducto();
            $cantidadActual = $producto->getCantidad();
            if ($entity->getTipoMovimiento()->getId()==1) {
                $producto->setCantidad($entity->getCantidad()+$cantidadActual);
            }
            if ($entity->getTipoMovimiento()->getId()==2) {
                $producto->setCantidad($entity->getCantidad()-$cantidadActual);
            }
            if ($entity->getTipoMovimiento()->getId()==3) {
                $producto->setCantidad($entity->getCantidad()+$cantidadActual);
            }
            $em->flush($producto);
        }
 
    }


}