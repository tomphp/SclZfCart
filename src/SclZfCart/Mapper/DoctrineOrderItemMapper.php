<?php

namespace SclZfCart\Mapper;

use Doctrine\ORM\EntityManager;
use SclZfCart\Entity\OrderInterface;
use SclZfUtilities\Doctrine\FlushLock;
use SclZfUtilities\Mapper\GenericDoctrineMapper;

/**
 * Doctrine Mapper for OrderItem.
 *
 * @author Tom Oram <tom@scl.co.uk>
 */
class DoctrineOrderItemMapper extends GenericDoctrineMapper implements
    OrderItemMapperInterface
{
    /**
     * @param EntityManager $entityManager
     * @param FlushLock     $flushLock
     */
    public function __construct(
        EntityManager $entityManager,
        FlushLock $flushLock
    ) {
        parent::__construct(
            $entityManager,
            $flushLock,
            'SclZfCart\Entity\DoctrineOrderItem'
        );
    }

    /**
     * {@inheritDoc}
     *
     * @param  OrderInterface
     * @return OrderItemInterface[]|null
     */
    public function fetchAllForOrder(OrderInterface $order)
    {
         return parent::fetchBy(array('order' => $order));
    }
}