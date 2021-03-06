<?php

namespace Lavulator\ViewsCounterBundle\Manager;

use Doctrine\ORM\EntityManagerInterface;
use Lavulator\ViewsCounterBundle\Model\VisitableInterface;
use Lavulator\ViewsCounterBundle\Model\VisitableManagerInterface;

/**
 * Class VisitableManager
 *
 * @package Lavulator\ViewsCounterBundle\Manager
 */
class VisitableManager implements VisitableManagerInterface
{

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * VisitableManager constructor.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param VisitableInterface $visitable
     */
    public function update(VisitableInterface $visitable): void
    {
        $qb = $this->em->createQueryBuilder();

        $qb->update(\get_class($visitable), 'o')
            ->where('o.id = :id')
            ->setParameter('id', $visitable->getId());

        if (true === $visitable->isSingularViewed()) {
            $key    = sprintf('o.%s', $visitable::SINGULAR_VIEW_FIELD);
            $value  = sprintf('%s + 1', $key);

            $qb->set($key, $value);
        }

        if (true === $visitable->isPluralViewed()) {
            $key    = sprintf('o.%s', $visitable::PLURAL_VIEW_FIELD);
            $value  = sprintf('%s + 1', $key);

            $qb->set($key, $value);
        }

        $qb->getQuery()->execute();
    }
}
